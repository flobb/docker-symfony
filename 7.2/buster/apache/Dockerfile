#
# NOTE: THIS DOCKERFILE IS GENERATED VIA "update.sh"
#
# PLEASE DO NOT EDIT IT DIRECTLY.
#

FROM php:7.2.27-apache-buster

ARG APCU_VERSION=5.1.17

RUN buildDeps=" \
        libicu-dev \
        zlib1g-dev \
        libzip-dev \
        libonig-dev \
    " \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        $buildDeps \
        ca-certificates \
        git \
        openssh-client \
        libzip4 \
        unzip \
    && docker-php-ext-install opcache mbstring intl zip \
    && pecl install apcu-$APCU_VERSION && docker-php-ext-enable apcu \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false -o APT::AutoRemove::SuggestsImportant=false $buildDeps \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

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

RUN a2enmod rewrite

ADD entrypoint /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
WORKDIR /srv
