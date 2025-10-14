<?php

function error_handler($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("error_handler");


$numeros = [1, 2, 3, 4, 5];

try {
    echo $numeros[10];
} catch (Exception $e) {
    echo "Houve um problema: " . $e->getMessage();
}