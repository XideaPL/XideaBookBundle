<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Event;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

use Xidea\Component\Book\Model\BookInterface;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class FilterBookResponseEvent extends BookEvent
{

    private $response;

    public function __construct(BookInterface $book, Request $request, Response $response)
    {
        parent::__construct($book, $request);
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}
