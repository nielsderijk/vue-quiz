<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$loader = require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/AppKernel.php';

$debug = false;

if (ENVIRONMENT !== ENV_PRODUCTION) {
    $debug = true;
    Debug::enable();
}

Request::enableHttpMethodParameterOverride();

$kernel = new AppKernel(ENVIRONMENT, $debug);

if (ENVIRONMENT === ENV_DEVELOPMENT) {
    $kernel->loadClassCache();
}

$request = Request::createFromGlobals();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
