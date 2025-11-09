<?php

$bd = __DIR__ . '/bd.sqlite';

try {
  $conn = new PDO("sqlite:$bd");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  // echo "Tabela criada e conectada com sucesso";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}