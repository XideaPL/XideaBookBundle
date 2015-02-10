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
        $container->setAlias('xidea_book.book.configuration', $config['configuration']);
        $container->setAlias('xidea_book.book.factory', $config['factory']);
        $container->setAlias('xidea_book.book.builder', $config['builder']);
        $container->setAlias('xidea_book.book.director', $config['director']);
        $container->setAlias('xidea_book.book.manager', $config['manager']);
        $container->setAlias('xidea_book.book.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadBookFormSection($config['form'], $container, $loader);
        }
        
        if(isset($config['template'])) {
            $this->loadTemplateSection(sprintf('%s.%s', $this->getAlias(), 'book'), $config['template'], $container, $loader);
        }
    }
    
    private function loadBookFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_book.book.form.create.factory', $config['create']['factory']);
        $container->setAlias('xidea_book.book.form.create.handler', $config['create']['handler']);
        
        $container->setParameter('xidea_book.book.form.create.type', $config['create']['type']);
        $container->setParameter('xidea_book.book.form.create.name', $config['create']['name']);
        $container->setParameter('xidea_book.book.form.create.validation_groups', $config['create']['validation_groups']);
    }
    
    private function loadAuthorSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.author.class', $config['class']);
        $container->setAlias('xidea_book.author.configuration', $config['configuration']);
        $container->setAlias('xidea_book.author.factory', $config['factory']);
        $container->setAlias('xidea_book.author.manager', $config['manager']);
        $container->setAlias('xidea_book.author.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadAuthorFormSection($config['form'], $container, $loader);
        }
        
        if(isset($config['template'])) {
            $this->loadTemplateSection(sprintf('%s.%s', $this->getAlias(), 'author'), $config['template'], $container, $loader);
        }
    }
    
    private function loadAuthorFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_book.author.form.create.factory', $config['create']['factory']);
        $container->setAlias('xidea_book.author.form.create.handler', $config['create']['handler']);
        
        $container->setParameter('xidea_book.author.form.create.type', $config['create']['type']);
        $container->setParameter('xidea_book.author.form.create.name', $config['create']['name']);
        $container->setParameter('xidea_book.author.form.create.validation_groups', $config['create']['validation_groups']);
    }
    
    private function loadPublisherSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_book.publisher.class', $config['class']);
        $container->setAlias('xidea_book.publisher.configuration', $config['configuration']);
        $container->setAlias('xidea_book.publisher.factory', $config['factory']);
        $container->setAlias('xidea_book.publisher.manager', $config['manager']);
        $container->setAlias('xidea_book.publisher.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadPublisherFormSection($config['form'], $container, $loader);
        }
        
        if(isset($config['template'])) {
            $this->loadTemplateSection(sprintf('%s.%s', $this->getAlias(), 'publisher'), $config['template'], $container, $loader);
        }
    }
    
    private function loadPublisherFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_book.publisher.form.create.factory', $config['create']['factory']);
        $container->setAlias('xidea_book.publisher.form.create.handler', $config['create']['handler']);
        
        $container->setParameter('xidea_book.publisher.form.create.type', $config['create']['type']);
        $container->setParameter('xidea_book.publisher.form.create.name', $config['create']['name']);
        $container->setParameter('xidea_book.publisher.form.create.validation_groups', $config['create']['validation_groups']);
    }
    
    protected function getConfigurationDirectory()
    {
        return __DIR__.'/../Resources/config';
    }
}
