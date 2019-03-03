FROM php:7.1-fpm-alpine

RUN apk update && apk add \
  build-base \
  curl-dev \
  libwebp-dev \
  zlib-dev \
  libxpm-dev \
  freetype-dev \
  libjpeg-turbo-dev \
  libpng-dev
  
RUN docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-webp-dir=/usr/include/  \
    --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install \
    curl \
    gd \
    zip \
    pdo_mysql

WORKDIR /var/www/html

EXPOSE 9000
