<?php

require("./conexao.php");

$nome = "Mateus";
$idade = 21;

$sql = "INSERT INTO pessoas (nome, idade) VALUES (";
$sql .= $conn->quote($nome) . ", ";
$sql .= $idade . ") ";


try {
  $rowsAffected = $conn->exec($sql);
  $id = $conn->lastInsertId();
  echo "inseriu legal. ID do peao: " . $id;
} catch (\PDOException $pdoE) {
  echo "deu merda: " . $pdoE->getMessage();
}
