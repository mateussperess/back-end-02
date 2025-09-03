<?php
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
}

if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {
  $admin_op1 = "<li> <a href='http://localhost/back-end-02/atividade01/usuarios.php'> Listar usuários do sistema </a> </li>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Menu Principal </title>
</head>

<body>
  <h3> Bem-vindo(a)! </h3>
  <ul>
    <li>
      <a href="http://localhost/back-end-02/atividade01/tarefas.php"> Listar minhas tarefas </a>
      <?php
      if (isset($admin_op1)) {
        echo $admin_op1;
      }
      ?>
    </li>
  </ul>
  <a href="http://localhost/back-end-02/atividade01/login.php"> Logout </a>
</body>

</html>