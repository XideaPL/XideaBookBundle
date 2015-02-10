<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller\Book;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Xidea\Component\Book\Loader\BookLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractShowController;
use Xidea\Component\Book\Model\BookInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ShowController extends AbstractShowController
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

    protected function loadObject($id)
    {
        $book = $this->bookLoader->load($id);

        if (!$book instanceof BookInterface) {
            throw new NotFoundHttpException('book.not_found');
        }

        return $book;
    }

    protected function onPreShow($object, $request)
    {
        return;
    }
}
