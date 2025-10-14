<?php

function divisao (int $a, int $b): float {
    return $a / $b;
}

$x = 20;

// altere o valor de $y
// 0 para testar DivisionByZeroError
// "aaa" para testar outro tipo de Error
$y = 5;

try {
    echo divisao($x, $y);
} catch (DivisionByZeroError $e) {
    echo "Houve um erro de divisão por zero.";
} catch (Error $e) {
    echo "Houve outro erro e não foi divisão por zero.";
}

