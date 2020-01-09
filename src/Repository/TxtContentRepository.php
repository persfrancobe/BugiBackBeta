<?php

namespace App\Repository;

use App\Entity\TxtContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TxtContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method TxtContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method TxtContent[]    findAll()
 * @method TxtContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TxtContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TxtContent::class);
    }

    // /**
    //  * @return TxtContent[] Returns an array of TxtContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TxtContent
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
