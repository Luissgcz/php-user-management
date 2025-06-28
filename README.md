## Requisitos

- PHP 8.3 ou superior;
- Apache;
- rewrite_module ativo no Apache;
- MySQL 8.0 ou superior;
- Composer;

## Como rodar o projeto baixado

Duplicar o arquivo ".env.example" e renomear para ".env".<br>
Alterar no arquivo .env as credenciais do banco de dados.<br>

Instalar as dependências.

```
composer install
```

Executar as migrations.

```
vendor/bin/phinx migrate -c database/phinx.php
```

Executar as Seeds.

```
vendor/bin/phinx seed:run -c database/phinx.php
```

Instalar a Biblioteca para validar o Formulário

```
composer require "rakit/validation"
```

## Sequencia para criar o projeto

Criar o arquivo composer.json com a instrução básica.

```

composer init

```

Instalar a dependencias Monolog, biblioteca PHP que permite criar arquivo de log.

```

composer require monolog/monolog

```

Instalar a biblioteca gerenciar variáveis de ambiente.

```

composer require vlucas/phpdotenv

```

Instalar a biblioteca para criar/executar migration e seed.

```

composer require robmorgan/phinx

```

Criar o arquivo "phinx.php" com as configurações e alterar as mesmas.

```

vendor/bin/phinx init -f php

```

Testar as configurações.

```

vendor/bin/phinx test

```

Criar o diretório database.

```

mkdir database/

```

Criar o diretório para migrations.

```

mkdir database/migrations/

```

Criar a migrations.

```

vendor/bin/phinx create AdmsUsers -c database/phinx.php

```

Executar as migrations.

```

vendor/bin/phinx migrate -c database/phinx.php

```

RollBack nas Migrations

```

vendor/bin/phinx rollback -c database/phinx.php

```

Criar Diretorio para os Seeds.

```

mkdir database/seeds

```

Criar a Seed

```

vendor/bin/phinx seed:Create AddAdmsUsers -c database/phinx.php

```

Executar a Seed

```

vendor/bin/phinx seed:run -c database/phinx.php

```

## Lista de erros

001 - DbConnection.php - Erro de conexão com o banco de dados
002 - LoadPageAdm.php - Não encontrou a página
003 - LoadPageAdm.php - Não encontrou a controller
004 - LoadPageAdm.php - Não encontrou o método
005 - LoadViewService.php - Não encontrou a view

```

```
