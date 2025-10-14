<?php

class InvalidGradeException extends Exception {
    public function __construct() {
        parent::__construct("Nota deve ser um valor entre 0 e 10.");
    }
}

function notaFinal(float $prova, float $trabalho): float {
    if ($prova < 0 || $prova > 10) {
        throw new InvalidGradeException();
    }
    if ($trabalho < 0 || $trabalho > 10) {
        throw new InvalidGradeException();
    }
    return $prova * 0.7 + $trabalho * 0.3;
}

$prova = 5; // altere para testar a exceção
$trabalho = 8; // altere para testar a exceção

try {
    echo notaFinal($prova, $trabalho);
} catch (InvalidGradeException $e) { // Alterne para Exception
    echo $e->getMessage();
} catch (Throwable $e) {
    echo "Ops: " . $e->getMessage();
}
