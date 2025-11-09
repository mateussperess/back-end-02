<?php

require_once 'connection.php';

try {
  $conn->exec("DROP TABLE IF EXISTS usuarios");

  $sql = "CREATE TABLE usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL,
        idade INTEGER NOT NULL,
        cidade TEXT NOT NULL
  )";

  $conn->exec($sql);
  echo "tabela 'usuarios' criada com sucesso<br>";

  $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, idade, cidade) VALUES (?, ?, ?, ?)");

  $usuarios = [
    ['João Silva', 'joao.silva@email.com', 28, 'Porto Alegre'],
    ['Maria Santos', 'maria.santos@email.com', 34, 'São Paulo'],
    ['Pedro Oliveira', 'pedro.oliveira@email.com', 22, 'Rio de Janeiro'],
    ['Ana Costa', 'ana.costa@email.com', 41, 'Belo Horizonte'],
    ['Carlos Souza', 'carlos.souza@email.com', 19, 'Curitiba'],
    ['Juliana Lima', 'juliana.lima@email.com', 30, 'Salvador'],
    ['Roberto Alves', 'roberto.alves@email.com', 45, 'Brasília'],
    ['Fernanda Rocha', 'fernanda.rocha@email.com', 27, 'Fortaleza'],
    ['Lucas Martins', 'lucas.martins@email.com', 33, 'Recife'],
    ['Patrícia Ferreira', 'patricia.ferreira@email.com', 38, 'Manaus'],
    ['Ricardo Mendes', 'ricardo.mendes@email.com', 25, 'Belém'],
    ['Camila Ribeiro', 'camila.ribeiro@email.com', 29, 'Goiânia']
  ];

  $usuariosInseridos = 0;
  foreach ($usuarios as $usuario) {
    $stmt->execute($usuario);
    $usuariosInseridos++;
  }

  echo $usuariosInseridos . ' usuarios inseridos com sucesso <br>';
} catch (PDOException $pdoE) {
  die("Erro ao configurar o banco de dados: " . $pdoE->getMessage());
}
