<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $weekday = [
        "Monday" => "Lundi",
        "Tuesday" => "Mardi",
        "Wednesday" => "Mercredi",
        "Thursday" => "Jeudi",
        "Friday" => "Vendredi",
        "Saturday" => "Samedi",
        "Sunday" => "Dimanche",
    ];

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $serviceStart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $serviceEnd = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $service = [];

    #[ORM\Column]
    private ?bool $isClosed = null;

    #[ORM\Column]
    private ?int $maxNbPlaces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekday(): array
    {
        return $this->weekday;
    }

    public function setWeekday(array $weekday): self
    {
        $this->weekday = $weekday;

        return $this;
    }

    public function getServiceStart(): ?\DateTimeInterface
    {
        return $this->serviceStart;
    }

    public function setServiceStart(\DateTimeInterface $serviceStart): self
    {
        $this->serviceStart = $serviceStart;

        return $this;
    }

    public function getServiceEnd(): ?\DateTimeInterface
    {
        return $this->serviceEnd;
    }

    public function setServiceEnd(\DateTimeInterface $serviceEnd): self
    {
        $this->serviceEnd = $serviceEnd;

        return $this;
    }

    public function getService(): array
    {
        return $this->service;
    }

    public function setService(array $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function isIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): self
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    public function getMaxNbPlaces(): ?int
    {
        return $this->maxNbPlaces;
    }

    public function setMaxNbPlaces(int $maxNbPlaces): self
    {
        $this->maxNbPlaces = $maxNbPlaces;

        return $this;
    }

    public function __toString() {
        return $this->getWeekday();
    }
}
