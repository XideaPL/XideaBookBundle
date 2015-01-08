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

use Xidea\Component\Book\Manager\AuthorManagerInterface,
    Xidea\Component\Book\Model\AuthorInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class AuthorManager implements AuthorManagerInterface
{
    /*
     * @var EntityManager
     */
    protected $entityManager;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructs a author manager.
     *
     * @param EntityManager The entity manager
     */
    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function save(AuthorInterface $author)
    {
        $this->entityManager->persist($author);

        $this->entityManager->flush();

        return $author->getId();
    }
    
    public function update(AuthorInterface $author)
    {  
        $this->entityManager->persist($author);

        $this->entityManager->flush();

        return $author->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(AuthorInterface $author)
    {
        $this->entityManager->remove($author);
    }

}
