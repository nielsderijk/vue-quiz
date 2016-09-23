<?php

namespace App\CoreBundle\Service;

use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

/**
 * @package App\CoreBundle\Service
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class S3UrlGenerator
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var AwsS3Adapter
     */
    protected $adapter;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->adapter = $filesystem->getAdapter();
    }

    /**
     * @param string|null $key
     * @param bool        $checkExists
     * @return string|null
     */
    public function generateUrl($key, $checkExists = false)
    {
        if ($key === null) {
            return null;
        }

        if ($checkExists && !$this->filesystem->has($key)) {
            return null;
        }

        $client = $this->adapter->getClient();
        $bucket = $this->adapter->getBucket();
        $pathPrefix = $this->adapter->getPathPrefix();
        $key = $pathPrefix.$key;

        if (ENVIRONMENT === ENV_UAT) {
            return 'http://www-uat.primeimpossiblequest.com/'.$key;
        } elseif (ENVIRONMENT === ENV_PRODUCTION) {
            return 'http://www.primeimpossiblequest.com/'.$key;
        }

        return $client->getObjectUrl($bucket, $key);
    }
}
