<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Form\Type;



/**
 * Class ProductDocumentType
 * @package Asdoria\SyliusProductDocumentPlugin\Form\Type
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ProductDocumentType extends DocumentType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_product_document';
    }
}
