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
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка PHP-расширений
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mysqli \
    mbstring \
    gd \
    exif \
    pcntl \
    bcmath \
    opcache

# Создание директории для логов
RUN mkdir -p /var/log && touch /var/log/php_errors.log
RUN chown -R www-data:www-data /var/log


# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем php.ini
COPY php.ini /usr/local/etc/php/conf.d/yii.ini

# Рабочая директория
WORKDIR /var/www/html

# Healthcheck
HEALTHCHECK --interval=10s --timeout=3s --start-period=10s --retries=3 \
    CMD php -r "exit(0);"

# Запуск PHP-FPM
CMD ["php-fpm"]