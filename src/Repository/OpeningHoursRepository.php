<?php

namespace App\Repository;

use App\Entity\OpeningHours;
use Brick\DateTime\LocalDateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OpeningHoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpeningHours::class);
    }

    public function save(OpeningHours $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OpeningHours $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getByDateTime(\DateTime $d) {
        $openHours = $this->findAll();
        $d = LocalDateTime::fromNativeDateTime($d);
        return array_filter($openHours, function($val) use ($d) {
            return $val->GetDay()->name === $d->getDayOfWeek()->__toString();
        });
    }
}
