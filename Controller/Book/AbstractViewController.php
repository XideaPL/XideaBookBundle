<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller\Book;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\EventDispatcher\EventDispatcherInterface,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\RouterInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Xidea\Component\Book\Loader\BookLoaderInterface,
    Xidea\Component\Book\Model\BookInterface;

use Xidea\Bundle\BookBundle\BookEvents,
    Xidea\Bundle\BookBundle\Event\GetResponseEvent,
    Xidea\Bundle\BookBundle\Event\GetBookResponseEvent,
    Xidea\Bundle\BookBundle\Event\FilterBookResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractViewController
{
    /*
     * @var BookLoaderInterface
     */
    protected $bookLoader;

    /*
     * @var EngineInterface
     */
    protected $templating;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(BookLoaderInterface $bookLoader, EngineInterface $templating, EventDispatcherInterface $eventDispatcher)
    {
        $this->bookLoader = $bookLoader;
        $this->templating = $templating;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function viewAction($id)
    {
        $book = $this->bookLoader->load($id);

        if(!$book instanceof BookInterface) {
            throw new NotFoundHttpException('book.not_found');
        }

        return $this->templating->renderResponse('XideaBookBundle:Book/View:view.html.twig', array(
            'book' => $book
        ));
    }
}
