<?php

namespace Xidea\Bundle\BookBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface,
    Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xidea_book');

        $this->addBookSection($rootNode);
        $this->addAuthorSection($rootNode);
        $this->addPublisherSection($rootNode);

        return $treeBuilder;
    }
    
    private function addBookSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('book')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.book_factory.default')->end()
                        ->scalarNode('builder')->defaultValue('xidea_book.book_builder.default')->end()
                        ->scalarNode('director')->defaultValue('xidea_book.book_director.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.book_manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.book_loader.default')->end()
                        ->arrayNode('create')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('form')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('xidea_book_create')->end()
                                        ->scalarNode('name')->defaultValue('xidea_book_create_form')->end()
                                        ->arrayNode('validation_groups')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array())
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    private function addAuthorSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('author')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.author_factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.author_manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.author_loader.default')->end()
                        ->arrayNode('create')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('form')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('xidea_author_create')->end()
                                        ->scalarNode('name')->defaultValue('xidea_author_create_form')->end()
                                        ->arrayNode('validation_groups')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array())
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    private function addPublisherSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('publisher')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.publisher_factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.publisher_manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.publisher_loader.default')->end()
                        ->arrayNode('create')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('form')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('xidea_publisher_create')->end()
                                        ->scalarNode('name')->defaultValue('xidea_publisher_create_form')->end()
                                        ->arrayNode('validation_groups')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array())
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
