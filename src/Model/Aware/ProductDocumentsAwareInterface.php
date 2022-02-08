<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Model\Aware;

use Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Interface ProductDocumentsAwareInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Model\Aware
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
interface ProductDocumentsAwareInterface
{
    /**
     *
     */
    public function initializeProductDocumentsCollection(): void;

    /**
     * @return ProductDocumentInterface[]|Collection
     */
    public function getProductDocuments(): Collection;

    /**
     * @param string $type
     *
     * @return Collection
     */
    public function getDocumentsByType(string $type): Collection;

    /**
     * @param ProductDocumentInterface[]|Collection $productDocuments
     */
    public function setProductDocuments($productDocuments): void;

    /**
     * @param ProductDocumentInterface $productDocument
     */
    public function addProductDocument(ProductDocumentInterface $productDocument): void;

    /**
     * @param ProductDocumentInterface $productDocument
     */
    public function removeProductDocument(ProductDocumentInterface $productDocument): void;

    /**
     * @param ProductDocumentInterface $productDocument
     *
     * @return bool
     */
    public function hasProductDocument(ProductDocumentInterface $productDocument): bool;
}
