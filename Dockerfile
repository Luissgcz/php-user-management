# Imagem do Apache
FROM php:8.2-apache

# Instalando PDO 
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Ativando o mod_rewrite do Apache para funcionar o .htaccess
RUN a2enmod rewrite

# Copiando o Arquivo de Configuração Apache pra Dentro do Cont
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Definindo Diretório padrão Interno do Container
WORKDIR /var/www/html

# Copiando tudo os Arquivos para o Cont `/var/www/html`
COPY . .

