<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("statistic")
 */
class Statistic
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected int $id;

    /** @ORM\Column(type="datetime") */
    protected DateTime $datetime;

    /** @ORM\Column(type="integer") */
    protected int $confirmed;

    /** @ORM\Column(type="integer") */
    protected int $deaths;

    /** @ORM\Column(type="integer") */
    protected int $recovered;

    /** @ORM\ManyToOne(targetEntity="Region", inversedBy="statistics") */
    protected Region $region;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

    public function getConfirmed(): int
    {
        return $this->confirmed;
    }

    public function setConfirmed(int $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    public function getDeaths(): int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): void
    {
        $this->deaths = $deaths;
    }

    public function getRecovered(): int
    {
        return $this->recovered;
    }

    public function setRecovered(int $recovered): void
    {
        $this->recovered = $recovered;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function setRegion(Region $region): void
    {
        $this->region = $region;
    }
}
