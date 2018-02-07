<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;
use Sami\RemoteRepository\GitHubRemoteRepository;

/**
 * @param $key
 * @param null $default
 * @return array|bool|false|string|void
 */
function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'empty':
        case '(empty)':
            return '';
        case 'null':
        case '(null)':
            return;
    }

    return $value;
}

$iterator = Finder::create()
    ->files()
    ->name(env('DOCUMENTATION_NAME', '*.php'));

$excludes = explode(',', env('DOCUMENTATION_EXCLUDES', 'vendor'));

foreach ($excludes as $exclude) {
    $iterator->exclude($exclude);
}

$iterator->in($dir = env('DOCUMENTATION_DIR', '/var/project/'));

$config = [
    'theme' => env('DOCUMENTATION_THEME', 'default'),
    'build_dir' => env('DOCUMENTATION_BUILD_DIR', '/var/www/'),
    'cache_dir' => env('DOCUMENTATION_CACHE_DIR', '/cache'),
    'default_opened_level' => env('DOCUMENTATION_OPENED_LEVEL', 2),
];

if (env('DOCUMENTATION_GITHUB', false) !== false) $config['remote_repository'] = new GitHubRemoteRepository(env('DOCUMENTATION_GITHUB', ''), dirname($dir));

return new Sami($iterator, $config);
