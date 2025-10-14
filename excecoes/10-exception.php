<?php

function notaFinal(float $prova, float $trabalho): float {
    if ($prova < 0 || $prova > 10 || $trabalho < 0 || $trabalho > 10) {
        throw new InvalidArgumentException("Notas devem estar entre 0 e 10.");
    }
    return $prova * 0.7 + $trabalho * 0.3;
}

$prova = 4;
$trabalho = 10; 
// altere para testar a exceção
// 15 para ser tratada
// "aa" para não ser tratada

// $trabalho = 15; 
$trabalho = "aaa"; 

try {
    echo "A sua nota final é " . notaFinal($prova, $trabalho);
} catch (InvalidArgumentException $e) {
    echo "Erro: " . $e->getMessage();
}
