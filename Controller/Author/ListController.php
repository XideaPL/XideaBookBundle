<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller\Author;

use Symfony\Component\HttpFoundation\Request;
use Xidea\Component\Book\Loader\AuthorLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractListController;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ListController extends AbstractListController
{
    /*
     * @var AuthorLoaderInterface
     */
    protected $authorLoader;

    public function __construct(ConfigurationInterface $configuration, AuthorLoaderInterface $authorLoader)
    {
        parent::__construct($configuration);
        
        $this->authorLoader = $authorLoader;
        $this->listTemplate = 'book_author_list';
    }
    
    protected function loadModels(Request $request)
    {
        return $this->authorLoader->loadAll();
    }
    
    protected function onPreList($models, Request $request)
    {
        return;
    }
}
