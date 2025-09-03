<?php

$servername = "localhost";
$username = "root";
$password = "";
$schema  = "atividade_01_dbe2";

try {
  $conn = new PDO("mysql:host=$servername; dbname=$schema", $username, $password, []);
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  echo "conexão feita meu galo";
} catch (\PDOException $pdoE) {
  echo "deu merda: " . $pdoE->getMessage();
}
