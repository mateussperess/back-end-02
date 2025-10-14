<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    throw new NotAllowedException();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    throw new BadRequestException("Missing or invalid required fields");
}

$sql = "DELETE FROM users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    throw new NotFoundException("User Not Found");
}

http_response_code(204);

