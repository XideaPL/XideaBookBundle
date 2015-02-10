<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Loader;

use Doctrine\ORM\EntityManager;

use Xidea\Component\Book\Loader\BookAuthorLoaderInterface,
    Xidea\Bundle\BookBundle\Doctrine\ORM\Repository\BookAuthorRepositoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookAuthorLoader implements BookAuthorLoaderInterface
{
    /*
     * @var BookAuthorRepositoryInterface
     */
    protected $authorRepository;
    
    /**
     * Constructs a comment repository.
     *
     * @param string $class The class
     * @param EntityManager The entity manager
     */
    public function __construct(BookAuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->authorRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->authorRepository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->authorRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /*
     * {@inheritdoc}
     */
    public function loadOneBy(array $criteria, array $orderBy = array())
    {
        return $this->authorRepository->findOneBy($criteria, $orderBy);
    }
}
