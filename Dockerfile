FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    nginx \
    supervisor

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql zip mbstring exif pcntl bcmath

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /var/www/html

## Se for rodar apenas dentro da imagem sem o docker-compose descomente as linhas abaixo

#COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN composer install --no-dev --optimize-autoloader
#
#RUN chown -R www-data:www-data /var/www/html
#RUN chmod -R 755 /var/www/html/storage
#RUN chmod -R 755 /var/www/html/bootstrap/cache

COPY docker/nginx/laravel.conf /etc/nginx/sites-available/default

COPY docker/supervisor/laravel-worker.conf /etc/supervisor/conf.d/

COPY docker/startup.sh /etc/startup.sh

RUN chmod +x /etc/startup.sh

EXPOSE 8000

CMD ["/bin/bash", "/etc/startup.sh"]
