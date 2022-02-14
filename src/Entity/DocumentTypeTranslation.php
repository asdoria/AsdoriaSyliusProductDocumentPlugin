<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Entity;

use Asdoria\SyliusProductDocumentPlugin\Model\DocumentTypeTranslationInterface;
use Asdoria\SyliusProductDocumentPlugin\Traits\NamingTrait;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Asdoria\SyliusProductDocumentPlugin\Traits\ResourceTrait;

/**
 * Class DocumentTypeTranslation
 * @package Asdoria\SyliusProductDocumentPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class DocumentTypeTranslation extends AbstractTranslation implements DocumentTypeTranslationInterface
{
    use ResourceTrait;
    use NamingTrait;
}
