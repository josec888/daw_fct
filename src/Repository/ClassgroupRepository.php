<?php

namespace App\Repository;

use App\Entity\Classgroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Classgroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classgroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classgroup[]    findAll()
 * @method Classgroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassgroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classgroup::class);
    }

    // /**
    //  * @return Classgroup[] Returns an array of Classgroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Classgroup
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
