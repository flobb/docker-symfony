FROM php:7.3.8-fpm-alpine3.9

ARG APCU_VERSION=5.1.17

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    zlib-dev \
    && apk add --no-cache \
    ca-certificates \
    git \
    openssh-client \
    unzip

RUN docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install intl opcache mbstring zip \
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
    && mkdir -p /var/www/.composer/vendor/bin \
    && chown -R www-data:www-data /var/www/.composer

RUN SYMFONYCLI_VERSION=`curl -sS https://get.symfony.com/cli/LATEST` \
    && [ 'i386' = `uname -m` ] && SYMFONYCLI_MACHINE="386" || SYMFONYCLI_MACHINE="amd64" \
    && curl -sS https://get.symfony.com/cli/v$SYMFONYCLI_VERSION/symfony_linux_$SYMFONYCLI_MACHINE > /usr/local/bin/symfony.gz \
    && gzip -d /usr/local/bin/symfony.gz \
    && chmod +x /usr/local/bin/symfony

RUN sed -i '/www-data/s/\/home\/www-data/\/var\/www\//g' /etc/passwd

ADD entrypoint /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
WORKDIR /srv
