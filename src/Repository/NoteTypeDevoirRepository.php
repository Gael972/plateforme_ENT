<?php

namespace App\Repository;

use App\Entity\NoteTypeDevoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteTypeDevoir|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteTypeDevoir|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteTypeDevoir[]    findAll()
 * @method NoteTypeDevoir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteTypeDevoirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteTypeDevoir::class);
    }

    // /**
    //  * @return NoteTypeDevoir[] Returns an array of NoteTypeDevoir objects
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
    public function findOneBySomeField($value): ?NoteTypeDevoir
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
