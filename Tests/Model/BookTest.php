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
    
    public function testSlug()
    {
        $book = $this->createBook();
        $this->assertNull($book->getSlug());
        
        $book->setSlug('book-title-johndoe');
        $this->assertEquals('book-title-johndoe', $book->getSlug());
    }
    
    public function testEan()
    {
        $book = $this->createBook();
        $this->assertNull($book->getEan());
        
        $book->setEan('9788375747478');
        $this->assertEquals('9788375747478', $book->getEan());
    }
    
    public function testIsbn()
    {
        $book = $this->createBook();
        $this->assertNull($book->getIsbn());
        
        $book->setIsbn('9788375747478');
        $this->assertEquals('9788375747478', $book->getIsbn());
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
    
    public function testShortDescription()
    {
        $book = $this->createBook();
        $this->assertNull($book->getShortDescription());
        
        $description = 'Book 1 short description';
        
        $book->setShortDescription($description);
        $this->assertEquals($description, $book->getShortDescription());
    }
    
    public function testSeries()
    {
        $book = $this->createBook();
        $this->assertNull($book->getSeries());
        
        $series = 'Book Series';
        
        $book->setSeries($series);
        $this->assertEquals($series, $book->getSeries());
    }
    
    public function testBinding()
    {
        $book = $this->createBook();
        $this->assertNull($book->getBinding());
        
        $book->setBinding(1);
        $this->assertEquals(1, $book->getBinding());
    }
    
    public function testPremiere()
    {
        $book = $this->createBook();
        $this->assertNull($book->getPremiere());
        $book->setPremiere();
        $this->assertNull($book->getPremiere());

        $date = new \DateTime('2012-03-16');
        
        $book->setPremiere($date);
        $this->assertEquals($date, $book->getPremiere());
    }
    
    public function testReleaseYear()
    {
        $book = $this->createBook();
        $this->assertNull($book->getReleaseYear());
        
        $book->setReleaseYear(2015);
        $this->assertEquals(2015, $book->getReleaseYear());
    }
    
    public function testReleaseNumber()
    {
        $book = $this->createBook();
        $this->assertNull($book->getReleaseNumber());
        
        $book->setReleaseNumber(2015);
        $this->assertEquals(2015, $book->getReleaseNumber());
    }
    
    public function testPages()
    {
        $book = $this->createBook();
        $this->assertNull($book->getPages());
        
        $book->setPages(376);
        $this->assertEquals(376, $book->getPages());
    }
    
    public function testDimensions()
    {
        $book = $this->createBook();
        $this->assertNull($book->getDimensions());
        
        $dimensions = '220x140x30';
        
        $book->setDimensions($dimensions);
        $this->assertEquals($dimensions, $book->getDimensions());
    }
    
    public function testPrice()
    {
        $book = $this->createBook();
        $this->assertNull($book->getPrice());
        
        $book->setPrice(39.90);
        $this->assertEquals(39.90, $book->getPrice());
    }
    
    public function testImagePath()
    {
        $book = $this->createBook();
        $this->assertNull($book->getImagePath());
        
        $path = 'book-image-path.jpg';
        
        $book->setImagePath($path);
        $this->assertEquals($path, $book->getImagePath());
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
