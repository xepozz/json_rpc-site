FROM mileschou/phalcon:7.4-cli

ENV COMPOSER_ALLOW_SUPERUSER 1
COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

RUN apt-get update && apt-get install -y libpq-dev zlib1g-dev zip libzip-dev libicu-dev \
    && pecl install xdebug \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) pgsql pdo_pgsql intl zip opcache \
    && docker-php-ext-enable xdebug \
    \
    && rm -f /var/cache/apt/archives/*.deb /var/cache/apt/archives/partial/*.deb /var/cache/apt/*.bin \
    \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && composer global require hirak/prestissimo --no-plugins --no-scripts

WORKDIR /var/www
