<?php

require_once("./conexao_banco.php");

session_start();
session_destroy();
$_SESSION["user_id"] = "";
$_SESSION["is_admin"] = "";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE email = :email";
  $st = $conn->prepare($sql);
  $st->execute(["email" => $email]);

  $user = $st->fetch();

  if($user && $password == $user["password"]) {
    session_start();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["is_admin"] = $user["is_admin"];
    header("Location: index.php");
  } else {
    $error = "Credenciais inválidas!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Atividade 01 </title>
</head>

<body>
  <h3>
    Realize seu login abaixo
  </h3>

  <form action="login.php" method="post">
    <input type="email" name="email" id="email" placeholder="Email"> <br>
    <input type="password" name="password" id="password" placeholder="Senha"> <br>
    <button type="submit"> Entrar </button>
  </form>
  <?php
    if(isset($error)) {
      echo $error;
    }
  ?>

</body>

</html>