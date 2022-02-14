<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

/**
 * Class AdminMenuListener
 * @package Asdoria\SyliusProductDocumentPlugin\Menu
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
final class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $catalog = $menu->getChild('catalog');

        if ($catalog) {
            $this->addChild($catalog);
        } else {
            $this->addChild($menu->getFirstChild());
        }
    }

    /**
     * @param ItemInterface $item
     */
    private function addChild(ItemInterface $item): void
    {
        $item
            ->addChild('document_type', [
                'route' => 'asdoria_admin_document_type_index',
            ])
            ->setLabel('asdoria.menu.admin.main.document_type.header')
            ->setLabelAttribute('icon', 'file');
    }
}
