<?php

namespace App\Repository;

use App\Entity\Materiels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materiels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiels[]    findAll()
 * @method Materiels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiels::class);
    }

    public function getAllMaterials($limit = 25, $start = 0){
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'ASC')
            ->setFirstResult($start)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getBrand(){
        return $this->createQueryBuilder('m')
            ->select('m.marque')
            ->orderBy('m.id', 'ASC')
            ->distinct()
            ->getQuery()
            ->getResult() ;
    }

    public function search($value){
        return $this->createQueryBuilder('m')
            ->where('m.nom like :value')
            ->orWhere('m.nom_court like :value')
            ->orWhere('m.commentaire like :value')
            ->orWhere('m.reference_fabricant like :value')

            ->orderBy('m.id', 'ASC')
            ->setParameter('value','%'.$value.'%')
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY)
            ;
    }
    // /**
    //  * @return Materiels[] Returns an array of Materiels objects
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
    public function findOneBySomeField($value): ?Materiels
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
