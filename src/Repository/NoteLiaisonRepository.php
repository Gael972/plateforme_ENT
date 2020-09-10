<?php

namespace App\Repository;

use App\Entity\NoteLiaison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteLiaison|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteLiaison|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteLiaison[]    findAll()
 * @method NoteLiaison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteLiaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteLiaison::class);
    }

    // /**
    //  * @return NoteLiaison[] Returns an array of NoteLiaison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteLiaison
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
