#!/usr/bin/env php
<?php

$tagsList = file_get_contents('https://registry.hub.docker.com/v1/repositories/php/tags');

if (empty($tagsList)) {
    throw new \RuntimeException('Docker Hub doesn\'t respond.');
}

preg_match_all('#"name": "([^"]*)"#', $tagsList, $tagsList);

if (empty($tagsList[1])) {
    throw new \RuntimeException('No tags in the Docker Hub response.');
}

$tagsList = $tagsList[1];
$tagsList = array_filter($tagsList, function ($e) { return !(preg_match('#((5(\.|-))|RC|rc|beta)#', $e) || '5' === $e); });

foreach ($tagsList as $t) {
    echo "- $t\r\n";
}
