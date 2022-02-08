<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Model\Aware;

use Sylius\Component\Product\Model\ProductInterface;

/**
 * Interface ProductAwareInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Model\Aware
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
interface ProductAwareInterface
{
    /**
     * @return ProductInterface|null
     */
    public function getProduct(): ?ProductInterface;

    /**
     * @param ProductInterface|null $product
     */
    public function setProduct(?ProductInterface $product): void;
}
