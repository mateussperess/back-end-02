<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    // EXCEPTION
}

$body = file_get_contents('php://input');
$data = json_decode($body, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    // EXCEPTION
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$is_admin = isset($data['is_admin']) ? (int) $data['is_admin'] : null;

if (!$id || !($is_admin === 0 || $is_admin === 1) ) {
    // EXCEPTION
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

if (!$user) {
    throw new NotFoundException("User not found");
}

$sql = "UPDATE users 
        SET is_admin = :is_admin 
        WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
$stmt->execute();
    
http_response_code(204);
