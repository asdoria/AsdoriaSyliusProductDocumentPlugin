<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Adapter;

use Gaufrette\FilesystemInterface;
use Sylius\Component\Core\Filesystem\Exception\FileNotFoundException;

/**
 * @deprecated since version 1.12, to be removed in 2.0. Use {@link FlysystemFilesystemAdapter} instead.
 */
final class GaufretteFilesystemAdapter implements FilesystemAdapterInterface
{
    public function __construct(private FilesystemInterface $filesystem)
    {
        @trigger_error(sprintf(
            'The "%s" class is deprecated since Sylius 1.12 and will be removed in 2.0. Use "%s" instead.',
            self::class,
            FlysystemFilesystemAdapter::class,
        ), \E_USER_DEPRECATED);
    }

    public function has(string $location): bool
    {
        return $this->filesystem->has($location);
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
        if(!$this->filesystem->has($location)) {
            return null;
        }
        return $this->filesystem->read($location);
    }
}
