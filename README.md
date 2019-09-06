# bling-php-sdk
PHP SDK (não oficial) para Bling ERP

## Criando o cliente de configuração e autenticação

```php
use Bling\Core\Config;
use Bling\BlingClient;

$apitoken = '1234';

$client = new BlingClient(Config::configure($apitoken));

```

## Contatos

use os seguintes métodos abaixo para trabalhar com a API de contatos da Bling.

### Listar Contatos

```php
try {
  $listarContatos = $client->getAllContatos();
  print_r($listarContatos);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

```
