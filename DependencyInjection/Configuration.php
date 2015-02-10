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

        return $treeBuilder;
    }
    
    public function getDefaultTemplateNamespace()
    {
        return 'XideaBookBundle';
    }
    
    private function addBookSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('book')
                    ->addDefaultsIfNotSet()
                    ->children()
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
                                ->arrayNode('create')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_book.book.form.create.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_book.book.form.create.handler.default')->end()
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
                        ->append($this->addTemplateNode($this->getDefaultTemplateNamespace(), $this->getDefaultTemplateEngine(), array(
                            'list' => array(
                                'path' => 'Book\List:list'
                            ),
                            'show' => array(
                                'path' => 'Book\Show:Show'
                            ),
                            'create' => array(
                                'path' => 'Book\Create:create'
                            ),
                            'create_form' => array(
                                'path' => 'Book\Create:create_form'
                            )
                        )))
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
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.author.factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.author.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.author.loader.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('create')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_book.author.form.create.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_book.author.form.create.handler.default')->end()
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
                        ->append($this->addTemplateNode($this->getDefaultTemplateNamespace(), $this->getDefaultTemplateEngine()))
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
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_book.publisher.factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_book.publisher.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_book.publisher.loader.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('create')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_book.publisher.form.create.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_book.publisher.form.create.handler.default')->end()
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
                        ->append($this->addTemplateNode($this->getDefaultTemplateNamespace(), $this->getDefaultTemplateEngine()))
                    ->end()
                ->end()
            ->end();
    }
}
