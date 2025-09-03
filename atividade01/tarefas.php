<?php
session_start();
require_once("./conexao_banco.php");

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $is_urgent = $_POST["is_urgent"] ?? "0";

  $sql = "INSERT INTO tasks (title, is_urgent, is_completed, userId, created_at) VALUES (:title, :is_urgent, :is_completed, :userId, :created_at)";
  $st = $conn->prepare($sql);
  $st->execute([
    "title" => $title,
    "is_urgent" => $is_urgent,
    "is_completed" => 0,
    "userId" => $_SESSION["user_id"],
    "created_at" => date("Y-m-d H:i:s")
  ]);

  $success = "Tarefa cadastrada com sucesso!";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $sql = "SELECT * FROM tasks WHERE userId = :user_id AND is_completed = :is_completed";
  $st = $conn->prepare($sql);
  $st->execute([
    "user_id" => $_SESSION["user_id"],
    "is_completed" => "0"
  ]);

  $tasks = $st->fetchAll();
  $success = "Lista de Tarefas";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Tarefas </title>
</head>

<body>
  <form action="tarefas.php" method="post">
    <input type="text" name="title" id="title" placeholder="Criar nova tarefa..."> <br>
    <label for="is_urgent"> <br>
      <span> É urgente? </span>
      <input type="checkbox" name="is_urgent" id="is_urgent" value="1"> <span> sim </span>
    </label>
    <br>
    <button type="submit"> Cadastrar nova tarefa</button>

  </form>

  <h3>
    <?php
    if (isset($success)) {
      echo $success;
    }
    ?>
  </h3>

  <ul>
    <?php 
      foreach($tasks as $task => $valor)
      {
        echo "<li> {$valor["title"]} </li>";
        echo 
        "<form action='concluir.php' method='post'>
          <input type='hidden' name='task_id' value='{$valor["id"]}'>
          <button type='submit'> Concluir tarefa</button>
        </form>";
      }
    ?>
  </ul>

  <a href="http://localhost/back-end-02/atividade01/index.php"> Voltar ao Menu </a>
</body>

</html>