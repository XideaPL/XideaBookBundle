<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Controller\Book;

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

    public function __construct(ConfigurationInterface $configuration, BookDirectorInterface $bookDirector, BookManagerInterface $objectManager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration, $objectManager, $formHandler);

        $this->bookDirector = $bookDirector;
    }

    protected function createObject()
    {
        return $this->bookDirector->build();
    }

    protected function onPreCreate($object, $request)
    {
        $this->dispatch(BookEvents::PRE_CREATE, $event = new GetBookResponseEvent($object, $request));

        return $event->getResponse();
    }

    protected function onCreateSuccess($object, $request)
    {
        $this->dispatch(BookEvents::CREATE_SUCCESS, $event = new GetBookResponseEvent($object, $request));

        if (null === $response = $event->getResponse()) {
            $response = $this->redirectToRoute('xidea_book_show', array(
                'id' => $object->getId()
            ));
        }

        return $response;
    }

    protected function onCreateCompleted($object, $request, $response)
    {
        $this->dispatch(BookEvents::CREATE_COMPLETED, new FilterBookResponseEvent($object, $request, $response));
    }
}
