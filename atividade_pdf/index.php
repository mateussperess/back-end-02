<?php
require_once './database/connection.php';

$sql = "SELECT * FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();

// teste
// var_dump($usuarios); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Usuários </title>
</head>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    padding: 20px;
    max-width: 1000px;
    margin: 0 auto;
    background: gray;
  }

  h1 {
    text-align: center;
    background-color: white;
    padding-block: 2rem;
  }

  p {
    text-align: center;
    font-size: 1rem;
    background-color: white;
    padding: 0.5rem;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 2rem;
    background-color: white;
  }

  thead {
    background-color: #f5f5f5;
  }

  th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 0.5px;
  }

  td {
    padding: 1rem 1rem;
    border-bottom: 1px solid black;
  }

  form {
    display: flex;
    justify-content: center;
  }

  form button {
    font-size: 2rem;
    padding: 1rem;
    border: none;
    border-radius: 1rem;
    cursor: pointer;
  }
</style>

<body>
  <h1> Tarefa para o dia 04 de Novembro </h1>
  <p> Desenvolvido por Mateus </p>

  <p> Total de usuários na tabela: <?php echo count($usuarios); ?> </p>
  <p> Relatório gerado em: <?php echo date("d/m/Y"); ?> </p>

  <table>
    <thead>
      <tr>
        <th> Nome </th>
        <th> Email </th>
        <th> Idade </th>
        <th> Cidade </th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($usuarios as $usuario) {
      ?>
        <tr>
          <td> <?php echo $usuario["nome"]; ?> </td>
          <td> <?php echo $usuario["email"]; ?> </td>
          <td> <?php echo $usuario["idade"]; ?> </td>
          <td> <?php echo $usuario["cidade"]; ?> </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <form action="gerar_pdf.php" method="post">
    <button> Exportar para PDF </button>
  </form>
</body>

</html>