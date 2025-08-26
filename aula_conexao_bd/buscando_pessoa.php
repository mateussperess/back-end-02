<?php

require(".conexao.php");

$sql = "SELECT * FROM pessoas";
$stmt = $conn->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $pessoa) {
  echo $pessoa["nome"] . " </br>";
}