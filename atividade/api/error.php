<?php

class APIException extends Exception {
   function __construct(string $message, int $code = 500)
   {
      //recebe a mensagem personalizada e o código que será o código de status HTTP
      //se o código não for informado, usa o 500 - Internal Server Error
      //chama o construtor da superclasse passando a mensagem e o código
      parent::__construct($message, $code);
   }
}

// CLASSES DE EXCEÇÃO ESPECÍFICAS