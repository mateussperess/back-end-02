<?php

function divisao (int $a, int $b): float | string {
    try {     
        return $a / $b;
    } catch (Error $e) {
        return "impossível";
    } finally {
        echo "\nCódigo no finally sempre executa.";
    }
    echo "\nEsse código nunca executa....";
}

$x = 20;
// $y = 5; // altere para 0 para testar o catch
$y = 0; // altere para 0 para testar o catch
echo "\n$x dividido por $y é " . divisao($x, $y);