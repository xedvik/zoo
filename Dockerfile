# Dockerfile
FROM php:7.4-fpm

# Устанавливаем системные зависимости и PHP расширения
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    netcat-traditional \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    librabbitmq-dev \
    librabbitmq4 \
    libicu-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql zip bcmath sockets intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Настраиваем Git для безопасного использования репозитория
RUN git config --global --add safe.directory /var/www/html

# Копируем только composer файлы для оптимизации кэширования слоев
COPY composer.json composer.lock ./

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Копируем остальные файлы проекта
COPY . .

# Генерируем оптимизированный автозагрузчик
RUN composer dump-autoload --optimize --ignore-platform-reqs

# Создаем необходимые директории
RUN mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/cache \
    /var/www/html/bootstrap/cache

# Копируем и настраиваем entrypoint скрипт
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
