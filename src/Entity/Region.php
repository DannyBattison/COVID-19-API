<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("region")
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected int $id;

    /** @ORM\ManyToOne(targetEntity="Country", inversedBy="regions") */
    protected Country $country;

    /** @ORM\Column(type="string") */
    protected string $name;

    /** @ORM\Column(type="integer") */
    protected float $latitude;

    /** @ORM\Column(type="integer") */
    protected float $longitude;

    /** @ORM\OneToMany(targetEntity="Statistic", mappedBy="region") */
    protected array $statistics;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getStatistics(): array
    {
        return $this->statistics;
    }

    public function setStatistics(array $statistics): void
    {
        $this->statistics = $statistics;
    }
}
