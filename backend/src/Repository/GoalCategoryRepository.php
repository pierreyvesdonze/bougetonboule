<?php

namespace App\Repository;

use App\Entity\GoalCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GoalCategory>
 *
 * @method GoalCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoalCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoalCategory[]    findAll()
 * @method GoalCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoalCategory::class);
    }

    //    /**
    //     * @return GoalCategory[] Returns an array of GoalCategory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GoalCategory
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
