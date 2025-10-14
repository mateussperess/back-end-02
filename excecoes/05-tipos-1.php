<?php

function divisao (int $a, int $b): float {
    return $a / $b;
}
$x = 20;

// altere o valor de $y:
// 0 para o erro ser tratado
// "aaa" para o erro não ser tratado

// $y = 5;
// $y = 0;
$y = "aaa";

try {
    echo divisao($x, $y);
} catch (DivisionByZeroError $e) {
    echo "Houve um erro de divisão por zero";
} 

