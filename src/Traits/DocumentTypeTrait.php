<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Traits;



use Asdoria\SyliusProductDocumentPlugin\Model\DocumentTypeInterface;

/**
 * Trait DocumentTypeTrait
 * @package Asdoria\SyliusDocumentTypeDocumentPlugin\Traits
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
trait DocumentTypeTrait
{
    /**
     * @var DocumentTypeInterface|null
     */
    protected $documentType;

    /**
     * @return DocumentTypeInterface|null
     */
    public function getDocumentType(): ?DocumentTypeInterface
    {
        return $this->documentType;
    }

    /**
     * @param DocumentTypeInterface|null $documentType
     */
    public function setDocumentType(?DocumentTypeInterface $documentType): void
    {
        $this->documentType = $documentType;
    }
}
