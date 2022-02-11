<?php


declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Uploader\File;

use Gaufrette\Filesystem;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Uploader
 * @package Asdoria\SyliusProductDocumentPlugin\Uploader\File
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class Uploader implements UploaderInterface
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(File $file): string
    {
        do {
            $hash = md5(uniqid((string) mt_rand(), true));
            $path = $this->expandPath($hash . '.' . $file->guessExtension());
        } while ($this->filesystem->has($path));

        $this->filesystem->write(
            $path,
            file_get_contents($file->getPathname())
        );

        return $path;
    }



    /**
     * {@inheritdoc}
     */
    public function exist(string $path): bool
    {
        return $this->filesystem->has($path);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }


    /**
     * @param string $path
     *
     * @return bool|string
     */
    public function getContent(string $path): string
    {
        $body = $this->filesystem->getAdapter()->read(
            $path
        );

        if (!$body instanceof StreamInterface) {
            return $body;
        }

        return $body->getContents();
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function expandPath(string $path): string
    {
        return sprintf(
            '%s/%s/%s',
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4)
        );
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    private function has(string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        return $this->filesystem->has($path);
    }
}
