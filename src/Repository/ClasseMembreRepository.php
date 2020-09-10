<?php

namespace App\Repository;

use App\Entity\ClasseMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClasseMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseMembre[]    findAll()
 * @method ClasseMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseMembre::class);
    }

    // /**
    //  * @return ClasseMembre[] Returns an array of ClasseMembre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClasseMembre
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
