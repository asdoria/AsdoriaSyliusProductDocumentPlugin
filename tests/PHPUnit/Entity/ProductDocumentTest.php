<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity;

use App\Entity\Product\Product;
use Asdoria\SyliusProductDocumentPlugin\Entity\DocumentType;
use Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductDocumentTest
 *
 * @author  Yvan Gimard <yvan.gimard@asdoria.com>
 * @package Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity
 *
 */
class ProductDocumentTest extends TestCase
{


    public function testSetProductDocumentType()
    {
        $documentType = new DocumentType();
        $documentType->setCode('type_code');
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


    public function testSetFile()
    {
        $productDocument = new ProductDocument();
        $file = new \SplFileObject(__FILE__);

        $productDocument->setFile($file);
        $this->assertTrue($productDocument->hasFile());

        $linkedFile = $productDocument->getFile();
        $this->assertFileEquals($file->getRealPath(), $linkedFile->getRealPath());
    }


}
