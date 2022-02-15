<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity;

use Asdoria\SyliusProductDocumentPlugin\Entity\DocumentType;
use Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class DocumentTypeTest extends TestCase
{
    public function testCreateDocumentType()
    {
        $documentType = new DocumentType();
        $documentType->setCode('type_code');
        $documentType->setCurrentLocale('fr');
        $this->assertEquals('type_code', $documentType->getCode());
    }

    public function testAddDocumentCollectionToDocumentType()
    {
        $documentType = new DocumentType();
        $productDocument1 = new ProductDocument();
        $productDocument2 = new ProductDocument();
        $productDocuments = new ArrayCollection();

        $productDocument1->setPath('file_path');
        $productDocuments->add($productDocument1);
        $productDocuments->add($productDocument2);

        $documentType->setProductDocuments($productDocuments);

        $this->assertCount(2, $documentType->getProductDocuments());
        $this->assertEquals('file_path', $productDocuments->first()->getPath());
    }
}
