FROM php:8-fpm

RUN apt-get update -y \
    && apt-get install -y zip git wait-for-it \
    && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /usr/src/app
RUN chown -R www-data:www-data /var/www

WORKDIR /usr/src/app
