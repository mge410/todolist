FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update \
 && apt-get install --assume-yes --no-install-recommends --quiet \
    build-essential \
    libmagickwand-dev \
 && apt-get clean all

RUN pecl install imagick \
 && docker-php-ext-enable imagick

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

RUN mkdir -p /var/www/storage/logs && \
    touch /var/www/storage/logs/laravel.log && \
    chown -R www-data:www-data /var/www/storage && \
    chown -R www-data:www-data /var/www/storage/logs && \
    chmod -R 775 /var/www/storage/logs

WORKDIR /var/www
