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
class LoadAuthorData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $authorManager = $this->container->get('xidea_book.author.manager');
        
        foreach($data as $author) {
            $authorManager->save($author);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
    
    /**
     * Returns a author factory.
     * 
     * @return \Xidea\Bundle\BookBundle\Model\AuthorFactory The author factory
     */
    protected function getAuthorFactory()
    {
        return $this->container->get('xidea_book.author.factory');
    }
    
    /**
     * Returns a data.
     * 
     * @return array The data
     */
    protected function loadData()
    {
        $authorFactory = $this->getAuthorFactory();
        
        $johndoe = $authorFactory->create();
        $johndoe->setName('John Doe');
        $johndoe->setDescription('John Doe description');
        $this->setReference('book-author-johndoe', $johndoe);
        
        $janedoe = $authorFactory->create();
        $janedoe->setName('Jane Doe');
        $janedoe->setDescription('Jane Doe description');
        $this->setReference('book-author-janedoe', $janedoe);
        
        return array(
            $johndoe,
            $janedoe
        );
    }
 
}
