<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Model;

//TODO Fix MediaBundle import
use Asdoria\Bundle\MediaBundle\Model\DocumentInterface;
use Asdoria\SyliusProductDocumentPlugin\Model\Aware\ProductAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

/**
 * Interface ProductDocumentInterface
 * @package Asdoria\SyliusProductDocumentPlugin\Model
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
interface ProductDocumentInterface extends DocumentInterface, ProductAwareInterface, TimestampableInterface
{
}
