#!/usr/bin/env php
<?php

const PATTERN_INVALID_TAG = '#5|((5(\.|-))|7\.0|7\.1|7\.2|7\.3|7\.4|RC|rc|beta|alpha|latest|stretch)#';
const PATTERN_VERSION_FULL = '#^\d+\.\d+\.\d+$#';

// Ordered by release date, the latest first
const DEBIAN_RELEASES = [
    'bullseye',
    'buster',
    'stretch',
    'jessie',
];

//
// Fetches all available tags
//

$tagsList = file_get_contents('https://registry.hub.docker.com/v1/repositories/php/tags');
if (empty($tagsList)) {
    throw new \RuntimeException('Docker Hub doesn\'t respond.');
}

preg_match_all('#"name": "([^"]*)"#', $tagsList, $tagsList);
if (empty($tagsList[1])) {
    throw new \RuntimeException('No tags in the Docker Hub response.');
}

$tagsList = $tagsList[1];

//
// Discards unsupported PHP releases
//

$tagsList = array_filter($tagsList, static function ($e) { return !preg_match(PATTERN_INVALID_TAG, $e); });

//
// Discards non-full-versioned tags
//

$latestPhpReleases = []; // grouped by PHP major+minor releases
$latestDebianReleases = []; // grouped by PHP major+minor releases
$latestAlpineReleases = []; // grouped by PHP major+minor releases

$tagsList = array_filter(array_map(
    static function (
        string $tag
    ) use (
        &$latestPhpReleases,
        &$latestDebianReleases,
        &$latestAlpineReleases
    ) {
        if (
            count($pieces = explode('-', $tag)) !== 3  || // missing parts
            'alpine' === $pieces[2] || // alpine suite without version
            !preg_match(PATTERN_VERSION_FULL, $pieces[0]) // incomplete php version
        ) {
            return null;
        }

        [$version, $variant, $suite] = $pieces;

        $majorMinor = substr($version, 0, strrpos($version, '.'));
        if (!isset($latestPhpReleases[$majorMinor])) {
            $latestPhpReleases[$majorMinor] = [];
        }
        if (!in_array($version, $latestPhpReleases[$majorMinor])) {
            $latestPhpReleases[$majorMinor][] = $version;
        }

        if (in_array($suite, DEBIAN_RELEASES)) {
            if (!isset($latestDebianReleases[$majorMinor])) {
                $latestDebianReleases[$majorMinor] = [];
            }
            if (!in_array($suite, $latestDebianReleases[$majorMinor], true)) {
                $latestDebianReleases[$majorMinor][] = $suite;
            }
        }

        if (0 === strpos($suite, 'alpine')) {
            if (!isset($latestAlpineReleases[$majorMinor])) {
                $latestAlpineReleases[$majorMinor] = [];
            }
            if (!in_array($alpineVersion = substr($suite, 6), $latestAlpineReleases[$majorMinor], true)) {
                $latestAlpineReleases[$majorMinor][] = $alpineVersion;
            }
        }

        return [
            '_original' => $tag,
            'version' => $version,
            'variant' => $variant,
            'suite' => $suite,
        ];
    }, $tagsList)
);

// Find latest PHP patch release for each major+minor
$latestPhpReleases = array_map(static function (array $releases): string {
    usort($releases, 'version_compare');
    return end($releases);
}, $latestPhpReleases);

// Discard non-latest PHP patch versions
$tagsList = array_filter($tagsList, static function (array $tag) use ($latestPhpReleases): bool {
    return in_array($tag['version'], $latestPhpReleases, true);
});

// Find latest debian release by PHP major+minor release
$latestDebianReleases = array_map(static function (array $releases): string {
    usort($releases, static function ($a, $b): int {
        return array_search($a, DEBIAN_RELEASES) <=> array_search($b, DEBIAN_RELEASES);
    });
    return end($releases);
}, $latestDebianReleases);

// Find latest alpine release by PHP major+minor release
$latestAlpineReleases = array_map(static function (array $releases): string {
    usort($releases, 'version_compare');
    return 'alpine' . end($releases);
}, $latestAlpineReleases);

//
//  Update
//

$warning = '#
# NOTE: THIS DOCKERFILE IS GENERATED VIA "update.php"
#
# PLEASE DO NOT EDIT IT DIRECTLY.
#

';

$tagsList = array_reverse($tagsList);
$finalTagsList = [];
foreach ($tagsList as $t) {
    $majorMinor = substr($t['version'], 0, strrpos($t['version'], '.'));

    $tags = [
        sprintf('%s-%s-%s', $t['version'], $t['suite'], $t['variant']),
        sprintf('%s-%s-%s', $majorMinor, $t['suite'], $t['variant']),
    ];

    // Adds aliases for Alpine ("alpine" suite points to the latest available)
    if ($latestAlpineReleases[$majorMinor] === $t['suite']) {
        $tags[] = sprintf('%s-alpine-%s', $t['version'], $t['variant']);
        $tags[] = sprintf('%s-alpine-%s', $majorMinor, $t['variant']);
    }

    // Adds aliases for latest Debian (hides suite and points tag to the latest available)
    if ($latestDebianReleases[$majorMinor] === $t['suite']) {
        $tags[] = sprintf('%s-%s', $t['version'], $t['variant']);
        $tags[] = sprintf('%s-%s', $majorMinor, $t['variant']);
    }

    // Adds aliases for cli (duplicates cli tags without the "cli" suffix)
    if ('cli' === $t['variant']) {
        $extras = [];
        foreach ($tags as $tag) {
            $extras[] = substr($tag, 0, strrpos($tag, '-'));
        }
        $tags = array_merge($tags, $extras);
    }

    usort($tags, function($a, $b) {
        return mb_strlen($a) - mb_strlen($b);
    });

    // Build the folder and all needded files
    $directory = sprintf('%s/%s/%s', $majorMinor, $t['suite'], $t['variant']);
    if (!file_exists($directory) && !mkdir($directory, 0775, true)) {
        throw new \RuntimeException(sprintf('Cannot create the directory "%s".', $directory));
    }

    $os = in_array($t['suite'], DEBIAN_RELEASES,true) ? 'debian' : 'alpine';
    $haveApache = 'apache' === $t['variant'];

    $dockerfile = $warning.file_get_contents(sprintf('Dockerfile-%s.template', $os));

    $dockerfile = preg_replace('#%%IMAGE_TAG%%#u', $t['_original'], $dockerfile);
    $dockerfile = preg_replace('#%%APCU_VERSION%%#u', '5.1.17', $dockerfile); // TODO check the right version
    $dockerfile = preg_replace('#%%SYMFONY%%#u', file_get_contents('symfony.template'), $dockerfile);

    if ($haveApache) {
        $dockerfile = preg_replace('#%%APACHE%%#u', file_get_contents('apache.template'), $dockerfile);
        copy('apache-vhost.conf', sprintf('%s/%s', $directory, '000-default.conf'));
    } else {
        $dockerfile = preg_replace('#%%APACHE%%#u', '', $dockerfile);
    }

    $dockerfile = preg_replace(sprintf('#%s{3,}#u', PHP_EOL), PHP_EOL.PHP_EOL, $dockerfile);

    file_put_contents(sprintf('%s/%s', $directory, 'Dockerfile'), $dockerfile);

    $entrypointFile = sprintf('%s/%s', $directory, 'entrypoint');
    copy(sprintf('entrypoint-%s', $os), $entrypointFile);
    chmod($entrypointFile, 0755);

    $finalTagsList[$directory] = $tags;
}

$travisTags = '';
$readmeTags = '';
foreach ($finalTagsList as $dir => $tags) {
    $travisTags .= sprintf('  - FOLDER=%s TAGS=%s%s', $dir, implode(',', $tags), PHP_EOL);
    $readmeTags .= sprintf('- `%s` ([%s/Dockerfile](https://github.com/florianbelhomme/docker-symfony/tree/master/%s/Dockerfile))%s', implode('`, `', $tags), $dir, $dir, PHP_EOL);
}

file_put_contents('.travis.yml', preg_replace('#env:[^\:]*script:#u', sprintf('env:%s%s%sscript:', PHP_EOL, $travisTags, PHP_EOL), file_get_contents('.travis.yml')));
file_put_contents('README.md', preg_replace('@## Tags[^#]*@u', sprintf('## Tags%s%s%s%s', PHP_EOL, PHP_EOL, $readmeTags, PHP_EOL), file_get_contents('README.md')));
