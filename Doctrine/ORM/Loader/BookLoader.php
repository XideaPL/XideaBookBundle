<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Loader;

use Xidea\Book\LoaderInterface,
    Xidea\Bundle\BookBundle\Doctrine\ORM\Repository\BookRepositoryInterface;
use Xidea\Base\ConfigurationInterface,
    Xidea\Base\Pagination\PaginatorInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookLoader implements LoaderInterface
{
    /*
     * @var BookRepositoryInterface
     */
    protected $repository;
    
    /*
     * @var ConfigurationInterface
     */
    protected $configuration;
    
    /*
     * @var PaginatorInterface
     */
    protected $paginator;
    
    /**
     * Constructs a loader.
     *
     * @param BookRepositoryInterface $repository The repository
     * @param ConfigurationInterface $configuration The configuration
     * @param PaginatorInterface $paginator The paginator
     */
    public function __construct(BookRepositoryInterface $repository, ConfigurationInterface $configuration, PaginatorInterface $paginator)
    {
        $this->repository = $repository;
        $this->configuration = $configuration;
        $this->paginator = $paginator;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->repository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /*
     * {@inheritdoc}
     */
    public function loadOneBy(array $criteria, array $orderBy = array())
    {
        return $this->repository->findOneBy($criteria, $orderBy);
    }
    
    /*
     * @return PaginationInterface
     */
    public function loadByPage($page = 1, $limit = 25)
    {
        $qb = $this->repository->findQb();
        
        return $this->paginator->paginate($qb, $page, $limit);
    }
}
