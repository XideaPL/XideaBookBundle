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

use Xidea\Component\Base\Doctrine\ORM\ObjectManagerInterface;

use Xidea\Component\Book\Manager\PublisherManagerInterface,
    Xidea\Component\Book\Model\PublisherInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class PublisherManager implements ObjectManagerInterface, PublisherManagerInterface
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
     * Constructs a publisher manager.
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
    public function save(PublisherInterface $publisher)
    {
        $this->entityManager->persist($publisher);

        if($this->isFlushMode())
            $this->entityManager->flush();

        return $publisher->getId();
    }
    
    /**
     * {@inheritdoc}
     */
    public function update(PublisherInterface $publisher)
    {  
        $this->entityManager->persist($publisher);

        if($this->isFlushMode())
            $this->entityManager->flush();

        return $publisher->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(PublisherInterface $publisher)
    {
        $this->entityManager->remove($publisher);
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
