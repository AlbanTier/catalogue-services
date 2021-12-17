<?php

namespace App\Repository;

use App\Entity\Porduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Porduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Porduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Porduit[]    findAll()
 * @method Porduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PorduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Porduit::class);
    }

    // /**
    //  * @return Porduit[] Returns an array of Porduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Porduit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
