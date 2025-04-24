FROM php:8.2-fpm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install -y \
        libzip-dev \      
        libssl-dev \      
    && docker-php-ext-install \
        zip \              
        opcache \          
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

COPY ./ ./

RUN composer install
RUN npm install
RUN php artisan key:generate
RUN php artisan l5-swagger:generate

RUN chmod -R 777 /var/www/storage && chmod -R 777 /var/www/bootstrap/cache