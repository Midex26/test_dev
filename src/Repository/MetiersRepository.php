<?php

namespace App\Repository;

use App\Entity\Metiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Metiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Metiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Metiers[]    findAll()
 * @method Metiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Metiers::class);
    }

    // /**
    //  * @return Metiers[] Returns an array of Metiers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Metiers
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
