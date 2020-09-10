<?php

namespace App\Repository;

use App\Entity\NoteDevoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteDevoir|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteDevoir|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteDevoir[]    findAll()
 * @method NoteDevoir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteDevoirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteDevoir::class);
    }

    // /**
    //  * @return NoteDevoir[] Returns an array of NoteDevoir objects
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
    public function findOneBySomeField($value): ?NoteDevoir
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
