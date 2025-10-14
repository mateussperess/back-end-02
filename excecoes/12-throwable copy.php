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

$prova = 4; // altere para testar
$trabalho = 10; // altere para testar

try {
    echo "A sua nota final é " . notaFinal($prova, $trabalho);
} catch (Throwable $e) {
    echo "Erros e Exceções são Throwable.";
} catch (Error $e) {
    echo "Nunca chega aqui...";
} catch (Exception $e) {
    echo "Nunca chega aqui...";
}
