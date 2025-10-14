<?php

$numeros = [1, 2, 3, 4, 5];

try {
    echo $numeros[10];
} catch (Exception $e) {
    echo "Houve um problema!";
}