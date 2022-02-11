<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Entity;

use Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use Asdoria\SyliusProductDocumentPlugin\Traits\ProductAwareTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

/**
 * Class ProductDocument
 * @package Asdoria\SyliusProductDocumentPlugin\Entity
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ProductDocument extends Document implements ProductDocumentInterface
{
    use ProductAwareTrait;
    use TimestampableTrait;

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var Collection|ProductVariantInterface[]
     *
     * @psalm-var Collection<array-key, ProductVariantInterface>
     */
    protected $productVariants;

    public function __construct()
    {
        /** @var ArrayCollection<array-key, ProductVariantInterface> $this->productVaraints */
        $this->productVariants = new ArrayCollection();
    }

    public function hasProductVariants(): bool
    {
        return !$this->productVariants->isEmpty();
    }

    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    public function hasProductVariant(ProductVariantInterface $productVariant): bool
    {
        return $this->productVariants->contains($productVariant);
    }

    public function addProductVariant(ProductVariantInterface $productVariant): void
    {
        $this->productVariants->add($productVariant);
    }

    public function removeProductVariant(ProductVariantInterface $productVariant): void
    {
        if ($this->hasProductVariant($productVariant)) {
            $this->productVariants->removeElement($productVariant);
        }
    }
}
