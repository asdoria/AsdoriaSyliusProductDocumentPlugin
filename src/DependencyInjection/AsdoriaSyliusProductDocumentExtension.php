<?php
declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\DependencyInjection;

use Asdoria\SyliusProductDocumentPlugin\Uploader\Uploader;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Sylius\Component\Core\Filesystem\Adapter\FilesystemAdapterInterface;
use Sylius\Component\Core\Filesystem\Adapter\FlysystemFilesystemAdapter;
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

        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);

        $this->registerResources('asdoria', $config['driver'], $config['resources'], $container);

        $container->setParameter('asdoria_product_document.media.document_uploader', $config['uploader'] ?? Uploader::class);
        $container->setParameter('asdoria_product_document.media.document_uploader.filesystem', 'sylius_document');

        $container->setAlias(
            'asdoria_product_document.media.document_adapter.file_system',
            match ($config['filesystem']['adapter']) {
                'default', 'flysystem' => 'asdoria_product_document.fly_system.document_uploader.file_system',
                'gaufrette' => 'asdoria_product_document.gaufrette.document_uploader.file_system',
            },
        );
        $loader->load('services.yaml');
    }
}
