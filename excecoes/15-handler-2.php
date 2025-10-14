<?php

function exception_handler(Throwable $e) {
    echo "Houve um problema: " . $e->getMessage();
}
set_exception_handler("exception_handler");


echo 20 / 0; // altere para testar a exceção
echo "\nSe chegou aqui, não houve exceção.";
