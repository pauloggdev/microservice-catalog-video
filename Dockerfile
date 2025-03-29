FROM php:8.1.10-apache

# Habilitar extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Configurar o Apache para usar o diretório public
WORKDIR /var/www
COPY . .
RUN chown -R www-data:www-data /var/www
RUN a2enmod rewrite