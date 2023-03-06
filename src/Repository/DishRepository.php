<?php

namespace App\Repository;

use App\Entity\Dish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;


class DishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dish::class);
    }

    public function save(Dish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Dish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getDishQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('dish');
    }

    public function filterActive($queryBuilder, $activeValue): QueryBuilder {
        return $queryBuilder
            ->andWhere('dish.isPublish = :activeValue')
            ->setParameter('activeValue', $activeValue);
    }

    public function filterByCategory($queryBuilder, $categoryValue): QueryBuilder {
        return $queryBuilder
            ->join('dish.category', 'cat')
            ->where('cat.name = :catval')
            ->setParameter('catval', $categoryValue);
    }

    public function addOrderAsc($queryBuilder): QueryBuilder {
        return $queryBuilder
            ->orderBy('dish.name', 'ASC');
    }

    public function executeQuery($queryBuilder): array {
        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function getAllActiveStarter(): array {
        $qb = $this->getDishQueryBuilder();
        $qb = $this->filterByCategory($qb, 'Entrée');
        $qb = $this->filterActive($qb, true);
        $qb = $this->addOrderAsc($qb);
        return $this->executeQuery($qb);
    }

}
