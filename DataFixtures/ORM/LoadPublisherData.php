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
 * @publisher Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class LoadPublisherData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $publisherManager = $this->container->get('xidea_book.publisher.manager');
        
        foreach($data as $publisher) {
            $publisherManager->save($publisher);
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
     * Returns a publisher factory.
     * 
     * @return \Xidea\Bundle\BookBundle\Model\PublisherFactory The publisher factory
     */
    protected function getPublisherFactory()
    {
        return $this->container->get('xidea_book.publisher.factory');
    }
    
    /**
     * Returns a data.
     * 
     * @return array The data
     */
    protected function loadData()
    {
        $publisherFactory = $this->getPublisherFactory();
        
        $acme = $publisherFactory->create();
        $acme->setName('Acme');
        $acme->setDescription('Acme description');
        $this->setReference('book-publisher-acme', $acme);
        
        $bigben = $publisherFactory->create();
        $bigben->setName('Big Ben');
        $bigben->setDescription('Big Ben description');
        $this->setReference('book-publisher-bigben', $bigben);
        
        return array(
            $acme,
            $bigben
        );
    }
 
}
