<?php

namespace App\Repository;

use App\Entity\LiaisonCm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LiaisonCm|null find($id, $lockMode = null, $lockVersion = null)
 * @method LiaisonCm|null findOneBy(array $criteria, array $orderBy = null)
 * @method LiaisonCm[]    findAll()
 * @method LiaisonCm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiaisonCmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiaisonCm::class);
    }

    // /**
    //  * @return LiaisonCm[] Returns an array of LiaisonCm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LiaisonCm
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
