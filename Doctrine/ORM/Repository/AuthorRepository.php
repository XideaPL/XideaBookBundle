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
class AuthorRepository extends EntityRepository implements AuthorRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findQb()
    {
        $qb = $this->createQueryBuilder('a');
        
        return $qb;
    }
    
    /**
     * {@inheritdoc}
     */
    public function findByName($name)
    {
        $qb = $this->createQueryBuilder('a');
        
        if(is_array($name)) {
            $qb->where($qb->expr()->in('a.name', $name));
        } else {
            $qb
                ->where($qb->expr()->eq('a.name', ':name'))
                ->setParameter('name', $name)
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
