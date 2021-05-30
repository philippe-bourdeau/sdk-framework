FROM php:8-alpine

ARG XDEBUG_VERSION='3.0.4'

RUN apk add --no-cache --update --virtual buildDeps \
 autoconf \
 gcc \
 make \
 g++ \
 zlib-dev \
 libxml2-dev \
 php-xml \
 php-mbstring \
 php-dom \
    && pecl install xdebug-$XDEBUG_VERSION \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install xml \
    && apk del buildDeps \
    && rm -rf /var/cache/apk/*

ADD xdebug.ini $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

RUN curl -s http://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/  \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer;

WORKDIR /var/www/html
ENV PATH="./vendor/bin:${PATH}"

RUN addgroup -g 1000 -S docker-www-data; \
    adduser -u 1000 -D -S -G docker-www-data docker-www-data

USER docker-www-data

CMD ["tail", "-f", "/dev/null"]
