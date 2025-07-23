FROM php:8.2-apache


RUN docker-php-ext-install pdo pdo_mysql mysqli


RUN a2enmod rewrite


COPY apache.conf /etc/apache2/sites-available/000-default.conf


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html


COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction


COPY . .

RUN chown -R www-data:www-data /var/www/html