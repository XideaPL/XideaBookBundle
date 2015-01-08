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
    Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
    Symfony\Component\Routing\RouterInterface;

use Xidea\Component\Book\Loader\BookLoaderInterface,
    Xidea\Bundle\BookBundle\BookEvents,
    Xidea\Bundle\BookBundle\Event\GetResponseEvent,
    Xidea\Bundle\BookBundle\Event\GetBookResponseEvent,
    Xidea\Bundle\BookBundle\Event\FilterBookResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractListController
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

    public function listAction()
    {
        $books = $this->bookLoader->loadAll();

        return $this->templating->renderResponse('XideaBookBundle:Book/List:list.html.twig', array(
            'books' => $books
        ));
    }
}
