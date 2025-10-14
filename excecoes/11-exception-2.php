<?php

// alterne as linhas 6 e 7
function notaFinal(float $prova, float $trabalho): float {
    if ($prova < 0 || $prova > 10) {
        throw new Exception("A nota da prova deve ser entre 0 e 10.");
    }
    if ($trabalho < 0 || $trabalho > 10) {
        throw new Error("A nota do trabalho deve ser entre 0 e 10.");
    }
    return $prova * 0.7 + $trabalho * 0.3;
}

// $prova = 4; // altere para testar a exceção
$prova = 14; // altere para testar a exceção

$trabalho = 15; // altere para testar a exceção
// $trabalho = "aaa"; // altere para testar a exceção

try {
    echo "A sua nota final é " . notaFinal($prova, $trabalho);
} catch (Exception $e) {
    echo "Detalhes da exceção: " . $e->getMessage();
} catch (Error $e) {
    echo "\nDetalhes do erro: " . $e->getMessage();
}
