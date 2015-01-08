<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Event;

use Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

use Xidea\Component\Book\Model\BookInterface;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class GetBookResponseEvent extends BookEvent
{

    private $response;
    
    public function __construct(BookInterface $product, Request $request)
    {
        parent::__construct($product, $request);
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

}
