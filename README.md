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
        "url": "https://github.com/ygasdoria/AsdoriaSyliusProductDocumentPlugin.git"
    }
],
```
2. run `composer require asdoria/sylius-product-document-plugin`


3. Add the bundle in `config/bundles.php`

```PHP
Asdoria\SyliusProductDocumentPlugin\AsdoriaSyliusProductDocumentPlugin::class => ['all' => true],
```

4. Import LiipImagine routes in `config/routes.yaml`

```yaml
_liip_imagine:
    resource: "@LiipImagineBundle/Resources/config/routing.yaml"
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
use Sylius\Component\Core\Model\Product as BaseProduct;

class Product extends BaseProduct implements ProductInterface
{
    use ProductDocumentsAwareTrait;

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
Add to Product mapping
```XML
<one-to-many field="productDocuments" target-entity="Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface" mapped-by="product" orphan-removal="true">
    <cascade>
        <cascade-all/>
    </cascade>
</one-to-many>
```

## Usage

1. In the back office, under `Catalog`, enter `Pictogram Groups`. Create a group using a unique code
2. In `Pictogram Groups`, click `Managing Pictograms` to create/delete images for this group
3. Go to a product's edit page, then click the `Pictograms` tab in the sidebar. Here you can toggle which pictograms you wish to display



