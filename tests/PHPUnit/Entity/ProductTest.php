<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity;

use App\Entity\Product\Product;
use Asdoria\SyliusProductDocumentPlugin\Entity\DocumentType;
use Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductTest
 *
 * @author  Yvan Gimard <yvan.gimard@asdoria.com>
 * @package Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity
 *
 */
class ProductTest extends TestCase
{
    public function testModifyProductDocument()
    {
        $productDocument = new ProductDocument();
        $documentType = new DocumentType();
        $product = new Product();

        $productDocument->setDocumentType($documentType);
        $product->addProductDocument($productDocument);
        $this->assertNotEmpty($product->getProductDocuments());

        $product->removeProductDocument($productDocument);
        $this->assertEmpty($product->getProductDocuments());

    }

    public function testAddDocumentCollectionToProduct()
    {
        $product = new Product();
        $productDocument1 = new ProductDocument();
        $productDocument2 = new ProductDocument();
        $productDocuments = new ArrayCollection();

        $productDocuments->add($productDocument1);
        $productDocuments->add($productDocument2);

        $product->setProductDocuments($productDocuments);

        $this->assertCount(2, $product->getProductDocuments());
    }
}
