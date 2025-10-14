<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    throw new BadRequestException();
}

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    throw new BadRequestException("Invalid JSON");
}

$name = isset($data['name']) ? trim($data['name']) : null;
$email = isset($data['email']) ? trim($data['email']) : null;
$password = isset($data['password']) ? trim($data['password']) : null;
$is_admin = isset($data['is_admin']) ? (int) $data['is_admin'] : null;

if (!$name || !$email || !$password || !($is_admin === 0 || $is_admin === 1)) {
    throw new ConflictException("Missing or invalid required fields");
}

$sql = "SELECT id FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();

$user_with_email = $stmt->fetch();
if ($user_with_email) {
    throw new ConflictException("Email already in use");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (name, email, password, is_admin) 
        VALUES (:name, :email, :password, :is_admin)";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
$stmt->execute();

http_response_code(201);
echo json_encode([
    'id' => $conn->lastInsertId(),
    'name' => $name,
    'email' => $email,
    'is_admin' => $is_admin
]);