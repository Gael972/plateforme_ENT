<?php

namespace App\Repository;

use App\Entity\ShareFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShareFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShareFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShareFile[]    findAll()
 * @method ShareFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShareFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShareFile::class);
    }

    // /**
    //  * @return ShareFile[] Returns an array of ShareFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShareFile
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
