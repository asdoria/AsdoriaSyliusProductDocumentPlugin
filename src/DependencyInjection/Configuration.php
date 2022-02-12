<?php

declare(strict_types=1);

namespace Asdoria\SyliusProductDocumentPlugin\DependencyInjection;

use Asdoria\SyliusProductDocumentPlugin\Controller\ProductDocumentController;
use Asdoria\SyliusProductDocumentPlugin\Entity\ProductDocument;
use Asdoria\SyliusProductDocumentPlugin\Form\Type\ProductDocumentType;
use Asdoria\SyliusProductDocumentPlugin\Uploader\Uploader;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('asdoria_sylius_product_document_plugin');
        $rootNode = $treeBuilder->getRootNode();
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('uploader')->defaultValue(Uploader::class)->end()
                ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end();

        $this->addResourcesProductDocument($rootNode);

        return $treeBuilder;
    }
    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesProductDocument(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode('product_document')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->variableNode('options')->end()
                                    ->arrayNode('classes')
                                        ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('model')->defaultValue(ProductDocument::class)->cannotBeEmpty()->end()
                                            ->scalarNode('controller')->defaultValue(ProductDocumentController::class)->cannotBeEmpty()->end()
                                            ->scalarNode('repository')->cannotBeEmpty()->end()
                                            ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                            ->scalarNode('form')->defaultValue(ProductDocumentType::class)->cannotBeEmpty()->end()
                                        ->end()
                                    ->end()
                        ->end()
                    ->end()
                ->end()
        ->end();
    }
}
