FROM composer:2.5 AS composer

COPY ./ /app

WORKDIR /app

RUN composer install --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader

FROM php:8.0.13-fpm-alpine AS production

COPY --from=composer /app/app /app/app
COPY --from=composer /app/bootstrap /app/bootstrap
COPY --from=composer /app/config /app/config
COPY --from=composer /app/database /app/database
COPY --from=composer /app/public /app/public
COPY --from=composer /app/resources /app/resources
COPY --from=composer /app/routes /app/routes
COPY --from=composer /app/storage /app/storage
COPY --from=composer /app/artisan /app/artisan

WORKDIR /app

RUN apk update \
    && apk add --update linux-headers \
    && apk add  --no-cache git mysql-client curl libmcrypt libmcrypt-dev openssh-client icu-dev \
    libxml2-dev libzip-dev freetype-dev libpng-dev libjpeg-turbo-dev g++ make autoconf curl-dev openssl-dev \
    && docker-php-source extract \
    && docker-php-ext-install pdo_mysql intl zip \
    && docker-php-source delete \
    && rm -rf /tmp/*

RUN apk add gnu-libiconv --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted

ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

USER app

CMD ["php-fpm", "-F"]

EXPOSE 9003
