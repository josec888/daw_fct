<?php

namespace App\Repository;

use App\Entity\Absence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Absence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Absence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Absence[]    findAll()
 * @method Absence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbsenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Absence::class);
    }

    /**
     * @return Absence[] Returns an array of Absence objects
     */
    public function getAbsences($dia,$session)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.session', 's')
            ->innerJoin('a.teacher', 't')
            ->innerJoin('t.schedules', 'sch')
            ->innerJoin('sch.classgroup', 'g')
            ->andWhere('a.dateleave = :dia')
            ->andWhere('a.session = :session')
            ->andWhere('sch.type LIKE :type')
            ->setParameter('type', 'LEC')
            ->setParameter('dia', $dia)
            ->setParameter('session', $session)
            ->orderBy('g.priority', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Absence[] Returns an array of Absence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Absence
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
