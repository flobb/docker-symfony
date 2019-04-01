# docker-symfony

Docker image with all the requirements for a Symfony project.
You can also use the Symfony-CLI tool to initialize a project.

## Usage

```bash
$ docker run -it --rm \
    -v "$PWD":/src/ \
    -v ~/.composer:/home/.composer \
    solune/symfony:7.3-fpm-alpine3.9 \
    bash
```

## More

PHP-FPM is available, so you can use this image in a `docker-compose.yaml` with a web server.

You can share your SSH socket to access private git repo or advanced Symfony-CLI exchange:
```bash
$ docker run -it --rm \
    -v "$PWD":/src/ \
    -v ~/.composer:/home/.composer \
    -v $SSH_AUTH_SOCK:/tmp/ssh_auth_sock:ro \
    -e SSH_AUTH_SOCK=/tmp/ssh_auth_sock \
    solune/symfony:7.3-fpm-alpine3.9 \
    bash
``` 

## More documentation ?

Image based on the [PHP image](https://hub.docker.com/_/php)
