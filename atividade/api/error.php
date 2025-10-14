<?php

class APIException extends Exception
{
   function __construct(string $message, int $code = 500)
   {
      //recebe a mensagem personalizada e o código que será o código de status HTTP
      //se o código não for informado, usa o 500 - Internal Server Error
      //chama o construtor da superclasse passando a mensagem e o código
      parent::__construct($message, $code);
   }
}

// CLASSES DE EXCEÇÃO ESPECÍFICAS

class NotAllowedException extends APIException
{
   function __construct(string $message = "Method not allowed", int $code = 405)
   {
      parent::__construct($message, $code);
   }
}

class BadRequestException extends APIException
{
   function __construct(string $message = "Bad Request", int $code = 400)
   {
      parent::__construct($message, $code);
   }
}

class NotFoundException extends APIException
{
   function __construct(string $message = "Resource Not Found", int $code = 404)
   {
      parent::__construct($message, $code);
   }
}

class ConflictException extends APIException
{
   function __construct(string $message = "Conflict", int $code = 409)
   {
      parent::__construct($message, $code);
   }
}
