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

    public function getAllMaterials($start = 0, $limit = 25 ){

        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'ASC')
            ->setFirstResult(($start * $limit) -  $limit)
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

    public function filter($famille = null, $marque = null){
        $materiels = $this
            ->createQueryBuilder('m')
            ->select('m.id, m.nom_court, m.marque, m.prix_public, m.reference_fabricant, t.famille, me.nom')
            ->join('m.type_id ', 't')
            ->join('t.metier_id', 'me');


        if ($famille !== null) {
            $materiels = $materiels->where('t.famille = :famille')
                ->setParameter('famille', $famille);
        }

        if ($marque !== null) {
            $materiels = $materiels->andWhere('m.marque = :marque')
                ->setParameter('marque', $marque);
        }

        $materiels = $materiels->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);

        return $materiels;
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
