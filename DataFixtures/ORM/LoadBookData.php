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

        $bookManager = $this->container->get('xidea_book.book_manager');
        
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
        return $this->container->get('xidea_book.book_factory');
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
        $book1->setTitle('Book 1');
        $book1->setDescription('Book 1 description');
        $book1->setAuthor($this->getReference('book-author-johndoe'));
        $book1->setPublisher($this->getReference('book-publisher-acme'));
        
        $book2 = $bookFactory->create();
        $book2->setTitle('Book 2');
        $book2->setDescription('Book 2 description');
        $book2->setAuthor($this->getReference('book-author-janedoe'));
        $book2->setPublisher($this->getReference('book-publisher-bigben'));
        
        return array(
            $book1,
            $book2
        );
    }
 
}
