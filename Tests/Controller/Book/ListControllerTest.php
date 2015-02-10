<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Tests\Controller\Book;

use Xidea\Bundle\BookBundle\Tests\Controller\ControllerTestCase;

class ListControllerTest extends ControllerTestCase
{
    public function testListAction()
    {
        //$client = $this->logIn();
        $client = $this->createClient();

        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('xidea_book_list'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Książki")')->count()
        );
    }
}

