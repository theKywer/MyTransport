FROM php:8.3-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nano \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка PHP расширений
RUN docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath sockets

# Установка Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Настройка Xdebug (для дебага извне — Docker)
RUN { \
    echo 'xdebug.mode=debug'; \
    echo 'xdebug.start_with_request=yes'; \
    echo 'xdebug.client_host=host.docker.internal'; \
    echo 'xdebug.client_port=9003'; \
    echo 'xdebug.log_level=0'; \
    echo 'xdebug.log=/var/www/html/storage/logs/xdebug.log'; \
    echo 'xdebug.discover_client_host=false'; \
    echo 'xdebug.idekey=VSCODE'; \
} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Создаём папку для логов
RUN mkdir -p /var/www/html/storage/logs

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/html

# Запуск PHP-FPM
CMD ["php-fpm"]
