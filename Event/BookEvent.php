<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Event;

use Symfony\Component\EventDispatcher\Event,
    Symfony\Component\HttpFoundation\Request;

use Xidea\Component\Book\Model\BookInterface;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class BookEvent extends Event
{

    /**
     * @var BookInterface
     */
    protected $book;
    
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructs an event.
     *
     * @param BookInterface $book The book
     */
    public function __construct(BookInterface $book, Request $request = null)
    {
        $this->book = $book;
        $this->request = $request;
    }

    /**
     * @return BookInterface
     */
    public function getBook()
    {
        return $this->book;
    }
    
    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}
