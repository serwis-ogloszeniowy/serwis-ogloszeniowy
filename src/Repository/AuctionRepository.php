<?php

namespace App\Repository;

use App\Entity\Auction;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Auction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auction[]    findAll()
 * @method Auction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auction::class);
    }

    public function getAllAuctions(User $user)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user = :id')
            ->setParameter('id', $user->getId())
            ->orderBy('p.title', 'DESC')
            ->getQuery()->getResult();
    }

    public function getLatestAuctions()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(9)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Auction[] Returns an array of Auction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Auction
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
