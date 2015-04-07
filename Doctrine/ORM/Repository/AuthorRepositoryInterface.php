<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Repository;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface AuthorRepositoryInterface
{
    /**
     * @param int $id
     * 
     * @return object
     */
    function find($id);
    
    /**
     * @return array
     */
    function findAll();
    
    /**
     * @return array
     */
    function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null);
    
    /**
     * @return array
     */
    function findOneBy(array $criteria, array $orderBy = array());
    
    /*
     * @param string|array $name
     * 
     * @return array
     */
    function findByName($name);
}
