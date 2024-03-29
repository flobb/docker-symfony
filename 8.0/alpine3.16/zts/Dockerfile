#
# NOTE: THIS DOCKERFILE IS GENERATED VIA "update.php"
#
# PLEASE DO NOT EDIT IT DIRECTLY.
#

FROM php:8.0.19-zts-alpine3.16

ARG APCU_VERSION=5.1.21

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    zlib-dev \
    && apk add --no-cache \
    ca-certificates \
    git \
    openssh-client \
    unzip \
    oniguruma-dev

RUN docker-php-ext-install intl opcache mbstring zip \
    && pecl install apcu-$APCU_VERSION \
    && pecl clear-cache \
    && docker-php-ext-enable apcu

RUN runDeps="$( \
    		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
    			| tr ',' '\n' \
    			| sort -u \
    			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
    	)" \
    && apk add --no-cache --virtual .phpexts-rundeps $runDeps \
    && apk del .build-deps

# http://symfony.com/doc/current/performance.html
RUN echo "short_open_tag=off" >> /usr/local/etc/php/zdocker.ini \
    && echo "date.timezone=UTC" >> /usr/local/etc/php/conf.d/zdocker.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/zdocker.ini \
    && echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/zdocker.ini \
    && echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/zdocker.ini \
    && echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/zdocker.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && mkdir -p /var/www/.composer

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list \
    && apt update \
    && apt install symfony-cli \
    && mkdir -p /var/www/.symfony5

RUN sed -i '/www-data/s/\/home\/www-data/\/var\/www\//g' /etc/passwd

ADD entrypoint /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
WORKDIR /srv
