<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Doctrine\ORM\Repository;

use Xidea\Book\AuthorInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface BookRepositoryInterface
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
    
    /**
     * @return object
     */
    function findQb();
    
    /**
     * Returns a query builder.
     * 
     * @return object
     */
    public function findByAuthorQB(AuthorInterface $author);
    
    /**
     * Returns a set of books by author.
     * 
     * @return array
     */
    public function findByAuthor(AuthorInterface $author);
}
