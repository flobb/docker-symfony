#
# NOTE: THIS DOCKERFILE IS GENERATED VIA "update.php"
#
# PLEASE DO NOT EDIT IT DIRECTLY.
#

FROM php:8.0.19-zts-buster

ARG APCU_VERSION=5.1.21

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
    && pecl install apcu-$APCU_VERSION \
    && pecl clear-cache \
    && docker-php-ext-enable apcu \
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
    && mkdir -p /var/www/.composer

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list \
    && apt update \
    && apt install symfony-cli \
    && mkdir -p /var/www/.symfony5

ADD entrypoint /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
WORKDIR /srv
