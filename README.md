# 🧰 Projeto MVC em PHP com Docker

Este é um projeto desenvolvido com arquitetura MVC em PHP, utilizando Docker para gerenciamento de ambiente e diversas bibliotecas para garantir organização, segurança e facilidade de manutenção.

---

## ✅ Requisitos

- [Docker](https://www.docker.com/products/docker-desktop)

---

## 🚀 Como rodar o projeto com Docker

1. **Clone o repositório:**

```bash
git clone https://github.com/Luissgcz/php-user-management
```

2. **Copie o arquivo `.env.example` para `.env` e Editar as Variaveis:**

```bash
cp .env.example .env
```

3. **Suba os containers com Docker Compose:**

```bash
docker-compose up -d --build
```

4. **Acesse o container da aplicação:**

```bash
docker exec -it mvc-app bash
```

5. **Instale as dependências PHP:**

```bash
composer install
```

6. **Rode as migrations:**

```bash
vendor/bin/phinx migrate -c database/phinx.php
```

7. **Rode as seeds (dados iniciais):**

```bash
vendor/bin/phinx seed:run -c database/phinx.php
```

---

## 📦 Tecnologias e bibliotecas utilizadas

- **PHP 8.2**
- **Docker**
- **MySQL**
- **Apache**
- **Composer**
- **Javascript** 
- **API REST** – Consumida via AJAX pelo frontend
- **Monolog** – Geração de logs
- **Phinx** – Migrations e seeds versionadas
- **Dotenv** – Gerenciamento de variáveis de ambiente
- **Rakit Validation** – Validação de formulários
- **Bootstrap 5** – Estilização front-end


---

## 🗂️ Estrutura do Projeto

```
📁 app/                      # Código da aplicação (controllers, models, views, etc)
📁 database/                 # Migrations, seeds e configuração do banco (phinx.php)
📁 logs/                     # Logs gerados pela aplicação (Monolog)
📁 public/                   # Pasta pública, serve arquivos estáticos e index.php
📁 routes/                   # Arquivos de rotas
📁 src/                      # Código-fonte adicional / classes / serviços
📁 storage/                  # Arquivos armazenados (upload, cache)
📁 vendor/                   # Dependências instaladas via Composer
.env                        # Variáveis de ambiente
apache.conf                 # Configuração do Apache
docker-compose.yml          # Orquestração dos containers Docker
Dockerfile                  # Dockerfile para construir a imagem da aplicação
index.php                   # Front controller da aplicação

```

---

## 🐞 Lista de erros personalizados

| Código | Local               | Descrição                   |
| ------ | ------------------- | --------------------------- |
| 001    | DbConnection.php    | Erro de conexão com o banco |
| 002    | LoadPageAdm.php     | Página não encontrada       |
| 003    | LoadPageAdm.php     | Controller não encontrado   |
| 004    | LoadPageAdm.php     | Método não encontrado       |
| 005    | LoadViewService.php | View não encontrada         |

---

## ✍️ Autor

Luis Cruz  
[LinkedIn](https://www.linkedin.com/in/luis-guilherme-cruz-01ba1023a/)

---
