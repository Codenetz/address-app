FROM php:fpm-alpine
COPY --from=composer:2.6  /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY . /var/www
EXPOSE 9000
CMD ["sh", "-c", "composer dump-autoload --no-scripts --optimize && php-fpm"]