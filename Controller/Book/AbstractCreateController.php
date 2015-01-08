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

use Xidea\Component\Book\Builder\BookDirectorInterface,
    Xidea\Component\Book\Manager\BookManagerInterface,
    Xidea\Bundle\BookBundle\Form\Handler\BookFormHandlerInterface,
    Xidea\Bundle\BookBundle\BookEvents,
    Xidea\Bundle\BookBundle\Event\GetResponseEvent,
    Xidea\Bundle\BookBundle\Event\GetBookResponseEvent,
    Xidea\Bundle\BookBundle\Event\FilterBookResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractCreateController
{
    /*
     * @var BookDirectorInterface
     */
    protected $bookDirector;

    /*
     * @var BookManagerInterface
     */
    protected $bookManager;

    /*
     * @var BookFormHandlerInterface
     */
    protected $formHandler;
    
    /*
     * @var RouterInterface
     */
    protected $router;

    /*
     * @var EngineInterface
     */
    protected $templating;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(BookDirectorInterface $bookDirector, BookManagerInterface $bookManager, BookFormHandlerInterface $formHandler, RouterInterface $router, EngineInterface $templating, EventDispatcherInterface $eventDispatcher)
    {
        $this->bookDirector = $bookDirector;
        $this->bookManager = $bookManager;
        $this->formHandler = $formHandler;
        $this->router = $router;
        $this->templating = $templating;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createAction(Request $request)
    {
        $event = new GetResponseEvent($request);
        $this->eventDispatcher->dispatch(BookEvents::CREATE_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $book = $this->bookDirector->build();
        $form = $this->formHandler->createForm();
        $form->setData($book);

        $event = new GetBookResponseEvent($book, $request);
        $this->eventDispatcher->dispatch(BookEvents::PRE_CREATE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        
        if($this->formHandler->handle($form, $request)) {
            if ($this->manager->save($book)) {
                $event = new GetBookResponseEvent($book, $request);
                $this->eventDispatcher->dispatch(BookEvents::CREATE_SUCCESS, $event);

                if (null === $response = $event->getResponse()) {
                    $url = $this->router->generate('xidea_book_view', array(
                        'id' => $book->getId()
                    ));
                    
                    $response = new RedirectResponse($url);
                }

                $this->eventDispatcher->dispatch(BookEvents::CREATE_COMPLETED, new FilterBookResponseEvent($book, $request, $response));

                return $response;
            }
        }

        return $this->templating->renderResponse('XideaBookBundle:Book/Create:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function createFormAction()
    {
        $form = $this->formHandler->buildForm();

        return $this->templating->renderResponse('XideaBookBundle:Book/Create:create_form.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
