<?php

declare(strict_types=1);


namespace Asdoria\SyliusProductDocumentPlugin\Uploader\File;


use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface UploaderInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Uploader\File
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface UploaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function upload(File $file): string;

    /**
     * {@inheritdoc}
     */
    public function remove(string $path): bool;

    /**
     * {@inheritdoc}
     */
    public function exist(string $path): bool;

    /**
     * @param string $path
     *
     * @return bool|string
     */
    public function getContent(string $path): string;
}
