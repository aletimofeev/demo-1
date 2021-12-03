<?php

namespace App\Repository;

use App\Entity\Emloyees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emloyees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emloyees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emloyees[]    findAll()
 * @method Emloyees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmloyeesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emloyees::class);
    }

    // /**
    //  * @return Emloyees[] Returns an array of Emloyees objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emloyees
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
