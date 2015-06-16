<?php

namespace Xidea\Bundle\BookBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface,
    Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Xidea\Bundle\BaseBundle\DependencyInjection\AbstractConfiguration;
/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration extends AbstractConfiguration
{
    public function __construct($alias)
    {
        parent::__construct($alias);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $this->addBookSection($rootNode);
        $this->addAuthorSection($rootNode);
        $this->addPublisherSection($rootNode);
        $this->addTemplateSection($rootNode);

        return $treeBuilder;
    }
    
    public function getDefaultTemplateNamespace()
    {
        return '@XideaBook';
    }
    
    private function addBookSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('book')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('code')->defaultValue('xidea_book')->end()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.book.factory.default')->end()
                        ->scalarNode('builder')->defaultValue('xidea_book.book.builder.default')->end()
                        ->scalarNode('director')->defaultValue('xidea_book.book.director.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.book.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.book.loader.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('book')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_book.book.form.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_book.book.form.handler.default')->end()
                                        ->scalarNode('type')->defaultValue('xidea_book')->end()
                                        ->scalarNode('name')->defaultValue('xidea_book_form')->end()
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
                        ->scalarNode('code')->defaultValue('xidea_author')->end()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.author.factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.author.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.author.loader.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('author')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_book.author.form.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_book.author.form.handler.default')->end()
                                        ->scalarNode('type')->defaultValue('xidea_author')->end()
                                        ->scalarNode('name')->defaultValue('xidea_author_form')->end()
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
                        ->scalarNode('code')->defaultValue('xidea_publisher')->end()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.publisher.factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.publisher.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.publisher.loader.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('publisher')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_book.publisher.form.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_book.publisher.form.handler.default')->end()
                                        ->scalarNode('type')->defaultValue('xidea_publisher')->end()
                                        ->scalarNode('name')->defaultValue('xidea_publisher_form')->end()
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
    
    protected function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->append($this->addTemplateNode($this->getDefaultTemplateNamespace(), $this->getDefaultTemplateEngine(), [], true))
            ->end();
    }
}
