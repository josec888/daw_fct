<?php

namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Schedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schedule[]    findAll()
 * @method Schedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    // /**
    //  * @return Schedule[] Returns an array of Schedule objects
    //  */

    public function findAbsencedTeacher($day,$session)
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.teacher', 't')
            ->innerJoin('s.session', 'se')
            ->andWhere('s.type LIKE :type')
            ->andWhere('s.dow LIKE :dow')
            ->andWhere('se.id LIKE :session')
            ->setParameter('type', 'LEC')
            ->setParameter('dow', $day)
            ->setParameter('session', $session)
            ->orderBy('t.$watches', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Schedule
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
