<?php
$url = "https://68f80ffcdeff18f212b5079a.mockapi.io/api/v1/livros";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = [
    "title" => $_POST["title"],
    "author" => $_POST["author"],  
    "genre" => $_POST["genre"],    
  ];

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
  ]);

  curl_exec($ch);
  curl_close($ch);

  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($response === false) {
  echo "Erro: " . curl_error($ch);
  curl_close($ch);
  exit;
}

$livros = json_decode($response, true); 
curl_close($ch);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biblioteca - Lista de Livros</title>
</head>

<body>
  <div class="container">
    <h1>Biblioteca Virtual</h1>

    <form action="" method="post" style="display: flex; flex-direction: column;">
      <label for="title">
        <input type="text" name="title" placeholder="titulo..." required>
      </label>
      <label for="author">
        <input type="text" name="author" placeholder="autor..." required>
      </label>
      <label for="genre">
        <input type="text" name="genre" placeholder="genero..." required>
      </label>
      <button type="submit">Cadastrar Livro</button>
    </form>

    <div class="books-grid">
      <?php foreach ($livros as $livro): ?>
        <br>
        <div class="book-card">
          <div class="book-header">
            <div>
              <div class="book-title">
                <?php echo htmlspecialchars($livro['title']); ?>
              </div>
              <div class="book-author">
                por <?php echo htmlspecialchars($livro['author']); ?>
              </div>
            </div>
          </div>

          <span class="genre-tag"><?php echo htmlspecialchars($livro['genre']); ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>