<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\Tests\Model;

use Xidea\Bundle\BookBundle\Tests\Fixtures\Model\Book,
    Xidea\Bundle\BookBundle\Tests\Fixtures\Model\Author;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class BookTest extends \PHPUnit_Framework_TestCase
{
    public function testId()
    {
        $book = $this->createBook();
        $this->assertNull($book->getId());
        
        $book->setId(1);
        $this->assertEquals(1, $book->getId());
    }
    
    public function testTitle()
    {
        $book = $this->createBook();
        $this->assertNull($book->getTitle());
        
        $title = 'Book 1';
        
        $book->setTitle($title);
        $this->assertEquals($title, $book->getTitle());
    }
    
    public function testDescription()
    {
        $book = $this->createBook();
        $this->assertNull($book->getDescription());
        
        $description = 'Book 1 description';
        
        $book->setDescription($description);
        $this->assertEquals($description, $book->getDescription());
    }
    
    public function testCreatedAt()
    {
        $book = $this->createBook();
        $this->assertNull($book->getCreatedAt());
        $book->setCreatedAt();
        $this->assertNull($book->getCreatedAt());

        $date = new \DateTime();
        
        $book->setCreatedAt($date);
        $this->assertEquals($date, $book->getCreatedAt());
    }
    
    public function testUpdatedAt()
    {
        $book = $this->createBook();
        $this->assertNull($book->getUpdatedAt());
        $book->setCreatedAt();
        $this->assertNull($book->getUpdatedAt());

        $date = new \DateTime();
        
        $book->setUpdatedAt($date);
        $this->assertEquals($date, $book->getUpdatedAt());
    }
    
    protected function createBook()
    {
        return new Book();
    }
}
