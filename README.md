# Docker & Symfony

[![Docker Stars](https://img.shields.io/docker/stars/solune/symfony.svg?style=flat)](https://hub.docker.com/r/solune/symfony/)
[![Docker Pulls](https://img.shields.io/docker/pulls/solune/symfony.svg?style=flat)](https://hub.docker.com/r/solune/symfony/)
[![Build Status](https://travis-ci.org/florianbelhomme/docker-symfony.svg?branch=master&style=flat)](https://travis-ci.org/florianbelhomme/docker-symfony)

Docker image with all the minimum requirements for a Symfony project.
You can also use the Symfony-CLI tool to initialize a project.

Image based on the [PHP image](https://hub.docker.com/_/php)

The `latest` tag is set on the `7.3.X-fpm-alpine3.9` image.

*Warning: You must mount a directory to `/srv` to make the entrypoint work (it use the host user to match www-data user).*

## Tags

- `7.3.14-zts-alpine3.8` ([7.3/alpine3.8/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.8/zts/Dockerfile))
- `7.3.14-fpm-alpine3.8` ([7.3/alpine3.8/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.8/fpm/Dockerfile))
- `7.3.14-cli-alpine3.8` ([7.3/alpine3.8/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.8/cli/Dockerfile))
- `7.3.14-zts-alpine3.9`, `7.3-zts` ([7.3/alpine3.9/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.9/zts/Dockerfile))
- `7.3.14-fpm-alpine3.9`, `7.3-fpm` ([7.3/alpine3.9/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.9/fpm/Dockerfile))
- `7.3.14-cli-alpine3.9`, `7.3-cli`, `7.3.14`, `7.3` ([7.3/alpine3.9/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/alpine3.9/cli/Dockerfile))
- `7.3.14-zts-stretch` ([7.3/stretch/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/stretch/zts/Dockerfile))
- `7.3.14-fpm-stretch` ([7.3/stretch/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/stretch/fpm/Dockerfile))
- `7.3.14-apache-stretch` ([7.3/stretch/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/stretch/apache/Dockerfile))
- `7.3.14-cli-stretch` ([7.3/stretch/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.3/stretch/cli/Dockerfile))
- `7.2.27-zts-alpine3.8` ([7.2/alpine3.8/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.8/zts/Dockerfile))
- `7.2.27-fpm-alpine3.8` ([7.2/alpine3.8/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.8/fpm/Dockerfile))
- `7.2.27-cli-alpine3.8` ([7.2/alpine3.8/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.8/cli/Dockerfile))
- `7.2.27-zts-alpine3.9`, `7.2-zts` ([7.2/alpine3.9/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.9/zts/Dockerfile))
- `7.2.27-fpm-alpine3.9`, `7.2-fpm` ([7.2/alpine3.9/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.9/fpm/Dockerfile))
- `7.2.27-cli-alpine3.9`, `7.2-cli`, `7.2.27`, `7.2` ([7.2/alpine3.9/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/alpine3.9/cli/Dockerfile))
- `7.2.27-zts-stretch` ([7.2/stretch/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/stretch/zts/Dockerfile))
- `7.2.27-fpm-stretch` ([7.2/stretch/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/stretch/fpm/Dockerfile))
- `7.2.27-apache-stretch` ([7.2/stretch/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/stretch/apache/Dockerfile))
- `7.2.27-cli-stretch` ([7.2/stretch/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.2/stretch/cli/Dockerfile))
- `7.1.33-zts-alpine3.8` ([7.1/alpine3.8/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/alpine3.8/zts/Dockerfile))
- `7.1.33-fpm-alpine3.8` ([7.1/alpine3.8/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/alpine3.8/fpm/Dockerfile))
- `7.1.33-cli-alpine3.8` ([7.1/alpine3.8/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/alpine3.8/cli/Dockerfile))
- `7.1.33-zts-alpine3.9`, `7.1-zts` ([7.1/alpine3.9/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/alpine3.9/zts/Dockerfile))
- `7.1.33-fpm-alpine3.9`, `7.1-fpm` ([7.1/alpine3.9/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/alpine3.9/fpm/Dockerfile))
- `7.1.33-cli-alpine3.9`, `7.1-cli`, `7.1.33`, `7.1` ([7.1/alpine3.9/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/alpine3.9/cli/Dockerfile))
- `7.1.33-zts-jessie` ([7.1/jessie/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/jessie/zts/Dockerfile))
- `7.1.33-fpm-jessie` ([7.1/jessie/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/jessie/fpm/Dockerfile))
- `7.1.33-apache-jessie` ([7.1/jessie/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/jessie/apache/Dockerfile))
- `7.1.33-cli-jessie` ([7.1/jessie/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/jessie/cli/Dockerfile))
- `7.1.33-zts-stretch` ([7.1/stretch/zts/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/stretch/zts/Dockerfile))
- `7.1.33-fpm-stretch` ([7.1/stretch/fpm/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/stretch/fpm/Dockerfile))
- `7.1.33-apache-stretch` ([7.1/stretch/apache/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/stretch/apache/Dockerfile))
- `7.1.33-cli-stretch` ([7.1/stretch/cli/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/7.1/stretch/cli/Dockerfile))

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
