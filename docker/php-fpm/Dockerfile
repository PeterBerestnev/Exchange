FROM php:8.2-fpm

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Node.js и npm (актуальная LTS-версия)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Базовые PHP-расширения для Laravel
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