<?php

namespace App\Dto;

use DateTime;

class CsvRow
{
    protected string $region;
    protected string $country;
    protected DateTime $datetime;
    protected int $confirmed;
    protected int $deaths;
    protected int $recovered;
    protected ?float $latitude = null;
    protected ?float $longitude = null;

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }
}
