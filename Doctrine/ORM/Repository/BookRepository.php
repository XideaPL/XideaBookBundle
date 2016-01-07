<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;

use Xidea\Book\AuthorInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookRepository extends EntityRepository implements BookRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findQb()
    {
        $qb = $this->createQueryBuilder('b');
        
        return $qb;
    }
    
    /**
     * {@inheritdoc}
     */
    public function findByAuthorQB(AuthorInterface $author)
    {
        $qb = $this->createQueryBuilder('b');
        $qb
            ->select(array(
                'b',
                'ba'
            ))
            ->join('b.authors', 'ba')
            ->where($qb->expr()->eq('b.authors', ':authorId'))
            ->setParameters(array(
                'authorId' => $author->getId()
            ))
        ;

        $qb->orderBy('b.createdAt', 'DESC');

        return $qb;
    }
    
    /**
     * {@inheritdoc}
     */
    public function findByAuthor(AuthorInterface $author)
    {
        $qb = $this->findByAuthorQB($author);

        return $qb->getQuery()->getResult();
    }
}
