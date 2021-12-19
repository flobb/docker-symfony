# Docker & Symfony

[![Docker Stars](https://img.shields.io/docker/stars/solune/symfony.svg?style=flat)](https://hub.docker.com/r/solune/symfony/)
[![Docker Pulls](https://img.shields.io/docker/pulls/solune/symfony.svg?style=flat)](https://hub.docker.com/r/solune/symfony/)
[![Build Status](https://travis-ci.org/florianbelhomme/docker-symfony.svg?branch=master&style=flat)](https://travis-ci.org/florianbelhomme/docker-symfony)

Docker image with all the minimum requirements for a Symfony project.
You can also use the Symfony-CLI tool to initialize a project.

Image based on the [PHP image](https://hub.docker.com/_/php)

The `latest` tag is set on the `7.4.X-buster-cli` image.

If you choose the image with Apache, the default VHOST will have the rewrite rules and the public folder set for a Symfony Flex project. So you don't need the `symfony/apache-pack` recipe by default.

*Warning: You must mount a directory to `/srv` to make the entrypoint work (it use the host user to match the container www-data user).*

## Tags

- `8.1-zts`, `8.1.1-zts`, `8.1-buster-zts`, `8.1.1-buster-zts` ([8.1/buster/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/buster/zts/Dockerfile))
- `8.1-bullseye-zts`, `8.1.1-bullseye-zts` ([8.1/bullseye/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/bullseye/zts/Dockerfile))
- `8.1-fpm`, `8.1.1-fpm`, `8.1-buster-fpm`, `8.1.1-buster-fpm` ([8.1/buster/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/buster/fpm/Dockerfile))
- `8.1-bullseye-fpm`, `8.1.1-bullseye-fpm` ([8.1/bullseye/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/bullseye/fpm/Dockerfile))
- `8.1-alpine-fpm`, `8.1.1-alpine-fpm`, `8.1-alpine3.14-fpm`, `8.1.1-alpine3.14-fpm` ([8.1/alpine3.14/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/alpine3.14/fpm/Dockerfile))
- `8.1`, `8.1.1`, `8.1-cli`, `8.1.1-cli`, `8.1-buster`, `8.1.1-buster`, `8.1-buster-cli`, `8.1.1-buster-cli` ([8.1/buster/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/buster/cli/Dockerfile))
- `8.1-bullseye`, `8.1.1-bullseye`, `8.1-bullseye-cli`, `8.1.1-bullseye-cli` ([8.1/bullseye/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/bullseye/cli/Dockerfile))
- `8.1-alpine`, `8.1.1-alpine`, `8.1-alpine-cli`, `8.1-alpine3.14`, `8.1.1-alpine-cli`, `8.1.1-alpine3.14`, `8.1-alpine3.14-cli`, `8.1.1-alpine3.14-cli` ([8.1/alpine3.14/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/alpine3.14/cli/Dockerfile))
- `8.1-apache`, `8.1.1-apache`, `8.1-buster-apache`, `8.1.1-buster-apache` ([8.1/buster/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/buster/apache/Dockerfile))
- `8.1-bullseye-apache`, `8.1.1-bullseye-apache` ([8.1/bullseye/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.1/bullseye/apache/Dockerfile))
- `8.0-buster-zts`, `8.0.14-buster-zts` ([8.0/buster/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/buster/zts/Dockerfile))
- `8.0-zts`, `8.0.14-zts`, `8.0-bullseye-zts`, `8.0.14-bullseye-zts` ([8.0/bullseye/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/bullseye/zts/Dockerfile))
- `8.0-buster-fpm`, `8.0.14-buster-fpm` ([8.0/buster/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/buster/fpm/Dockerfile))
- `8.0-fpm`, `8.0.14-fpm`, `8.0-bullseye-fpm`, `8.0.14-bullseye-fpm` ([8.0/bullseye/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/bullseye/fpm/Dockerfile))
- `8.0-alpine-fpm`, `8.0.14-alpine-fpm`, `8.0-alpine3.14-fpm`, `8.0.14-alpine3.14-fpm` ([8.0/alpine3.14/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/alpine3.14/fpm/Dockerfile))
- `8.0-buster`, `8.0.14-buster`, `8.0-buster-cli`, `8.0.14-buster-cli` ([8.0/buster/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/buster/cli/Dockerfile))
- `8.0`, `8.0.14`, `8.0-cli`, `8.0.14-cli`, `8.0-bullseye`, `8.0.14-bullseye`, `8.0-bullseye-cli`, `8.0.14-bullseye-cli` ([8.0/bullseye/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/bullseye/cli/Dockerfile))
- `8.0-alpine`, `8.0.14-alpine`, `8.0-alpine-cli`, `8.0-alpine3.14`, `8.0.14-alpine-cli`, `8.0.14-alpine3.14`, `8.0-alpine3.14-cli`, `8.0.14-alpine3.14-cli` ([8.0/alpine3.14/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/alpine3.14/cli/Dockerfile))
- `8.0-buster-apache`, `8.0.14-buster-apache` ([8.0/buster/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/buster/apache/Dockerfile))
- `8.0-apache`, `8.0.14-apache`, `8.0-bullseye-apache`, `8.0.14-bullseye-apache` ([8.0/bullseye/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/8.0/bullseye/apache/Dockerfile))

## Usage

```bash
$ docker run -it --rm \
    -v "$PWD":/srv \
    -v ~/.composer:/var/www/.composer \
    solune/symfony:latest \
    sh
```

Sharing your local Composer folder, allow you to share cache between containers and grant you some
access token (to Github for example).

## What's in ?

Image based on the [PHP image](https://hub.docker.com/_/php)

It add Git, Composer and the Symfony-Cli tool in the image.

The entrypoint is modified to match the user `www-data` to the id and group of the host user that share `/srv`.
It avoid some difficulties with project files permissions between the host and the container.
If you run something like composer or command, the entrypoint automatically make you use the `www-data` user.

The basic dependencies for Symfony are added and some Symfony friendly values are configured in a `php.ini` file.

You can also share your SSH socket to access private git repository or advanced Symfony-CLI exchange:
```bash
$ docker run -it --rm \
    -v "$PWD":/srv \
    -v ~/.composer:/var/www/.composer \
    -v $SSH_AUTH_SOCK:/tmp/ssh_auth_sock:ro \
    -e SSH_AUTH_SOCK=/tmp/ssh_auth_sock \
    solune/symfony:latest \
    sh
```
