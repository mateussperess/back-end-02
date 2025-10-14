<?php

function divisao (int $a, int $b): float {
    return $a / $b;
}

$x = 20;

// altere o valor de $y
// 0 para ver que nunca entra no segundo catch
// "aaa" para testar outro tipo de Error

// $y = 5;
// $y = 0;
$y = "aaa";

try {
    echo divisao($x, $y);
} catch (Error $e) {
    echo "Houve outro erro e não sei qual foi!";
} catch (DivisionByZeroError $e) {
    echo "Nunca entra aqui, pois Error é mais genérico.";
}
