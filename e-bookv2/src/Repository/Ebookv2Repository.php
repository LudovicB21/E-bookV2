<?php

namespace App\Repository;

use App\Entity\Ebookv2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ebookv2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ebookv2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ebookv2[]    findAll()
 * @method Ebookv2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Ebookv2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ebookv2::class);
    }

    // /**
    //  * @return Ebookv2[] Returns an array of Ebookv2 objects
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
    public function findOneBySomeField($value): ?Ebookv2
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
