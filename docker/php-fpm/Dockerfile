FROM php:8.2-fpm

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Node.js и npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

# Установка необходимых пакетов
RUN apt-get update \
    && apt-get install -y \
    libzip-dev \
    libgd-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libmagickwand-dev \
    nodejs \  # Добавляем Node.js (включает npm)
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install \
    zip \
    gd \
    exif \
    intl

WORKDIR /var/www