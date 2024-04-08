<?php

namespace App\Repository;

use App\Entity\UserPerformance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserPerformance>
 *
 * @method UserPerformance|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPerformance|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPerformance[]    findAll()
 * @method UserPerformance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserPerformanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserPerformance::class);
    }

//    /**
//     * @return UserPerformance[] Returns an array of UserPerformance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserPerformance
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
