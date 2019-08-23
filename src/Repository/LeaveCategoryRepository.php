<?php

namespace App\Repository;

use App\Entity\LeaveCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LeaveCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeaveCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeaveCategory[]    findAll()
 * @method LeaveCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeaveCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LeaveCategory::class);
    }

    // /**
    //  * @return LeaveCtegory[] Returns an array of LeaveCtegory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeaveCtegory
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
