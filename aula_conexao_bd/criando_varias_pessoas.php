<?php

include("./conexao.php");

$pessoas = [
  ["nome" => "Elesbão", "idade" => 21],
  ["nome" => "Zezao", "idade" => 21],
  ["nome" => "Mateusao", "idade" => 21],
];

$sql = "INSERT INTO pessoas (nome, idade) VALUES(:nome, :idade)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":idade", $idade);

try {
  foreach ($pessoas as $pessoa) {
    $nome = $pessoa["nome"];
    $idade = $pessoa["idade"];
    $stmt->execute();
  }
  echo "deu bom gurizada";
} catch (\PDOException $pdoE) {
  echo "deu merda: " . $pdoE->getMessage();
}