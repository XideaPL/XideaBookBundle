<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Tests\Controller\Book;

use Xidea\Bundle\BookBundle\Tests\Controller\ControllerTestCase;

class CreateControllerTest extends ControllerTestCase
{
    public function testCreateAction()
    {
        $client = $this->logIn();

        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('xidea_book_create'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Nowa książka")')->count()
        );
    }
}

