<?php
declare(strict_types=1);

namespace Tests\Asdoria\SyliusProductDocumentPlugin\PHPUnit\Entity;

use Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument;
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
    /** @var ProductVariant */
private $productVariant;

    public function setUp(): void
    {
        $this->productVariant = new ProductVariant();
        $this->productVariant->setCurrentLocale('fr');
        $this->productVariant->setName('Variant Name');
    }

    public function testAddProductVariant()
    {
        $productDocument = new ProductDocument();
        $productDocument->addProductVariant($this->productVariant);

        $this->assertTrue($productDocument->hasProductVariants());

        return $productDocument;
    }

        public function testRemoveProductVariant()
    {
        $productDocument = new ProductDocument();
        $productDocument->addProductVariant($this->productVariant);
        $this->assertTrue($productDocument->hasProductVariants());
        $productDocument->removeProductVariant($this->productVariant);
        $this->assertFalse($productDocument->hasProductVariants());
    }
}
