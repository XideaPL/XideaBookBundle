<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller\Book;

use Symfony\Component\HttpFoundation\Request;
use Xidea\Component\Book\Loader\BookLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractListController;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ListController extends AbstractListController
{
    /*
     * @var BookLoaderInterface
     */
    protected $bookLoader;

    public function __construct(ConfigurationInterface $configuration, BookLoaderInterface $bookLoader)
    {
        parent::__construct($configuration);
        
        $this->bookLoader = $bookLoader;
    }
    
    protected function loadObjects(Request $request)
    {
        return $this->bookLoader->loadAll();
    }
    
    protected function onPreList($objects, Request $request)
    {
        return;
    }
}
