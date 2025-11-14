<?php 

require_once "connection.php";

try {
  $conn->exec("DROP TABLE IF EXISTS usuarios");
  
  $sql = "CREATE TABLE usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL
  )";

  $conn->exec($sql);
  echo "Tabela 'usuarios' criada com sucesso! <br>";

  $stmt = $conn->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");

  $usuarios = [
    ['João Silva', 'joao.silva@email.com'],
    ['Maria Santos', 'maria.santos@email.com'],
    ['Pedro Oliveira', 'pedro.oliveira@email.com'],
    ['Ana Costa', 'ana.costa@email.com'],
    ['Carlos Souza', 'carlos.souza@email.com'],
    ['Juliana Lima', 'juliana.lima@email.com'],
    ['Roberto Alves', 'roberto.alves@email.com'],
    ['Fernanda Rocha', 'fernanda.rocha@email.com'],
    ['Lucas Martins', 'lucas.martins@email.com'],
    ['Patrícia Ferreira', 'patricia.ferreira@email.com'],
    ['Ricardo Mendes', 'ricardo.mendes@email.com'],
    ['Camila Ribeiro', 'camila.ribeiro@email.com']
  ];

  $usuariosInseridos = 0;
  foreach ($usuarios as $usuario) {
    $stmt->execute($usuario);
    $usuariosInseridos++;
  }

  echo $usuariosInseridos . " usuarios inseridos com sucesso! <br>";
} catch (PDOException $e) {
  die("Erro ao configurar o banco de dados: " . $e->getMessage());
}