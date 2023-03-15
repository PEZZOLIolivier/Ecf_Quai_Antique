<?php

namespace App\Repository;

use App\Entity\Dessert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class DessertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dessert::class);
    }

    public function save(Dessert $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Dessert $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getDessertQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('dessert');
    }

    public function filterActive($queryBuilder, $activeValue): QueryBuilder {
        return $queryBuilder
            ->andWhere('dessert.isPublish = :activeValue')
            ->setParameter('activeValue', $activeValue);
    }

    public function addOrderAsc($queryBuilder): QueryBuilder {
        return $queryBuilder
            ->orderBy('dessert.name', 'ASC');
    }

    public function executeQuery($queryBuilder): array {
        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function getAllActiveDessert(): array {
        $qb = $this->getDessertQueryBuilder();
        $qb = $this->filterActive($qb, true);
        $qb = $this->addOrderAsc($qb);
        return $this->executeQuery($qb);
    }
}
