<?php

require_once "config.php";

// Apaga se existir e então cria a tabela 'users'
$conn->exec("DROP TABLE IF EXISTS users");
$conn->exec("CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    is_admin BOOLEAN NOT NULL DEFAULT 0,
    password TEXT NOT NULL
)");
echo "Tabela 'users' criada com sucesso...\n";

// Alguns usuários de exemplo
$users = [
    ['name' => 'Alvirinha', 'email' => 'alvirinha@email.com', 'is_admin' => 0, 'password' => password_hash('alvirinha', PASSWORD_DEFAULT)],
    ['name' => 'Bernardino', 'email' => 'bernardino@email.com', 'is_admin' => 0, 'password' => password_hash('bernardino', PASSWORD_DEFAULT)],
    ['name' => 'Carlota', 'email' => 'carlota@email.com', 'is_admin' => 0, 'password' => password_hash('carlota', PASSWORD_DEFAULT)],
    ['name' => 'Derivaldo', 'email' => 'derivaldo@email.com', 'is_admin' => 0, 'password' => password_hash('derivaldo', PASSWORD_DEFAULT)],
    ['name' => 'Elesbão', 'email' => 'elesbao@email.com', 'is_admin' => 1, 'password' => password_hash('elesbao', PASSWORD_DEFAULT)],
    ['name' => 'Felícia', 'email' => 'felicia@email.com', 'is_admin' => 0, 'password' => password_hash('felicia', PASSWORD_DEFAULT)],
    ['name' => 'Genoveva', 'email' => 'genoveva@email.com', 'is_admin' => 1, 'password' => password_hash('genoveva', PASSWORD_DEFAULT)],
];

// Insere os usuários na tabela
$stmt = $conn->prepare("INSERT INTO users (name, email, is_admin, password) 
                    VALUES (:name, :email, :is_admin, :password)");
foreach ($users as $user) {
    $stmt->execute($user);
}
echo "Usuários inseridos com sucesso...\n";