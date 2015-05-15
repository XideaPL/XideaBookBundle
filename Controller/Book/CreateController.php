<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller\Book;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;
use Xidea\Component\Book\Builder\BookDirectorInterface,
    Xidea\Component\Book\Manager\BookManagerInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractCreateController,
    Xidea\Bundle\BaseBundle\Form\Handler\FormHandlerInterface;
use Xidea\Bundle\BookBundle\BookEvents,
    Xidea\Bundle\BookBundle\Event\GetBookResponseEvent,
    Xidea\Bundle\BookBundle\Event\FilterBookResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CreateController extends AbstractCreateController
{
    /*
     * @var BookDirectorInterface
     */
    protected $bookDirector;

    /*
     * @var BookManagerInterface
     */
    protected $bookManager;

    public function __construct(ConfigurationInterface $configuration, BookDirectorInterface $bookDirector, BookManagerInterface $modelManager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration, $modelManager, $formHandler);

        $this->bookDirector = $bookDirector;
    }

    protected function createModel()
    {
        return $this->bookDirector->build();
    }

    protected function onPreCreate($model, Request $request)
    {
        $this->dispatch(BookEvents::PRE_CREATE, $event = new GetBookResponseEvent($model, $request));

        return $event->getResponse();
    }

    protected function onCreateSuccess($model, Request $request)
    {
        $this->dispatch(BookEvents::CREATE_SUCCESS, $event = new GetBookResponseEvent($model, $request));

        if (null === $response = $event->getResponse()) {
            $response = $this->redirectToRoute('xidea_book_show', array(
                'id' => $model->getId()
            ));
        }

        return $response;
    }

    protected function onCreateCompleted($model, Request $request, Response $response)
    {
        $this->dispatch(BookEvents::CREATE_COMPLETED, new FilterBookResponseEvent($model, $request, $response));
    }
}
