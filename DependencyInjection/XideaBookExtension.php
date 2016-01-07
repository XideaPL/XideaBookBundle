<?php

namespace Xidea\Bundle\BookBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Xidea\Bundle\BaseBundle\DependencyInjection\AbstractExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaBookExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        list($config, $loader) = $this->setUp($configs, new Configuration($this->getAlias()), $container);

        $loader->load('book.yml');
        $loader->load('book_orm.yml');
        $loader->load('author.yml');
        $loader->load('author_orm.yml');
        $loader->load('publisher.yml');
        $loader->load('publisher_orm.yml');
        
        $this->loadBookSection($config['book'], $container, $loader);
        $this->loadAuthorSection($config['author'], $container, $loader);
        $this->loadPublisherSection($config['publisher'], $container, $loader);
        
        $this->loadTemplateSection($config, $container, $loader);
    }
    
    private function loadBookSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.book.code', $config['code']);
        $container->setParameter('xidea_book.book.class', $config['class']);
        $container->setAlias('xidea_book.book.configuration', $config['configuration']);
        $container->setAlias('xidea_book.book.factory', $config['factory']);
        $container->setAlias('xidea_book.book.builder', $config['builder']);
        $container->setAlias('xidea_book.book.director', $config['director']);
        $container->setAlias('xidea_book.book.manager', $config['manager']);
        $container->setAlias('xidea_book.book.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadBookFormSection($config['form'], $container, $loader);
        }
    }
    
    private function loadBookFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_book.book.form.factory', $config['book']['factory']);
        $container->setAlias('xidea_book.book.form.handler', $config['book']['handler']);
        
        $container->setParameter('xidea_book.book.form.type', $config['book']['type']);
        $container->setParameter('xidea_book.book.form.name', $config['book']['name']);
        $container->setParameter('xidea_book.book.form.validation_groups', $config['book']['validation_groups']);
    }
    
    private function loadAuthorSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.author.code', $config['code']);
        $container->setParameter('xidea_book.author.class', $config['class']);
        $container->setAlias('xidea_book.author.configuration', $config['configuration']);
        $container->setAlias('xidea_book.author.factory', $config['factory']);
        $container->setAlias('xidea_book.author.manager', $config['manager']);
        $container->setAlias('xidea_book.author.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadAuthorFormSection($config['form'], $container, $loader);
        }
    }
    
    private function loadAuthorFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_book.author.form.factory', $config['author']['factory']);
        $container->setAlias('xidea_book.author.form.handler', $config['author']['handler']);
        
        $container->setParameter('xidea_book.author.form.type', $config['author']['type']);
        $container->setParameter('xidea_book.author.form.name', $config['author']['name']);
        $container->setParameter('xidea_book.author.form.validation_groups', $config['author']['validation_groups']);
    }
    
    private function loadPublisherSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.publisher.code', $config['code']);
        $container->setParameter('xidea_book.publisher.class', $config['class']);
        $container->setAlias('xidea_book.publisher.configuration', $config['configuration']);
        $container->setAlias('xidea_book.publisher.factory', $config['factory']);
        $container->setAlias('xidea_book.publisher.manager', $config['manager']);
        $container->setAlias('xidea_book.publisher.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadPublisherFormSection($config['form'], $container, $loader);
        }
    }
    
    private function loadPublisherFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_book.publisher.form.factory', $config['publisher']['factory']);
        $container->setAlias('xidea_book.publisher.form.handler', $config['publisher']['handler']);
        
        $container->setParameter('xidea_book.publisher.form.type', $config['publisher']['type']);
        $container->setParameter('xidea_book.publisher.form.name', $config['publisher']['name']);
        $container->setParameter('xidea_book.publisher.form.validation_groups', $config['publisher']['validation_groups']);
    }
    
    protected function getConfigurationDirectory()
    {
        return __DIR__.'/../Resources/config';
    }
    
    protected function getDefaultTemplates()
    {
        return [
            'book_main' => ['path' => '@XideaBook/main'],
            'book_list' => ['path' => '@XideaBook/Book/List/list'],
            'book_show' => ['path' => '@XideaBook/Book/Show/show'],
            'book_create' => ['path' => '@XideaBook/Book/Create/create'],
            'book_form' => ['path' => '@XideaBook/Book/Form/form'],
            'book_form_fields' => ['path' => '@XideaBook/Book/Form/fields']
        ];
    }
}
