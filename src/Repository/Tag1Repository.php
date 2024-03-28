<?php

namespace App\Repository;

use App\Entity\Tag1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag1>
 *
 * @method Tag1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag1[]    findAll()
 * @method Tag1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tag1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag1::class);
    }

    //    /**
    //     * @return Tag1[] Returns an array of Tag1 objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Tag1
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
