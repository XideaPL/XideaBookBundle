<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Loader;

use Doctrine\ORM\EntityManager;

use Xidea\Component\Book\Loader\PublisherLoaderInterface,
    Xidea\Bundle\BookBundle\Doctrine\ORM\Repository\PublisherRepositoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class PublisherLoader implements PublisherLoaderInterface
{
    /*
     * @var PublisherRepositoryInterface
     */
    protected $publisherRepository;
    
    /**
     * Constructs a comment repository.
     *
     * @param string $class The class
     * @param EntityManager The entity manager
     */
    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->publisherRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->publisherRepository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->publisherRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /*
     * {@inheritdoc}
     */
    public function loadOneBy(array $criteria, array $orderBy = array())
    {
        return $this->publisherRepository->findOneBy($criteria, $orderBy);
    }
}
