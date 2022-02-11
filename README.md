<p align="center">
</p>



<h1 align="center">Asdoria Product Document Plugin</h1>






## Installation

---
1. Add the repository to composer.json

```JSON
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/asdoria/AsdoriaSyliusProductDocumentPlugin.git"
    }
],
```
2. run `composer require asdoria/sylius-product-document-plugin`


3. Add the bundle in `config/bundles.php`

```PHP
Asdoria\SyliusProductDocumentPlugin\AsdoriaSyliusProductDocumentPlugin::class => ['all' => true],
```


5. Import config in `config/packages/_sylius.yaml`
```yaml
imports:
    - { resource: "@AsdoriaSyliusProductDocumentPlugin/Resources/config/app/config.yaml" }
```
6. In `src/Entity/Product/Product.php`

```PHP
namespace App\Entity\Product;

use App\Model\ProductInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use Asdoria\SyliusProductDocumentPlugin\Traits\ProductDocumentsAwareTrait;
use Asdoria\SyliusProductDocumentPlugin\Model\Aware\ProductDocumentsAwareInterface;
use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct implements ProductInterface, ProductDocumentsAwareInterface
{
    use ProductDocumentsTrait;

    public function __construct()
    {
        parent::__construct();
        $this->initializeProductDocumentsCollection();
    }
    /**
     * @param ProductDocumentInterface $productDocument
     */
    public function addProductDocument(ProductDocumentInterface $productDocument): void
    {
        if (!$this->hasProductDocument($productDocument)) {
            $productDocument->setProduct($this);
            $this->productDocuments->add($productDocument);
        }
    }

    /**
     * @param ProductDocumentInterface $productDocument
     */
    public function removeProductDocument(ProductDocumentInterface $productDocument): void
    {
        if ($this->hasProductDocument($productDocument)) {
            $productDocument->setProduct(null);
            $this->productDocuments->removeElement($productDocument);
        }
    }
}
```
Add to Product xml mapping
```XML
<one-to-many field="productDocuments" target-entity="Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface" mapped-by="product" orphan-removal="true">
    <cascade>
        <cascade-all/>
    </cascade>
</one-to-many>
```



