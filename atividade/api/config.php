<?php

// NÃO MEXA NO CÓDIGO ABAIXO

require_once 'error.php';

function handleError($severity, $message, $file, $line) {
    // Converte erros em exceções
    throw new ErrorException($message, 0, $severity, $file, $line);
}

function handleException(Throwable $e) {
    if ($e instanceof APIException) {
        //Para as exceções previstas e geradas na própria API
        http_response_code($e->getCode());
        echo json_encode(['message' => $e->getMessage()]);
    } else {
        //Para as exceções não previstas, geradas pelo PHP
        http_response_code(500);
        echo $e->getMessage();
        echo json_encode(['message' => 'Unable to process this request!']);
    }
}

set_error_handler('handleError');
set_exception_handler('handleException');

$bd = __DIR__ . '/bd.sqlite';

try {
    $conn = new PDO("sqlite:$bd");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}