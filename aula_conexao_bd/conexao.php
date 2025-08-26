<?php

$servername = "localhost";
$username = "root";
$password = "";
$schema  = "aula_conexao_db";

$conn = new PDO("mysql:host=$servername; dbname=$schema", $username, $password, []);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);