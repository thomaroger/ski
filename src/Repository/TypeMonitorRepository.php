<?php

namespace App\Repository;

use App\Entity\TypeMonitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeMonitor>
 *
 * @method TypeMonitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMonitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMonitor[]    findAll()
 * @method TypeMonitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMonitorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMonitor::class);
    }

//    /**
//     * @return TypeMonitor[] Returns an array of TypeMonitor objects
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

//    public function findOneBySomeField($value): ?TypeMonitor
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
