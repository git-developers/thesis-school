<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * CommunicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommunicationRepository extends EntityRepository
{

    public function findAll()
    {
        return $this->findBy(array('isActive' => true), array('idIncrement' => 'DESC'));
    }

    public function findByUserHasCourses($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT communication, userHasCourses
            FROM ApiBundle:Communication communication
            INNER JOIN communication.userHasCourses userHasCourses
            WHERE
            userHasCourses.idIncrement IN (:id)
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getResult();
    }

    public function findAllByUserHasCourses2($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT communication, userHasCourses
            FROM ApiBundle:Communication communication
            INNER JOIN communication.userHasCourses userHasCourses
            WHERE
            userHasCourses.idIncrement = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getResult();
    }

}