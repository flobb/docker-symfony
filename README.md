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

- `7.4-zts`, `7.4.14-zts`, `7.4-buster-zts`, `7.4.14-buster-zts` ([7.4/buster/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/buster/zts/Dockerfile))
- `7.4-alpine-zts`, `7.4.14-alpine-zts`, `7.4-alpine3.13-zts`, `7.4.14-alpine3.13-zts` ([7.4/alpine3.13/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.13/zts/Dockerfile))
- `7.4-alpine3.12-zts`, `7.4.14-alpine3.12-zts` ([7.4/alpine3.12/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.12/zts/Dockerfile))
- `7.4-alpine3.11-zts`, `7.4.14-alpine3.11-zts` ([7.4/alpine3.11/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.11/zts/Dockerfile))
- `7.4-fpm`, `7.4.14-fpm`, `7.4-buster-fpm`, `7.4.14-buster-fpm` ([7.4/buster/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/buster/fpm/Dockerfile))
- `7.4-alpine-fpm`, `7.4.14-alpine-fpm`, `7.4-alpine3.13-fpm`, `7.4.14-alpine3.13-fpm` ([7.4/alpine3.13/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.13/fpm/Dockerfile))
- `7.4-alpine3.12-fpm`, `7.4.14-alpine3.12-fpm` ([7.4/alpine3.12/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.12/fpm/Dockerfile))
- `7.4-alpine3.11-fpm`, `7.4.14-alpine3.11-fpm` ([7.4/alpine3.11/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.11/fpm/Dockerfile))
- `7.4`, `7.4.14`, `7.4-cli`, `7.4.14-cli`, `7.4-buster`, `7.4.14-buster`, `7.4-buster-cli`, `7.4.14-buster-cli` ([7.4/buster/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/buster/cli/Dockerfile))
- `7.4-alpine`, `7.4.14-alpine`, `7.4-alpine-cli`, `7.4-alpine3.13`, `7.4.14-alpine-cli`, `7.4.14-alpine3.13`, `7.4-alpine3.13-cli`, `7.4.14-alpine3.13-cli` ([7.4/alpine3.13/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.13/cli/Dockerfile))
- `7.4-alpine3.12`, `7.4.14-alpine3.12`, `7.4-alpine3.12-cli`, `7.4.14-alpine3.12-cli` ([7.4/alpine3.12/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.12/cli/Dockerfile))
- `7.4-alpine3.11`, `7.4.14-alpine3.11`, `7.4-alpine3.11-cli`, `7.4.14-alpine3.11-cli` ([7.4/alpine3.11/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/alpine3.11/cli/Dockerfile))
- `7.4-apache`, `7.4.14-apache`, `7.4-buster-apache`, `7.4.14-buster-apache` ([7.4/buster/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.4/buster/apache/Dockerfile))
- `7.3-zts`, `7.3.26-zts`, `7.3-buster-zts`, `7.3.26-buster-zts` ([7.3/buster/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/buster/zts/Dockerfile))
- `7.3-alpine-zts`, `7.3.26-alpine-zts`, `7.3-alpine3.13-zts`, `7.3.26-alpine3.13-zts` ([7.3/alpine3.13/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.13/zts/Dockerfile))
- `7.3-alpine3.12-zts`, `7.3.26-alpine3.12-zts` ([7.3/alpine3.12/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.12/zts/Dockerfile))
- `7.3-alpine3.11-zts`, `7.3.26-alpine3.11-zts` ([7.3/alpine3.11/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.11/zts/Dockerfile))
- `7.3-fpm`, `7.3.26-fpm`, `7.3-buster-fpm`, `7.3.26-buster-fpm` ([7.3/buster/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/buster/fpm/Dockerfile))
- `7.3-alpine-fpm`, `7.3.26-alpine-fpm`, `7.3-alpine3.13-fpm`, `7.3.26-alpine3.13-fpm` ([7.3/alpine3.13/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.13/fpm/Dockerfile))
- `7.3-alpine3.12-fpm`, `7.3.26-alpine3.12-fpm` ([7.3/alpine3.12/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.12/fpm/Dockerfile))
- `7.3-alpine3.11-fpm`, `7.3.26-alpine3.11-fpm` ([7.3/alpine3.11/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.11/fpm/Dockerfile))
- `7.3`, `7.3.26`, `7.3-cli`, `7.3.26-cli`, `7.3-buster`, `7.3.26-buster`, `7.3-buster-cli`, `7.3.26-buster-cli` ([7.3/buster/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/buster/cli/Dockerfile))
- `7.3-alpine`, `7.3.26-alpine`, `7.3-alpine-cli`, `7.3-alpine3.13`, `7.3.26-alpine-cli`, `7.3.26-alpine3.13`, `7.3-alpine3.13-cli`, `7.3.26-alpine3.13-cli` ([7.3/alpine3.13/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.13/cli/Dockerfile))
- `7.3-alpine3.12`, `7.3.26-alpine3.12`, `7.3-alpine3.12-cli`, `7.3.26-alpine3.12-cli` ([7.3/alpine3.12/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.12/cli/Dockerfile))
- `7.3-alpine3.11`, `7.3.26-alpine3.11`, `7.3-alpine3.11-cli`, `7.3.26-alpine3.11-cli` ([7.3/alpine3.11/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.11/cli/Dockerfile))
- `7.3-apache`, `7.3.26-apache`, `7.3-buster-apache`, `7.3.26-buster-apache` ([7.3/buster/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/buster/apache/Dockerfile))
- `7.2-zts`, `7.2.34-zts`, `7.2-buster-zts`, `7.2.34-buster-zts` ([7.2/buster/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/buster/zts/Dockerfile))
- `7.2-alpine-zts`, `7.2.34-alpine-zts`, `7.2-alpine3.12-zts`, `7.2.34-alpine3.12-zts` ([7.2/alpine3.12/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.12/zts/Dockerfile))
- `7.2-alpine3.11-zts`, `7.2.34-alpine3.11-zts` ([7.2/alpine3.11/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.11/zts/Dockerfile))
- `7.2-fpm`, `7.2.34-fpm`, `7.2-buster-fpm`, `7.2.34-buster-fpm` ([7.2/buster/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/buster/fpm/Dockerfile))
- `7.2-alpine-fpm`, `7.2.34-alpine-fpm`, `7.2-alpine3.12-fpm`, `7.2.34-alpine3.12-fpm` ([7.2/alpine3.12/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.12/fpm/Dockerfile))
- `7.2-alpine3.11-fpm`, `7.2.34-alpine3.11-fpm` ([7.2/alpine3.11/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.11/fpm/Dockerfile))
- `7.2`, `7.2.34`, `7.2-cli`, `7.2.34-cli`, `7.2-buster`, `7.2.34-buster`, `7.2-buster-cli`, `7.2.34-buster-cli` ([7.2/buster/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/buster/cli/Dockerfile))
- `7.2-alpine`, `7.2.34-alpine`, `7.2-alpine-cli`, `7.2-alpine3.12`, `7.2.34-alpine-cli`, `7.2.34-alpine3.12`, `7.2-alpine3.12-cli`, `7.2.34-alpine3.12-cli` ([7.2/alpine3.12/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.12/cli/Dockerfile))
- `7.2-alpine3.11`, `7.2.34-alpine3.11`, `7.2-alpine3.11-cli`, `7.2.34-alpine3.11-cli` ([7.2/alpine3.11/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.11/cli/Dockerfile))
- `7.2-apache`, `7.2.34-apache`, `7.2-buster-apache`, `7.2.34-buster-apache` ([7.2/buster/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/buster/apache/Dockerfile))

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
