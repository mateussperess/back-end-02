<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    throw new NotAllowedException();
}

$sql = "SELECT id, name, email, is_admin FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();    
echo json_encode($users);
