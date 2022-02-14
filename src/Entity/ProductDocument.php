<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Entity;

use Asdoria\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use Asdoria\SyliusProductDocumentPlugin\Traits\DocumentTypeTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\ProductTrait;
use Asdoria\SyliusProductDocumentPlugin\Traits\ResourceTrait;
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
    use ProductTrait;
    use TimestampableTrait;
    use DocumentTypeTrait;
    use ResourceTrait;
}
