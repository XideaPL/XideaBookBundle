<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookAuthorRepository extends EntityRepository implements BookAuthorRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        $qb = $this->createQueryBuilder('a');
        
        $qb
            ->where(is_array($name) ? $qb->expr()->in('a.name', ':name') : $qb->expr()->eq('a.name', ':name'))
            ->setParameter('name', $name)
        ;

        return $qb->getQuery()->getResult();
    }
}
