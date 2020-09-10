<?php

namespace App\Repository;

use App\Entity\LiaisonFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LiaisonFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method LiaisonFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method LiaisonFile[]    findAll()
 * @method LiaisonFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiaisonFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiaisonFile::class);
    }

    // /**
    //  * @return LiaisonFile[] Returns an array of LiaisonFile objects
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
    public function findOneBySomeField($value): ?LiaisonFile
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
