<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Moel;

/**
 * Interface DocumentAwareInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Moel
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface DocumentAwareInterface
{
    /**
     * @return DocumentInterface|null
     */
    public function getDocument(): ?DocumentInterface;


    /**
     * @param DocumentInterface $document
     *
     * @return DocumentAwareInterface
     */
    public function setDocument(DocumentInterface $document): DocumentAwareInterface;
}
