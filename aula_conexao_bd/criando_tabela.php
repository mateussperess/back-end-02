<?php

require("./conexao.php");

$sql = "CREATE TABLE pessoas (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  nome VARCHAR(25) NOT NULL,
  idade INT
)";

try {
  $conn->exec($sql);
  echo "criou legal";
} catch (PDOException $pdoE) {
  echo "deu merda: " . $pdoE->getMessage();
}

