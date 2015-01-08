<?php

namespace Xidea\Bundle\BookBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaBookExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('book.yml');
        $loader->load('book_controller.yml');
        $loader->load('book_form.yml');
        $loader->load('book_orm.yml');
        $loader->load('author.yml');
        $loader->load('author_form.yml');
        $loader->load('author_orm.yml');
        $loader->load('publisher.yml');
        $loader->load('publisher_form.yml');
        $loader->load('publisher_orm.yml');
        
        $this->loadBookSection($config['book'], $container, $loader);
        $this->loadAuthorSection($config['author'], $container, $loader);
        $this->loadPublisherSection($config['publisher'], $container, $loader);
    }
    
    private function loadBookSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.book.class', $config['class']);
        $container->setAlias('xidea_book.book_factory', $config['factory']);
        $container->setAlias('xidea_book.book_builder', $config['builder']);
        $container->setAlias('xidea_book.book_director', $config['director']);
        $container->setAlias('xidea_book.book_manager', $config['manager']);
        $container->setAlias('xidea_book.book_loader', $config['loader']);
        
        if (!empty($config['create'])) {
            $this->loadBookCreateSection($config['create'], $container, $loader);
        }
    }
    
    private function loadBookCreateSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.book_create.form.type', $config['form']['type']);
        $container->setParameter('xidea_book.book_create.form.name', $config['form']['name']);
        $container->setParameter('xidea_book.book_create.form.validation_groups', $config['form']['validation_groups']);
    }
    
    private function loadAuthorSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.author.class', $config['class']);
        $container->setAlias('xidea_book.author_factory', $config['factory']);
        $container->setAlias('xidea_book.author_builder', $config['builder']);
        $container->setAlias('xidea_book.author_director', $config['director']);
        $container->setAlias('xidea_book.author_manager', $config['manager']);
        $container->setAlias('xidea_book.author_loader', $config['loader']);
        
        if (!empty($config['create'])) {
            $this->loadAuthorCreateSection($config['create'], $container, $loader);
        }
    }
    
    private function loadAuthorCreateSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.author_create.form.type', $config['form']['type']);
        $container->setParameter('xidea_book.author_create.form.name', $config['form']['name']);
        $container->setParameter('xidea_book.author_create.form.validation_groups', $config['form']['validation_groups']);
    }
    
    private function loadPublisherSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.publisher.class', $config['class']);
        $container->setAlias('xidea_book.publisher_factory', $config['factory']);
        $container->setAlias('xidea_book.publisher_builder', $config['builder']);
        $container->setAlias('xidea_book.publisher_director', $config['director']);
        $container->setAlias('xidea_book.publisher_manager', $config['manager']);
        $container->setAlias('xidea_book.publisher_loader', $config['loader']);
        
        if (!empty($config['create'])) {
            $this->loadPublisherCreateSection($config['create'], $container, $loader);
        }
    }
    
    private function loadPublisherCreateSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.publisher_create.form.type', $config['form']['type']);
        $container->setParameter('xidea_book.publisher_create.form.name', $config['form']['name']);
        $container->setParameter('xidea_book.publisher_create.form.validation_groups', $config['form']['validation_groups']);
    }
}
