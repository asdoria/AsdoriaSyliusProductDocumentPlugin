<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Uploader;

use Asdoria\SyliusProductDocumentPlugin\Model\DocumentInterface;

/**
 * Interface UploaderInterface
 * @package Asdoria\Bundle\MediaBundle\Uploader
 */
interface UploaderInterface
{
    /**
     * @param DocumentInterface $document
     */
    public function upload(DocumentInterface $document): void;

    /**
     * @param string $path
     *
     * @return bool
     */
    public function remove(string $path): bool;

    /**
     * @param DocumentInterface $document
     *
     * @return bool|string
     */
    public function getContent(DocumentInterface $document);
}
