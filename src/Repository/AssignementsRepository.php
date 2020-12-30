<?php

namespace App\Repository;

use App\Entity\Assignements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Assignements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assignements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assignements[]    findAll()
 * @method Assignements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssignementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assignements::class);
    }
    // /**
    //  * @return Assignements[] Returns an array of Assignements objects
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
    public function findOneBySomeField($value): ?Assignements
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
