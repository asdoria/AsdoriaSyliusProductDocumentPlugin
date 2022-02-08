<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class AsdoriaProductDocumentExtension
 * @package Asdoria\SyliusProductDocumentPlugin\DependencyInjection
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class AsdoriaSyliusProductDocumentExtension extends AbstractResourceExtension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
    }
}
