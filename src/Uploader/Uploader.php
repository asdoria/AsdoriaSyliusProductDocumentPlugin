<?php


declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Uploader;

use Asdoria\SyliusProductDocumentPlugin\Adapter\GaufretteFilesystemAdapter;
use Asdoria\SyliusProductDocumentPlugin\Model\DocumentInterface;
use Gaufrette\FilesystemInterface;
use Psr\Http\Message\StreamInterface;
use Asdoria\SyliusProductDocumentPlugin\Adapter\FilesystemAdapterInterface;


/**
 * Class Uploader
 * @package Asdoria\SyliusProductDocumentPlugin\Uploader
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class Uploader implements UploaderInterface
{
    /**
     * @param FilesystemAdapterInterface $filesystem
     */
    public function __construct(        
        /** @var FilesystemAdapterInterface $filesystem */
        protected FilesystemAdapterInterface|FilesystemInterface $filesystem
    )
    {
        if ($this->filesystem instanceof FilesystemInterface) {
            @trigger_error(sprintf(
                'Passing Gaufrette\FilesystemInterface as a first argument in %s constructor is deprecated since Sylius 1.12 and will be not possible in Sylius 2.0.',
                self::class,
            ), \E_USER_DEPRECATED);

            /** @psalm-suppress DeprecatedClass */
            $this->filesystem = new GaufretteFilesystemAdapter($this->filesystem);
        }
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
            $this->filesystem->delete($path);
            return true;
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
        $body = $this->filesystem->read(
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
