<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Doctrine\ORM\EntityManager;

use Xidea\Bundle\BaseBundle\Doctrine\ORM\Manager\ModelManagerInterface;

use Xidea\Component\Book\Manager\BookManagerInterface,
    Xidea\Component\Book\Model\BookInterface;

use Xidea\Bundle\BookBundle\BookEvents,
    Xidea\Bundle\BookBundle\Event\BookEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookManager implements ModelManagerInterface, BookManagerInterface
{
    /*
     * @var bool
     */
    protected $flushMode;
    
    /*
     * @var EntityManager
     */
    protected $entityManager;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructs a book manager.
     *
     * @param EntityManager The entity manager
     */
    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        
        $this->setFlushMode(true);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFlushMode($flushMode = true)
    {
        $this->flushMode = $flushMode;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isFlushMode()
    {
        return $this->flushMode;
    }

    /**
     * {@inheritdoc}
     */
    public function save(BookInterface $book)
    {
        $this->eventDispatcher->dispatch(BookEvents::PRE_SAVE, new BookEvent($book));
        
        $this->entityManager->persist($book);

        if($this->isFlushMode())
            $this->entityManager->flush();
        
        $this->eventDispatcher->dispatch(BookEvents::POST_SAVE, new BookEvent($book));

        return $book->getId();
    }
    
    public function update(BookInterface $book)
    {  
        $this->entityManager->persist($book);

        if($this->isFlushMode())
            $this->entityManager->flush();

        return $book->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(BookInterface $book)
    {
        $this->entityManager->remove($book);
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->entityManager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->entityManager->clear();
    }
}
