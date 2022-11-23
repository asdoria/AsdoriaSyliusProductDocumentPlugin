<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Traits;

use Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
trait ProductDocumentsTrait
{
    /**
     * @var Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface",
     *      mappedBy="product",
     *      cascade={"all"})
     * @var ProductDocumentInterface[]|Collection
     */
    protected $productDocuments;

    /**
     *
     */
    public function initializeProductDocumentsCollection(): void
    {
        $this->productDocuments = new ArrayCollection();
    }

    /**
     * @return ProductDocumentInterface[]|Collection
     */
    public function getProductDocuments(): Collection
    {
        return $this->productDocuments;
    }

    /**
     * @param string $type
     *
     * @return Collection
     */
    public function getDocumentsByType(string $type): Collection
    {
        return $this->productDocuments->filter(function (ProductDocumentInterface $document) use ($type): bool {
            return $type === $document->getDocumentType()->getCode();
        });
    }

    /**
     * @param ProductDocumentInterface[]|Collection $productDocuments
     */
    public function setProductDocuments($productDocuments): void
    {
        $this->productDocuments = $productDocuments;
    }

    /**
     * @param ProductDocumentInterface $productDocument
     */
    abstract public function addProductDocument(ProductDocumentInterface $productDocument): void;

    /**
     * @param ProductDocumentInterface $productDocument
     */
    abstract public function removeProductDocument(ProductDocumentInterface $productDocument): void;

    /**
     * @param ProductDocumentInterface $productDocument
     *
     * @return bool
     */
    public function hasProductDocument(ProductDocumentInterface $productDocument): bool
    {
        return $this->productDocuments->contains($productDocument);
    }
}
