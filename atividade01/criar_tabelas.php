<?php

require("./conexao_banco.php");

$table_users = "CREATE TABLE IF NOT EXISTS users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin TINYINT(1),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
)";

$table_tasks = "CREATE TABLE IF NOT EXISTS tasks (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  is_urgent TINYINT(1),
  is_completed TINYINT(1),
  userId INT NOT NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  FOREIGN KEY (userId) REFERENCES users(id)
)";

try {
  $conn->exec($table_users); 
  $conn->exec($table_tasks); 
} catch (PDOException $pdoE) {
  echo "deu merda" . $pdoE->getMessage(); 
} 