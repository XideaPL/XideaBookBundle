<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Form\Handler;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\EventDispatcher\EventDispatcherInterface,
    Symfony\Component\Form\FormInterface;

use Xidea\Bundle\BaseBundle\Form\Handler\FormHandlerInterface,
    Xidea\Bundle\BaseBundle\Form\Factory\FormFactoryInterface,
    Xidea\Bundle\BaseBundle\Event\FormEvent;

use Xidea\Bundle\BookBundle\BookEvents;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class AuthorFormHandler implements FormHandlerInterface
{
    /*
     * @var FormFactoryInterface
     */
    protected $formFactory;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;
    
    /*
     * @var string
     */
    protected $requestMethod = 'POST';
    
    /**
     * Constructs a form handler.
     *
     * @param EngineInterface The engine
     */
    public function __construct(FormFactoryInterface $formFactory, EventDispatcherInterface $eventDispatcher)
    {
        $this->formFactory = $formFactory;
        $this->eventDispatcher = $eventDispatcher;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setRequestMethod($method)
    {
        $this->requestMethod = $method;
    }
    
    /**
     * {@inheritdoc}
     */
    public function createForm()
    {
        return $this->formFactory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function handle(FormInterface $form, Request $request)
    {
        if ($request->isMethod($this->requestMethod)) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $this->eventDispatcher->dispatch(BookEvents::FORM_VALID, $event);
                
                return true;
            }
        }
        
        return false;
    }
}
