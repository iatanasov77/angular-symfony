<?php

namespace IA\Bundle\ServerBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContactsRepository extends EntityRepository
{
	  public function countTotal()
      {
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(c) FROM IAServerBundle:Contact c');

        return $query->getSingleScalarResult();
      }
}
