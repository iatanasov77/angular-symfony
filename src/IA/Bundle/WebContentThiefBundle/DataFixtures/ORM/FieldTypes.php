<?php

namespace IA\Bundle\WebContentThiefBundle\DataFixtures\ORM;

use \Doctrine\Common\DataFixtures\AbstractFixture;
use \Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;

use IA\Bundle\WebContentThiefBundle\Entity\FieldType;

class FieldTypes extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * 
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $type1 = new FieldType();
        $type1->setTitle('Text');
        //$this->addReference('FieldType_Text', $type1);
        
        $type2 = new FieldType();
        $type2->setTitle('Picture');
        //$this->addReference('FieldType_Picture', $type2);
        
        $type3 = new FieldType();
        $type3->setTitle('Link');
        //$this->addReference('FieldType_Link', $type3);
        
        $manager->persist($type1);
        $manager->persist($type2);
        $manager->persist($type3);
        
        $manager->flush();
    }
    
    /**
     * 
     * {@inheritDoc}
     */
    public function getOrder()
    {
       return 1; 
    }
}
