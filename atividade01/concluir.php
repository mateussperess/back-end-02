<?php

require("./conexao_banco.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_SESSION["user_id"])) {
    $taskId = $_POST["task_id"];

    $sql = "UPDATE tasks SET is_completed = :is_completed WHERE id = :id";
    $st = $conn->prepare($sql);
    
    $st->execute([
      "is_completed" => "1",
      "id" => $taskId,
    ]);

    header("Location: tarefas.php");
  }
}
