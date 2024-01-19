FROM php:8.2-cli-bullseye
MAINTAINER Sprint-F

ENV PHP_MEMORY_LIMIT    -1
ENV ERROR_REPORTING     E_ALL

RUN docker-php-ext-install -j$(nproc) pcntl

RUN curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer


RUN echo "memory_limit = ${PHP_MEMORY_LIMIT}" >> /usr/local/etc/php/php.ini && \
    echo "display_errors = Off" >> /usr/local/etc/php/php.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/php.ini && \
    echo "html_errors = Off" >> /usr/local/etc/php/php.ini && \
    echo "error_log = /dev/stderr" >> /usr/local/etc/php/php.ini && \
    echo "error_reporting = ${ERROR_REPORTING}" >> /usr/local/etc/php/php.ini

COPY --chown=www-data:www-data . /app
WORKDIR /app

RUN composer install --no-scripts