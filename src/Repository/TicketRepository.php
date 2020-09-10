<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    // /**
    //  * @return Ticket[] Returns an array of Ticket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ticket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	
 public function ticketGenerique($idMembre, $flag)
{
 
	 $qb = $this->createQueryBuilder('c');
	if($flag == 1){
		$choix = "membreDest";
		$qb ->where('c.statut != 4 ');
	}
	if($flag == 2){
		$choix = "membreExp";
	}
	if($flag == 3 ){
		$qb ->where('c.statut = 4 ');
		$choix = "membreDest";
	}
		$qb
        ->andWhere('c.'.$choix.'= :identifier')
        ->orderBy('c.createdAt', 'DESC')
        ->setParameter('identifier', $idMembre);
	
     return $qb->getQuery()->getResult();
}	
	
	
	
	
	
	
	
	
	
	
	
}
