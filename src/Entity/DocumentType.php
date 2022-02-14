<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Entity;

use Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use Asdoria\SyliusProductDocumentPlugin\Traits\DocumentTypeTrait;
use Asdoria\SyliusProductDocumentPlugin\Model\DocumentTypeInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\DocumentTypeTranslationInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\PictogramTranslationInterface;
use Asdoria\SyliusProductDocumentPlugin\Traits\CodeTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\NamingTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\PictogramsTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\ProductDocumentsTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\ResourceTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\SortableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Class DocumentType
 * @package Asdoria\SyliusProductDocumentPlugin\Entity
 */
class DocumentType implements DocumentTypeInterface
{
    use ResourceTrait;
    use CodeTrait;
    use SortableTrait;
    use ProductDocumentsTrait;
    use DocumentTypeTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }

    /**
     * DocumentType constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->initializeProductDocumentsCollection();
    }

    /**
     * @return string|null
     */
    public function __toString() {
        return $this->getName();
    }

    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * @param null|string $locale
     *
     * @return TranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var PictogramTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): DocumentTypeTranslationInterface
    {
        return new DocumentTypeTranslation();
    }

    /**
     * @param ProductDocumentInterface $productDocument
     */
    public function addProductDocument(ProductDocumentInterface $productDocument): void
    {
        if (!$this->hasProductDocument($productDocument)) {
            $productDocument->setDocumentType($this);
            $this->productDocuments->add($productDocument);
        }
    }

    /**
     * @param ProductDocumentInterface $productDocument
     */
    public function removeProductDocument(ProductDocumentInterface $productDocument): void
    {
        if ($this->hasProductDocument($productDocument)) {
            $productDocument->setDocumentType(null);
            $this->productDocuments->removeElement($productDocument);
        }
    }
}
