<?php

namespace Xidea\Bundle\BookBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

class XideaBookBundle extends Bundle
{   
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $this->addMappingsPass($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function addMappingsPass(ContainerBuilder $container)
    {
        $mappings = array(
            //sprintf('%s/Resources/config/doctrine/user-model', $this->getPath()) => 'Xidea\Book',
            sprintf('%s/Resources/config/doctrine/model', $this->getPath()) => 'Xidea\Bundle\BookBundle\Model'
        );
        
        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createYamlMappingDriver(
                    $mappings,
                    array(),
                    false,
                    array(
                        //'XideaBook' => 'Xidea\Book',
                        'XideaBookBundle' => 'Xidea\Bundle\BookBundle\Model'
                    )
            ));
        }
    }
}