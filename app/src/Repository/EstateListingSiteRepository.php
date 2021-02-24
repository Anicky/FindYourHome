<?php

namespace App\Repository;

use App\Entity\EstateListingSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstateListingSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstateListingSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstateListingSite[]    findAll()
 * @method EstateListingSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstateListingSiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstateListingSite::class);
    }

    // /**
    //  * @return EstateListingSite[] Returns an array of EstateListingSite objects
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
    public function findOneBySomeField($value): ?EstateListingSite
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
