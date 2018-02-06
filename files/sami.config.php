<?php

use Sami\Sami;
use Symfony\Component\Finder\Finder;
//use Dotenv\Dotenv;
use Sami\RemoteRepository\GitHubRemoteRepository;

//$env = new Dotenv(__DIR__);
//
//$env->load();

$iterator = Finder::create()
    ->files()
    ->name(getenv('DOCUMENTATION_NAME', '*.php'));

$excludes = explode(',', getenv('DOCUMENTATION_EXCLUDES', 'vendor'));

foreach ($excludes as $exclude) {
    $iterator->exclude($exclude);
}

$iterator->in($dir = getenv('DOCUMENTATION_DIR', '/var/project/'));

return new Sami($iterator, [
    'theme' => getenv('DOCUMENTATION_THEME', 'default'),
    'build_dir' => getenv('DOCUMENTATION_BUILD_DIR', '/var/www/'),
    'cache_dir' => getenv('DOCUMENTATION_CACHE_DIR', '/cache'),
    'remote_repository' => new GitHubRemoteRepository(getenv('DOCUMENTATION_GITHUB', ''), dirname($dir)),
    'default_opened_level' => getenv('DOCUMENTATION_OPENED_LEVEL', 2),
]);
