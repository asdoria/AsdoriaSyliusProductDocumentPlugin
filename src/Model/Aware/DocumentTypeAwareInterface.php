<?php

declare(strict_types=1);


namespace Asdoria\SyliusProductDocumentPlugin\Model\Aware;


use Asdoria\SyliusProductDocumentPlugin\Model\DocumentTypeInterface;

/**
 * Class DocumentTypeAwareInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface DocumentTypeAwareInterface
{
    /**
     * @return DocumentTypeInterface|null
     */
    public function getDocumentType(): ?DocumentTypeInterface;

    /**
     * @param DocumentTypeInterface|null $documentType
     */
    public function setDocumentType(?DocumentTypeInterface $documentType): void;
}
