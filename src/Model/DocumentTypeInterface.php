<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Model;

use Asdoria\SyliusProductDocumentPlugin\Model\Aware\DocumentTypeAwareInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\Aware\PictogramsAwareInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\Aware\ProductDocumentsAwareInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

/**
 * Interface DocumentTypeInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface DocumentTypeInterface extends
    ResourceInterface,
    TranslatableInterface,
    CodeAwareInterface,
    ProductDocumentsAwareInterface,
    DocumentTypeAwareInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;
}
