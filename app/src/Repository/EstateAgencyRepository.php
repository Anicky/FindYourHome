<?php

namespace App\Repository;

use App\Entity\EstateAgency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstateAgency|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstateAgency|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstateAgency[]    findAll()
 * @method EstateAgency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstateAgencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstateAgency::class);
    }

    // /**
    //  * @return EstateAgency[] Returns an array of EstateAgency objects
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
    public function findOneBySomeField($value): ?EstateAgency
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
