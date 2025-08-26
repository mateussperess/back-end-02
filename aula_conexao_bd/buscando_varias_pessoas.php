<?php

require("./conexao.php");

$stmt = $conn->prepare("SELECT * FROM pessoas WHERE idade >= ? AND idade <= ?");
$stmt->execute([21, 22]);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($rows);