<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Form\Extension;

use Asdoria\SyliusProductDocumentPlugin\Form\Type\ProductDocumentType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ProductTypeExtension
 * @package Asdoria\SyliusProductDocumentPlugin\Form\Extension
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productDocuments', CollectionType::class, [
                'entry_type'    => ProductDocumentType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false,
                'label'         => 'asdoria.form.product.documents',
                'block_name'    => 'entry',
            ]);
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        return [
            ProductType::class
        ];
    }
}
