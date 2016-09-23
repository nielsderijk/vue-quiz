<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

date_default_timezone_set('UTC');

require __DIR__.'/environment.php';

if (ENVIRONMENT === ENV_DEVELOPMENT) {
    require_once __DIR__.'/../var/bootstrap.php.cache';
}

/** @var ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
