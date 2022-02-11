<?php


declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Uploader;

use Asdoria\SyliusProductDocumentPlugin\Model\DocumentInterface;
use Gaufrette\Filesystem;
use Psr\Http\Message\StreamInterface;

/**
 * Class Uploader
 * @package Asdoria\SyliusProductDocumentPlugin\Uploader
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
    public function upload(DocumentInterface $document): void
    {
        if (!$document->hasFile()) {
            return;
        }

        if (null !== $document->getPath() && $this->has($document->getPath())) {
            $this->remove($document->getPath());
        }

        do {
            $hash = md5(uniqid((string) mt_rand(), true));
            $path = $this->expandPath($hash . '.' . $document->getFile()->guessExtension());
        } while ($this->filesystem->has($path));

        $document->setPath($path);

        $this->filesystem->write(
            $document->getPath(),
            file_get_contents($document->getFile()->getPathname())
        );
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
     * @param DocumentInterface $document
     *
     * @return bool|string
     */
    public function getContent(DocumentInterface $document)
    {
        $body = $this->filesystem->getAdapter()->read(
            $document->getPath()
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
