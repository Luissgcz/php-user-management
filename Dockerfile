FROM php:8.2-apache

RUN apt-get update && apt-get install -y git unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .

RUN mkdir -p /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html \
    && chown -R www-data:www-data /var/www/html/logs \
    && chmod -R 775 /var/www/html/logs

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]