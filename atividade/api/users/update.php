<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    throw new NotAllowedException();
}

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    throw new BadRequestException("Invalid JSON");
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$name = isset($data['name']) ? trim($data['name']) : null;
$email = isset($data['email']) ? trim($data['email']) : null;
$password = isset($data['password']) ? trim($data['password']) : null;
$is_admin = isset($data['is_admin']) ? (int) $data['is_admin'] : null;

if (!$id || !$name || !$email || !($is_admin === 0 || $is_admin === 1)) {
    throw new BadRequestException("Missing or invalid required fields");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

if (!$user) {
    throw new NotFoundException("User not found");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND id != :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$user_with_email = $stmt->fetch();

if ($user_with_email) {
    throw new ConflictException("Email already in use");
}

$sql = "UPDATE users
        SET name = :name,
            email = :email,
            is_admin = :is_admin"
            . ($password ? ", password = :password" : "") . "
        WHERE id = :id";   

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
if ($password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
}
$stmt->execute();
    
http_response_code(200);
echo json_encode([
    'id' => $id,
    'name' => $name,
    'email' => $email,        
    'is_admin' => $is_admin
]);
