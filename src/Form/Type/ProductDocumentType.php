<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Asdoria\SyliusProductDocumentPlugin\Entity\DocumentType;
/**
 * Class ProductDocumentType
 * @package Asdoria\SyliusProductDocumentPlugin\Form\Type
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ProductDocumentType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('documentType', EntityType::class, [
                'label' => 'asdoria.form.product_docment.document_type',
                'class' => DocumentType::class,
            ])
            ->add('file', FileType::class, [
                'label' => 'asdoria.form.document.file',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_product_document';
    }
}
