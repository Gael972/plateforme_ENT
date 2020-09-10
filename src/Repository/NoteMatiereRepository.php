<?php

namespace App\Repository;

use App\Entity\NoteMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteMatiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteMatiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteMatiere[]    findAll()
 * @method NoteMatiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteMatiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteMatiere::class);
    }

    // /**
    //  * @return NoteMatiere[] Returns an array of NoteMatiere objects
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
    public function findOneBySomeField($value): ?NoteMatiere
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
