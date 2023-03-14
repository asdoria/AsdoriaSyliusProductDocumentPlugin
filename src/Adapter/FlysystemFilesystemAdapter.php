<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Adapter;

use League\Flysystem\FilesystemOperator;
use Sylius\Component\Core\Filesystem\Exception\FileNotFoundException;

final class FlysystemFilesystemAdapter implements FilesystemAdapterInterface
{
    public function __construct(private FilesystemOperator $filesystem)
    {
    }

    public function has(string $location): bool
    {
        return $this->filesystem->fileExists($location);
    }

    public function write(string $location, string $content): void
    {
        $this->filesystem->write($location, $content);
    }

    public function delete(string $location): void
    {
        if (!$this->has($location)) {
            throw new FileNotFoundException($location);
        }

        $this->filesystem->delete($location);
    }


    public function read(string $location): ?string
    {
        if(!$this->has($location)) {
            return null;
        }
        return $this->filesystem->read($location);
    }
}
