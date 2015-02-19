<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\BookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class LoadBookData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = $this->loadData();

        $bookManager = $this->container->get('xidea_book.book.manager');
        
        foreach($data as $book) {
            $bookManager->save($book);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
    
    /**
     * Returns a book factory.
     * 
     * @return \Xidea\Bundle\BookBundle\Model\BookFactory The book factory
     */
    protected function getBookFactory()
    {
        return $this->container->get('xidea_book.book.factory');
    }
    
    /**
     * Returns a data.
     * 
     * @return array The data
     */
    protected function loadData()
    {
        $bookFactory = $this->getBookFactory();
        
        $book1 = $bookFactory->create();
        $book1->setSlug('book1-slug');
        $book1->setIsbn('9788375747478');
        $book1->setEan('9788375747478');
        $book1->setTitle('Book 1');
        $book1->setDescription('Book 1 description');
        $book1->setShortDescription('Book 1 short description');
        $book1->setSeries('Book 1 Series');
        $book1->setBinding(1);
        $book1->setPremiere(new \DateTime('2012-03-26'));
        $book1->setReleaseYear(2012);
        $book1->setReleaseNumber(2);
        $book1->setPages(376);
        $book1->setDimensions('220x140x30');
        $book1->setPrice(39.90);
        $book1->setImagePath('book1-image-path.jpg');
        $book1->setCreatedAt(new \DateTime('2012-04-01'));
        $book1->addBookAuthor($this->getReference('book-author-johndoe'));
        $book1->setPublisher($this->getReference('book-publisher-acme'));
        
        $book2 = $bookFactory->create();
        $book2->setSlug('book2-slug');
        $book2->setIsbn('9788375747478');
        $book2->setEan('9788375747478');
        $book2->setTitle('Book 2');
        $book2->setDescription('Book 2 description');
        $book2->setShortDescription('Book 2 short description');
        $book2->setSeries('Book 2 Series');
        $book2->setBinding(2);
        $book2->setPremiere(new \DateTime('2015-09-14'));
        $book2->setReleaseYear(2015);
        $book2->setReleaseNumber(1);
        $book2->setPages(376);
        $book2->setDimensions('220x240x30');
        $book2->setPrice(39.90);
        $book2->setImagePath('book2-image-path.jpg');
        $book1->setCreatedAt(new \DateTime('2015-09-16'));
        $book2->addBookAuthor($this->getReference('book-author-janedoe'));
        $book2->setPublisher($this->getReference('book-publisher-bigben'));
        
        return array(
            $book1,
            $book2
        );
    }
 
}
