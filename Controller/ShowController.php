<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Xidea\Book\LoaderInterface;
use Xidea\Base\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractController;
use Xidea\Book\BookInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ShowController extends AbstractController
{
    /*
     * @var LoaderInterface
     */
    protected $loader;
    
    /**
     * 
     * @param ConfigurationInterface $configuration
     * @param LoaderInterface $loader
     */
    public function __construct(ConfigurationInterface $configuration, LoaderInterface $loader)
    {
        parent::__construct($configuration);

        $this->loader = $loader;
    }
    
    /**
     * 
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function showAction($id, Request $request)
    {
        $model = $this->loadModel($id);
        
        return $this->render('book_show', array(
            'model' => $model
        ));
    }

    /**
     * @param int $id
     * 
     * @return BookInterface|null
     */
    protected function loadModel($id)
    {
        $book = $this->loader->load($id);

        if (!$book instanceof BookInterface) {
            throw new NotFoundHttpException('book.not_found');
        }

        return $book;
    }
}
