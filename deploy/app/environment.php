<?php

define('ENV_DEVELOPMENT', 'development');
define('ENV_TEST', 'test');
define('ENV_UAT', 'uat');
define('ENV_PRODUCTION', 'production');

if (!defined('ENVIRONMENT')) {
    if (($environment = getenv('ENVIRONMENT')) == false || getenv('ENVIRONMENT') == ENV_PRODUCTION) {
        if (php_sapi_name() == 'cli') {
            if (strpos(__DIR__, 'C:') !== false) {
                $environment = ENV_DEVELOPMENT;
            } elseif (strpos(__DIR__, '/Users/') !== false) {
                $environment = ENV_DEVELOPMENT;
            } else {
                $environment = ENV_PRODUCTION;
            }
        } elseif (!empty($_SERVER['SERVER_NAME'])) {
            switch (@$_SERVER['SERVER_NAME']) {
                case 'localhost':
                case '127.0.0.1':
                case 'toyota-vr-installation-share-page.rutger.local':
                case 'mm0030203.mediamonks.local':
                    $environment = ENV_DEVELOPMENT;
                    break;
                case 'test':
                    $environment = ENV_TEST;
                    break;
                case 'saatchi-saatchi-la-toyota-vr-installation-uat-elb.aws.monkapps.com':
                case 'd246b6cy4lq4ov.cloudfront.net':
                case 'www-uat.primeimpossiblequest.com':
                    $environment = ENV_UAT;
                    break;
                default:
                    $environment = ENV_PRODUCTION;
                    break;
            }
        } else {
            $environment = ENV_PRODUCTION;
        }
    }
    define('ENVIRONMENT', $environment);
}
