# Usa imagem oficial do PHP com Apache já instalado
FROM php:8.2-apache

# Instala extensões necessárias para conexão com banco (modifique se for PostgreSQL)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativa o módulo mod_rewrite do Apache para funcionar .htaccess
RUN a2enmod rewrite

# Copia seu arquivo de configuração do Apache (vamos criar esse arquivo também)
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Instala o Composer dentro do container (copia do container oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório padrão de trabalho do container
WORKDIR /var/www/html

# Copia **todos os arquivos do seu projeto local** (o `.`) para dentro do container (no `/var/www/html`)
COPY . .

# 👇 Isso significa:
# .          → representa a raiz do seu projeto local
# /var/www/html → é o local dentro do container onde o Apache espera os arquivos