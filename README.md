# 🧰 Projeto MVC em PHP com Docker

Este é um projeto desenvolvido com arquitetura MVC em PHP, utilizando Docker para gerenciamento de ambiente e diversas bibliotecas para garantir organização, segurança e facilidade de manutenção.

---

## ✅ Requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop)

---

## 🚀 Como rodar o projeto com Docker

1. **Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/seu-repo.git
cd seu-repo
```

2. **Copie o arquivo `.env.example` para `.env`:**

```bash
cp .env.example .env
```

3. **Verifique as variáveis de ambiente do banco de dados (no `.env`):**

```env
DB_HOST=db
DB_USER=admin
DB_PASS=admin
DB_NAME=dblocal
```

4. **Suba os containers com Docker Compose:**

```bash
docker-compose up -d --build
```

5. **Acesse o container da aplicação:**

```bash
docker exec -it mvc-app bash
```

6. **Instale as dependências PHP:**

```bash
composer install
```

7. **Rode as migrations:**

```bash
vendor/bin/phinx migrate -c database/phinx.php
```

8. **Rode as seeds (dados iniciais):**

```bash
vendor/bin/phinx seed:run -c database/phinx.php
```

---

## 📦 Tecnologias e bibliotecas utilizadas

- **PHP 8.2**
- **Docker + Docker Compose**
- **PostgreSQL ou MySQL (via container)**
- **Monolog** – Geração de logs
- **Phinx** – Migrations e seeds versionadas
- **Dotenv** – Gerenciamento de variáveis de ambiente
- **Rakit Validation** – Validação de formulários

---

## 🗂️ Estrutura do Projeto

```
📁 app/
   ├── adms/                  # Módulo principal (ex: controllers, models, views)
   └── core/                  # Núcleo da aplicação (autoload, config, helpers)
📁 database/
   ├── migrations/            # Arquivos de versionamento do banco
   ├── seeds/                 # Seeds com dados iniciais
   └── phinx.php              # Configuração do Phinx
📁 public/                    # Pasta pública acessada pelo navegador
📁 vendor/                    # Bibliotecas instaladas via Composer
.env                         # Variáveis de ambiente
docker-compose.yml           # Orquestração dos containers
Dockerfile                   # Imagem da aplicação
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
[LinkedIn](https://www.linkedin.com/in/seu-perfil)

---

## 📸 Sugestão para divulgação

Recomenda-se postar no LinkedIn com:

- Print da tela inicial ou da área administrativa
- Link para o repositório no GitHub
- Breve descrição das funcionalidades
- (Opcional) Vídeo curto navegando pela aplicação

---

## 🧪 Testes e Qualidade

> Ainda não implementado. Próximos passos podem incluir:

- Testes automatizados com PHPUnit
- Linter de código PHP
- Análise de cobertura de código
