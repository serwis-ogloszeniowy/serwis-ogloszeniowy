<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getByLogin(string $login): array
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.login=:login')
            ->setParameter('login', $login);

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function getByEmail(string $email)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.email=:email')
            ->setParameter('email', $email);

        $query = $qb->getQuery();

        return $query->execute();
    }
}
