<?php

require("./conexao_banco.php");

$table_users = 
 "CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=InnoDB;"
;

$table_tasks = 
  "CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  is_urgent TINYINT(1) DEFAULT 0,
  is_completed TINYINT(1) DEFAULT 0,
  user_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE=InnoDB;"
;

$users = [
  ["Admnistrador do Sistema", "admin@email.com", password_hash("admin123", PASSWORD_DEFAULT), 1],
  ["Alvirinha Souza", "alvirinha@email.com", password_hash("alvirinha", PASSWORD_DEFAULT), 0],
  ["Elesbão Silva", "elesbao@email.com", password_hash("elesbao", PASSWORD_DEFAULT), 0],
  ["Dorotéia Virsh", "doroteia@email.com", password_hash("doroteia", PASSWORD_DEFAULT), 0],
  ["Genoveva da Rocha", "genoveva@email.com", password_hash("genoveva", PASSWORD_DEFAULT), 0],
  ["Bernardino Costa", "bernardino@email.com", password_hash("bernardino", PASSWORD_DEFAULT), 0],
];

$tasks = [
  ['title' => 'Implementar autenticação JWT', 'is_urgent' => 1, 'is_completed' => 0, 'user_id' => 2],
  ['title' => 'Revisar documentação do sistema', 'is_urgent' => 0, 'is_completed' => 1, 'user_id' => 2],
  ['title' => 'Criar testes unitários', 'is_urgent' => 1, 'is_completed' => 0, 'user_id' => 2],
  ['title' => 'Configurar banco de dados', 'is_urgent' => 0, 'is_completed' => 0, 'user_id' => 3],
  ['title' => 'Otimizar consultas SQL', 'is_urgent' => 1, 'is_completed' => 1, 'user_id' => 3],
  ['title' => 'Desenvolver tela de login', 'is_urgent' => 1, 'is_completed' => 0, 'user_id' => 4],
  ['title' => 'Ajustar layout responsivo', 'is_urgent' => 0, 'is_completed' => 1, 'user_id' => 4],
  ['title' => 'Corrigir bug no formulário', 'is_urgent' => 1, 'is_completed' => 0, 'user_id' => 4],
  ['title' => 'Implementar cache com Redis', 'is_urgent' => 1, 'is_completed' => 0, 'user_id' => 5],
  ['title' => 'Atualizar dependências do projeto', 'is_urgent' => 0, 'is_completed' => 0, 'user_id' => 5],
  ['title' => 'Gerar relatório mensal', 'is_urgent' => 0, 'is_completed' => 1, 'user_id' => 5],
  ['title' => 'Criar API de tarefas', 'is_urgent' => 1, 'is_completed' => 0, 'user_id' => 6],
  ['title' => 'Testar integração com frontend', 'is_urgent' => 0, 'is_completed' => 1, 'user_id' => 6]
];

try {
  $conn->exec($table_users);
  $conn->exec($table_tasks);

  $conn->beginTransaction();
  $st = $conn->prepare("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, ?)");
  foreach ($users as $user) {
    $st->execute($user);
  }

  $st = $conn->prepare("INSERT INTO tasks (title, is_urgent, is_completed, user_id) VALUES (:title, :is_urgent, :is_completed, :user_id)");
  foreach ($tasks as $task) {
    $st->execute($task);
  }

  if($conn->commit()) {
    echo "funcionou legal";
  }
} catch (PDOException $pdoE) {
  $conn->rollBack();
  echo "deu merda" . $pdoE->getMessage();
}
