<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Tests\Controller\Book;

use Xidea\Bundle\BookBundle\Tests\Controller\ControllerTestCase;

class ShowControllerTest extends ControllerTestCase
{
    public function testShowAction()
    {
        //$client = $this->logIn();
        $client = $this->createClient();
        $book = $client->getContainer()->get('xidea_book.book.loader')->loadOneBy(array('title'=>'Book 1'));

        
        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('xidea_book_show', array('id'=>$book->getId())));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Book 1")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Book 1 description")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Autor")')->count()
        );
    }
}

