<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Adapter;

use Sylius\Component\Core\Filesystem\Adapter\FilesystemAdapterInterface as BaseFilesystemAdapterInterface;
/**
 * Class FilesystemAdapterInterface
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FilesystemAdapterInterface extends BaseFilesystemAdapterInterface
{
    public function read(string $location): ?string;
}
