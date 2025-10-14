# Atividade sobre Tratamento de Exceções

O PHP permite criar exceções personalizadas para representar erros específicos da aplicação. Elas tornam o código mais legível e facilitam o tratamento centralizado de falhas.

## Preparação

### Para usar php -S
- No terminal, entre na pasta da atividade e rode o comando:
```bash
    php -S localhost:80
```
### Para usar o WAMP
- As pastas **api** e **app** devem estar na raiz do servidor web, ou seja, dentro de **www** do wamp. 

### Para preparar o banco
- Execute o script **setup.php** (via terminal ou navegador);

## Criando as Exceções Personalizadas

No arquivo **api/error.php** crie classes para exceções personalizadas:

1. Crie uma classe **NotAllowedException** que estenda APIException:
- chame o construtor da superclasse com a mensagem "Method Not Allowed", com o código 405.

2. Crie uma classe **BadRequestException** que estenda APIException:
- pode, opcionalmente, receber um mensagem personalizada no construtor;
- deve chamar a superclasse com a mensagem personalizada ou a padrão "Bad Request" e com o código 400

3. Crie uma classe **NotFoundException** que estenda APIException:
- pode, opcionalmente, receber um mensagem personalizada no construtor;
- deve chamar a superclasse com a mensagem personalizada ou a padrão "Resource Not Found" e com o código 404

4. Crie uma classe **ConflictException** que estenda APIException:
- pode, opcionalmente, receber um mensagem personalizada no construtor;
- deve chamar a superclasse com a mensagem personalizada ou a padrão "Conflict" e com o código 409

5. No arquivo **api/config.php**, estude a função `handleException()`, analisando como ela funciona e então verifique como ela é registrada para ser a função padrão de tratamente de exceções.

## Complete os scripts, lançando as exceções correspondentes

Estudo o funcionamento de cada um dos scripts dentro de **api/users** e lance as exceções correspondentes nos pontos indicados.

1. No arquivo **list.php**:
- Exceção para método não permitido

2. No arquivo **get.php**:
- Exceção para método não permitido
- Exceção para id ausente ou inválido: "Invalid or missing user id"
- Exceção para usuário não encontrado: "User not found"

3. No arquivo **add.php**:
- Exceção para método não permitido
- Exceção quando o corpo da requisição não está em JSON: "Invalid JSON"
= Exceção para campos ausentes ou inválidos: "Missing or invalid required fields"
- Exceção para e-mail em uso: "Email already in use"

4. No arquivo **update.php**:
- Exceção para método não permitido
- Exceção quando o corpo da requisição não está em JSON: "Invalid JSON"
= Exceção para campos ausentes ou inválidos: "Missing or invalid required fields"
- Exceção para usuário não encontrado: "User not found"
- Exceção para e-mail em uso: "Email already in use"

5. No arquivo **delete.php**:
- Exceção para método não permitido
- Exceção para id ausente ou inválido: "Invalid or missing user id"
- Exceção para usuário não encontrado: "User not found"

6. No arquivo **set_admin.php**:
- Exceção para método não permitido
- Exceção quando o corpo da requisição não está em JSON: "Invalid JSON"
= Exceção para campos ausentes ou inválidos: "Missing or invalid required fields"
- Exceção para usuário não encontrado: "User not found"

## Como testar
- Você pode testar com as requisições do arquivo **req.http**.
- Há, ainda, uma aplicação que consome api em **/app/users.html**