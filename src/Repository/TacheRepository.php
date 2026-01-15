<?php

namespace App\Repository;

use App\Entity\Tache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tache>
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tache::class);
    }

    public function findByProjetSortedByDeadline(int $projetId): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.projet = :projetId')
            ->setParameter('projetId', $projetId)
            
            // Si t.deadline est NULL, on lui donne la valeur 1 (trié en dernier). Sinon 0 (trié en premier).
            ->addOrderBy('CASE WHEN t.deadline IS NULL THEN 1 ELSE 0 END', 'ASC')
            ->addOrderBy('t.deadline', 'ASC') // Tri par date la plus proche
            
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Tache[] Returns an array of Tache objects
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

    //    public function findOneBySomeField($value): ?Tache
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
