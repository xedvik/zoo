FROM php:7.4-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
    cron \
    netcat-traditional \
    && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql

# Копирование crontab файла
COPY docker/cron/crontab /etc/cron.d/laravel-scheduler

# Установка прав на crontab файл
RUN chmod 0644 /etc/cron.d/laravel-scheduler && \
    crontab /etc/cron.d/laravel-scheduler

# Создание лог файла для cron
RUN touch /var/log/cron.log && \
    chown www-data:www-data /var/log/cron.log

# Установка рабочей директории
WORKDIR /var/www/html

# Создание entrypoint скрипта
RUN echo '#!/bin/sh\nservice cron start\necho "Cron started"\ntail -f /var/log/cron.log' > /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh

# Запуск entrypoint скрипта
CMD ["/usr/local/bin/entrypoint.sh"]
