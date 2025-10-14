<?php

$x = 20;
// $y = 5; // altere para 0 para testar o catch
$y = 0; // altere para 0 para testar o catch

try {
    $z = $x / $y;
    echo $z;
} catch (Error $e) {
    echo "Não é possível dividir por zero.";
}