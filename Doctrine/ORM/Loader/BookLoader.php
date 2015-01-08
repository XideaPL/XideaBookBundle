<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Loader;

use Doctrine\ORM\EntityManager;

use Xidea\Component\Book\Loader\BookLoaderInterface,
    Xidea\Bundle\BookBundle\Doctrine\ORM\Repository\BookRepositoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookLoader implements BookLoaderInterface
{
    /*
     * @var BookRepositoryInterface
     */
    protected $bookRepository;
    
    /**
     * Constructs a comment repository.
     *
     * @param string $class The class
     * @param EntityManager The entity manager
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->bookRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->bookRepository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->bookRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /*
     * {@inheritdoc}
     */
    public function loadOneBy(array $criteria, array $orderBy = array())
    {
        return $this->bookRepository->findOneBy($criteria, $orderBy);
    }
}
