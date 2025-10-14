<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    throw new NotAllowedException();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    throw new BadRequestException();
}

$sql = "SELECT id, name, email, is_admin FROM users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch();

if (!$user) {
    throw new NotFoundException();
}

echo json_encode($user);


