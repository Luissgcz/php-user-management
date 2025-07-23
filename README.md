
# 🧰 Projeto MVC em PHP com Docker

📌 Esta é a **branch principal** do projeto (`master`), destinada ao código-fonte completo e instruções de execução local via Docker.  
Para visualizar a versão da aplicação com configurações específicas de produção (deploy), acesse a branch [`deploy`](https://github.com/Luissgcz/php-user-management/tree/deploy).

Este é um projeto completo desenvolvido com arquitetura MVC em PHP, utilizando Docker para gerenciamento do ambiente, além de diversas bibliotecas para garantir organização, segurança e facilidade de manutenção.

A aplicação conta com autenticação de usuários, chat entre usuários, upload de imagens, geração de logs, controle de sessões e muito mais.

---

## ✅ Requisitos

- [Docker](https://www.docker.com/products/docker-desktop)

---

## 🚀 Como rodar o projeto com Docker

1. **Clone o repositório:**

```bash
git clone https://github.com/Luissgcz/php-user-management
```

2. **Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente:**

```bash
cp .env.example .env
```

3. **Suba os containers com Docker Compose:**

```bash
docker-compose up -d --build
```

4. **Execute as migrations:**

```bash
docker exec -it mvc-app vendor/bin/phinx migrate -c database/phinx.php
```

5. **Execute as seeds (dados iniciais):**

```bash
docker exec -it mvc-app vendor/bin/phinx seed:run -c database/phinx.php
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
- **Monolog** – Geração de logs da aplicação
- **Phinx** – Migrations e seeds versionadas
- **Dotenv** – Gerenciamento seguro de variáveis de ambiente
- **Rakit Validation** – Validação de formulários
- **PHPMailer** – Recuperação de senha por e-mail
- **Bootstrap 5** – Estilização responsiva do front-end

---

## 💬 Funcionalidades principais

- Autenticação de usuários com CSRF Token e controle de sessão
- CRUD completo com interface dinâmica via modais (Ajax)
- Upload de imagem de perfil com tratamento seguro
- Sistema de **chat entre usuários**
- Validação de formulários no backend
- Geração de logs com **Monolog**
- Deploy com ambiente Docker (Apache + PHP + MySQL)
- Configuração de servidor com `.htaccess` (URLs amigáveis)
- Organização de rotas, controllers e views com arquitetura MVC

---

## 🗂️ Estrutura do Projeto

```
📁 app/                      # Código principal da aplicação (Controllers, Models, Views)
📁 database/                 # Migrations, seeds e config do banco (phinx.php)
📁 logs/                     # Logs gerados pela aplicação (Monolog)
📁 public/                   # Arquivos públicos (index.php, imagens, etc)
📁 routes/                   # Definições de rotas da aplicação
📁 src/                      # Classes auxiliares e serviços
📁 storage/                  # Arquivos armazenados (uploads, cache)
📁 vendor/                   # Dependências gerenciadas pelo Composer
.env                        # Arquivo de variáveis de ambiente
apache.conf                 # Configuração personalizada do Apache
docker-compose.yml          # Orquestração dos containers com Docker
Dockerfile                  # Dockerfile da aplicação
index.php                   # Front controller da aplicação
```

---

## 🐞 Códigos de erro personalizados

| Código | Arquivo             | Descrição                   |
|--------|---------------------|-----------------------------|
| 001    | DbConnection.php    | Erro de conexão com o banco |
| 002    | LoadPageAdm.php     | Página não encontrada       |
| 003    | LoadPageAdm.php     | Controller não encontrado   |
| 004    | LoadPageAdm.php     | Método não encontrado       |
| 005    | LoadViewService.php | View não encontrada         |

---

## ✍️ Autor

**Luis Cruz**  
🔗 [LinkedIn](https://www.linkedin.com/in/luis-guilherme-cruz-01ba1023a/)
