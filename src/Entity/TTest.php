<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TTestRepository;

#[ORM\Entity(repositoryClass: TTestRepository::class)]
class TTest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", enumType: Weekday::class)]
    private Weekday $day;

    /**
     * @return Weekday
     */
    public function getDay(): Weekday
    {
        return $this->day;
    }

    /**
     * @param Weekday $day
     */
    public function setDay(Weekday $day): void
    {
        $this->day = $day;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     */
    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $name = null;

    public function __construct() {
        $this->day = Weekday::Monday;
    }
}