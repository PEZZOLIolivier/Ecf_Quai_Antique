<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", enumType: Weekday::class)]
    private Weekday $day;

    #[ORM\Column(nullable: true)]
    private ?bool $dayClosed = null;

    #[ORM\Column(nullable: true)]
    private ?bool $lunchClosed = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lunchStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lunchEnd = null;

    #[ORM\Column(nullable: true)]
    private ?int $lunchMaxPlaces = null;

    #[ORM\Column(nullable: true)]
    private ?bool $eveningClosed = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $eveningStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $eveningEnd = null;

    #[ORM\Column(nullable: true)]
    private ?int $eveningMaxPlaces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): Weekday
    {
        return $this->day;
    }

    public function setDay(Weekday $day): void
    {
        $this->day = $day;
    }

    public function isDayClosed(): ?bool
    {
        return $this->dayClosed;
    }

    public function setDayClosed(?bool $dayClosed): self
    {
        $this->dayClosed = $dayClosed;

        return $this;
    }

    public function isLunchClosed(): ?bool
    {
        return $this->lunchClosed;
    }

    public function setLunchClosed(?bool $lunchClosed): self
    {
        $this->lunchClosed = $lunchClosed;

        return $this;
    }

    public function getLunchStart(): ?\DateTimeInterface
    {
        return $this->lunchStart;
    }

    public function setLunchStart(?\DateTimeInterface $lunchStart): self
    {
        $this->lunchStart = $lunchStart;

        return $this;
    }

    public function getLunchEnd(): ?\DateTimeInterface
    {
        return $this->lunchEnd;
    }

    public function setLunchEnd(?\DateTimeInterface $lunchEnd): self
    {
        $this->lunchEnd = $lunchEnd;

        return $this;
    }

    public function getLunchMaxPlaces(): ?int
    {
        return $this->lunchMaxPlaces;
    }

    public function setLunchMaxPlaces(?int $lunchMaxPlaces): self
    {
        $this->lunchMaxPlaces = $lunchMaxPlaces;

        return $this;
    }

    public function isEveningClosed(): ?bool
    {
        return $this->eveningClosed;
    }

    public function setEveningClosed(?bool $eveningClosed): self
    {
        $this->eveningClosed = $eveningClosed;

        return $this;
    }

    public function getEveningStart(): ?\DateTimeInterface
    {
        return $this->eveningStart;
    }

    public function setEveningStart(?\DateTimeInterface $eveningStart): self
    {
        $this->eveningStart = $eveningStart;

        return $this;
    }

    public function getEveningEnd(): ?\DateTimeInterface
    {
        return $this->eveningEnd;
    }

    public function setEveningEnd(?\DateTimeInterface $eveningEnd): self
    {
        $this->eveningEnd = $eveningEnd;

        return $this;
    }

    public function getEveningMaxPlaces(): ?int
    {
        return $this->eveningMaxPlaces;
    }

    public function setEveningMaxPlaces(?int $eveningMaxPlaces): self
    {
        $this->eveningMaxPlaces = $eveningMaxPlaces;

        return $this;
    }

    public function __construct() {
        $this->day = Weekday::Monday;
    }

}
