<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("country")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected int $id;

    /** @ORM\Column(type="string") */
    protected string $name;

    /**
     * @var Region[]
     * @ORM\OneToMany(targetEntity="Region", mappedBy="country")
     */
    protected array $regions;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRegions(): array
    {
        return $this->regions;
    }

    public function setRegions(array $regions): void
    {
        $this->regions = $regions;
    }
}
