<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends EntityRepository
{

    public function findTask($idUserHasCourses, $estado)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT task
            FROM ApiBundle:Task task
            INNER JOIN task.userHasCourses userHasCourses
            WHERE
            userHasCourses.idIncrement IN (:idUserHasCourses) AND 
            task.isActive = :isActive ";

        if(!empty($estado)){
            $dql .= " AND task.estado IN (:estado) ";
        }

        $dql .= "ORDER BY task.idIncrement DESC";


        $query = $em->createQuery($dql);
        $query->setParameter('idUserHasCourses', $idUserHasCourses);
        $query->setParameter('isActive', 1);

        if(!empty($estado)){
            $query->setParameter('estado', $estado);
        }

        return $query->getResult();
    }

}
