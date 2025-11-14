<?php

require_once "./database/connection.php";

function outPutCSV(array $data)
{
  $output = fopen("php://output", "wb");
  fputcsv($output, ['ID', 'nome', 'email'], ';');

  foreach ($data as $row) {
    fputcsv($output, $row, ';');
  }
  fclose($output);
}

try {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    throw new Exception("sem conteúdo para gerar csv");
  }

  $sql = "SELECT * FROM usuarios";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $usuarios = $stmt->fetchAll();

  if (sizeof($usuarios) > 0) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="usuarios.csv"');

    outPutCSV($usuarios);
  }
} catch (Exception $e) {
  echo "Ocorreu um erro: " . $e->getMessage();
}
