<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Helper;

use Gaufrette\Adapter;
use Gaufrette\Filesystem;
use Liip\ImagineBundle\Imagine\Cache\Resolver\WebPathResolver;

/**
 * Class WebPathHelper
 * @package Asdoria\SyliusProductDocumentPlugin\Helper
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class WebPathHelper
{
    const G_CLOUD_URL = 'https://storage.googleapis.com/';

    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * @var WebPathResolver
     */
    protected $pathResolver;

    /**
     * WebPathHelper constructor.
     *
     * @param Filesystem      $fileSystem
     * @param WebPathResolver $pathResolver
     */
    public function __construct(Filesystem $fileSystem, WebPathResolver $pathResolver)
    {
        $this->fileSystem   = $fileSystem;
        $this->pathResolver = $pathResolver;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public function getPublicPath(string $path): string
    {
        return $this->getDirectoryPath($this->fileSystem->getAdapter()) . '/' . $path;
    }

    /**
     * @param Adapter $adapter
     *
     * @return string
     */
    protected function getDirectoryPath(Adapter $adapter): string
    {
        try {
            $reflection = new \ReflectionClass($adapter);
            $directory  = $reflection->getProperty('directory');
            $directory->setAccessible(true);

            $reflectionPath = new \ReflectionClass($this->pathResolver);
            $webRoot        = $reflectionPath->getProperty('webRoot');
            $webRoot->setAccessible(true);

        } catch (\ReflectionException $exception) {
            /** @var  Adapter\GoogleCloudStorage $adapter */
            return self::G_CLOUD_URL . $adapter->getBucket() . DIRECTORY_SEPARATOR . $adapter->getOptions()['directory'];
        }

        return str_replace($webRoot->getValue($this->pathResolver), '', $directory->getValue($adapter));
    }
}
