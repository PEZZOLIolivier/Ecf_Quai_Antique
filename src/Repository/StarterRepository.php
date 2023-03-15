<?php

namespace App\Repository;

use App\Entity\Starter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;


class StarterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Starter::class);
    }

    public function save(Starter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Starter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getStarterQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('starter');
    }

    public function filterActive($queryBuilder, $activeValue): QueryBuilder {
        return $queryBuilder
            ->andWhere('starter.isPublish = :activeValue')
            ->setParameter('activeValue', $activeValue);
    }

    public function addOrderAsc($queryBuilder): QueryBuilder {
        return $queryBuilder
            ->orderBy('starter.name', 'ASC');
    }

    public function executeQuery($queryBuilder): array {
        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function getAllActiveStarter(): array {
        $qb = $this->getStarterQueryBuilder();
        $qb = $this->filterActive($qb, true);
        $qb = $this->addOrderAsc($qb);
        return $this->executeQuery($qb);
    }

}
