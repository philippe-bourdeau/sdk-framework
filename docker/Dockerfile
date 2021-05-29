FROM php:fpm-alpine

RUN apk add --no-cache --update --virtual buildDeps autoconf gcc make g++ zlib-dev libxml2-dev \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install xml \
    && apk del buildDeps \
    && rm -rf /var/cache/apk/*

ADD xdebug.ini $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

RUN curl -s http://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/  \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer;

CMD ["tail", "-f", "/dev/null"]
