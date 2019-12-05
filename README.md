# Projeto

## Exemplo

### Link do sistema Hospedado

[projeto](http://projeto.gvpadilha.com.br)

### Usuários
##### Administrador
###### Email: admin@email.com Senha: 123456789
##### Usuário
###### Email: user@email.com Senha: 123456789


## Sistema Gerenciador de Produtos

Sistema de cadastro de produtos com dois níveis de usuário, usuário administrador pode adicionar, visualizar, editar e remover produtos, usuários, marcas e categorias. O usuário normal pode apenas listar produtos, categorias e marcas.

### Pré-requisitos


```
PHP >= 7.0
mod_rewrite ativado
apache com permissão de escrita no diretório do sistema
```

### Instalação

Clone o projeto no diretório em que irá rodar, será necessário editar o arquivo .htaccess, config.php e environment.php


No arquivo config.php será configurado a URL em que o sistema irá ser acessado, email que enviará recuperação de senha e banco de dados, tendo opção de rodar em modo desenvolvimento ou produção, qual modo é utilizado será configurado no arquivo environment.php 

### config.php

```
<?php

require 'environment.php';

$config = array();

if( ENVIRONMENT == 'development' ):
    define('EMAIL_RECUPERA', 'exemplo@exemplo.com.br');
    define('BASE_URL', 'http://localhost/projeto/'); 
    $config['dbname'] = 'projeto'; //nome do banco de dados
    $config['host'] = 'localhost'; //endereço do banco de dados
    $config['username'] = ''; //usuario do banco de dados
    $config['password'] = ''; //senha do banco de dados
else:
    define('EMAIL_RECUPERA', '');
    define('BASE_URL', '');
    $config['dbname'] = '';
    $config['host'] = '';
    $config['username'] = '';
    $config['password'] = '';
endif;

global $pdo;

try{
    $pdo = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['username'], $config['password']);
} catch(PDOException $e){
    echo "ERRO: ".$e->getMessage();
    exit;
}


?>

```

### environment.php

comente linha que não será utilizado, no exemplo abaixo o sistema estará em modo desenvolvimento.

```
<?php

define('ENVIRONMENT', 'development');
//define('ENVIRONMENT', 'production');

?>
```

### .htaccess

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /projeto/index.php?url=$1 [QSA,L]

```


## Banco de dados

#### no arquivo projeto.sql está o banco de dados necessário para o funcionamento do sistema

