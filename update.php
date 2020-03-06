#!/usr/bin/env php
<?php

const PATTERN_INVALID_TAG = '#((5(\.|-))|RC|rc|beta|alpha|latest)#';
const PATTERN_VERSION_FULL = '#^\d+\.\d+\.\d+$#';

// Ordered by release date, the latest first
const DEBIAN_RELEASES = [
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
// Discards unstable releases
//

$tagsList = array_filter($tagsList, static function ($e) { return !(preg_match(PATTERN_INVALID_TAG, $e) || '5' === $e); });

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
        return array_search($a, DEBIAN_RELEASES) <=> array_search($a, DEBIAN_RELEASES);
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

    $dir = sprintf('%s/%s/%s', $majorMinor, $t['suite'], $t['variant']);
    $officialImageTag = $t['_original'];

    echo "$dir\n";
    echo '    TAGS: ' . implode(', ', $tags) . "\n";
    echo "    FROM: $officialImageTag\n\n";
}

echo "Total: " . count($tagsList) . "\n";
