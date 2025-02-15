FROM php:8.2-fpm

# Установка необходимых зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql pgsql mysqli zip intl mbstring xml gd curl opcache

# Установка расширений через PECL
RUN pecl install apcu redis xdebug \
    && docker-php-ext-enable apcu redis xdebug

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Создание пользователя www-data (если он не существует)
RUN if ! id -u www-data > /dev/null 2>&1; then \
        adduser --disabled-password --gecos '' --uid 1000 --gid 1000 www-data; \
    fi

# Копирование конфигурационных файлов
COPY php.ini /usr/local/etc/php/conf.d/
COPY xdebug.ini /usr/local/etc/php/conf.d/
COPY www.conf /usr/local/etc/php-fpm.d/

# Создание рабочей директории и настройка прав
RUN mkdir -p /var/www
RUN chown -R www-data:www-data /var/www

# Установка рабочей директории
WORKDIR /var/www/laravel

# Команда для запуска PHP-FPM
CMD ["php-fpm"]

# Открытие порта для PHP-FPM
EXPOSE 9001