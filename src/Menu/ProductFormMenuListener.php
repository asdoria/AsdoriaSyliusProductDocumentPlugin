<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Menu;

use Sylius\Bundle\AdminBundle\Event\ProductMenuBuilderEvent;

/**
 * Class ProductFormMenuListener
 * @package Asdoria\SyliusProductDocumentPlugin\Menu
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class ProductFormMenuListener
{
    /**
     * @param ProductMenuBuilderEvent $event
     */
    public function addItems(ProductMenuBuilderEvent $event)
    {
        $event->getMenu()
            ->addChild('documents')
            ->setAttribute('template', '@AsdoriaProductDocument/Product/Tab/_document.html.twig')
            ->setLabel('sylius.ui.documents')
        ;
    }
}
