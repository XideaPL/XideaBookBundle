<?php

namespace Xidea\Bundle\BookBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

use Xidea\Bundle\BaseBundle\AbstractBundle;

class XideaBookBundle extends AbstractBundle
{
    protected function getModelMappings()
    {
        return array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Xidea\Component\Book\Model',
        );
    }
}
