<?php

require_once("./conexao_banco.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_SESSION["user_id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) {
    $sql = "SELECT * FROM users";
    $st = $conn->prepare($sql);
    $st->execute();

    $users = $st->fetchAll();
    // var_dump($users);

  } else {
    header("Location: index.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Usuários </title>
</head>

<body>
  <table border="1">
    <tr>
      <th> Usuário </th>
      <th> Email </th>
    </tr>

    <?php
    if (isset($users) && !empty($users)) {
      foreach($users as $user => $valor) 
      {
        echo 
        "<tr>
          <td> {$valor["name"]} </td>
          <td> {$valor["email"]} </td>
        </tr>";
      }
    }
    ?>
  </table>
  
  <a href="http://localhost/back-end-02/atividade01/index.php"> Voltar ao Menu </a>
</body>

</html>