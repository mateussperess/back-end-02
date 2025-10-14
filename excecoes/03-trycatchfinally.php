<?php

$x = 20;
// $y = 5; // altere para 0 para testar o catch
$y = 0; // altere para 0 para testar o catch

try {
    $z = $x / $y;
    echo "Se chegou aqui, não houve erro: z = $z";
} catch (Error $e) {
    echo "Se entrou aqui, houve um erro: " . $e->getMessage();
} finally {
    echo "\nSempre imprime, independente de ter ocorrido erro ou não.";
}

echo "\nSe não houve return / break / continue, o script segue....";