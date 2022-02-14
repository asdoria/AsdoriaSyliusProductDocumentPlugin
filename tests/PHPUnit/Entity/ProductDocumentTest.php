<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity;

use App\Entity\Product\Product;
use Asdoria\SyliusProductDocumentPlugin\Entity\DocumentType;
use Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument;
use Gedmo\Translatable\Entity\Translation;
use PHPUnit\Framework\TestCase;
use Sylius\Component\Core\Model\ProductVariant;

/**
 * Class ProductDocumentTest
 *
 * @author  Yvan Gimard <yvan.gimard@asdoria.com>
 * @package Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity
 *
 */
class ProductDocumentTest extends TestCase
{
    public function testCreateDocumentType()
    {
        $documentType = new DocumentType();
        $documentType->setCode('type_code');
        $documentType->setCurrentLocale('fr');
        $this->assertEquals('type_code', $documentType->getCode());

        return $documentType;
    }

    /**
     * @depends testCreateDocumentType
     * @param $documentType
     */
    public function testSetProductDocumentType(DocumentType $documentType)
    {
        $productDocument = new ProductDocument();

        $productDocument->setDocumentType($documentType);
        $this->assertEquals('type_code', $productDocument->getDocumentType()->getCode());

        return $productDocument;

    }

    /**
     * @depends testSetProductDocumentType
     * @param \Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument $productDocument
     */
    public function testAddProductToDocument(ProductDocument $productDocument)
    {
        $product = new Product();
        $product->setCurrentLocale('fr');
        $product->setName('Product Name');
        $productDocument->setProduct($product);

        $this->assertEquals('Product Name', $productDocument->getProduct());
    }
}
