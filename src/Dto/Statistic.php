<?php

namespace App\Dto;

use DateTime;
use JsonSerializable;

class Statistic implements JsonSerializable
{
    protected ?string $countryName;
    protected ?string $regionName;
    protected ?float $latitude;
    protected ?float $longitude;
    protected DateTime $datetime;
    protected int $confirmed;
    protected int $deaths;
    protected int $recovered;

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): void
    {
        $this->countryName = $countryName;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function setRegionName(string $regionName): void
    {
        $this->regionName = $regionName;
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

    public function jsonSerialize()
    {
        return [
            'countryName' => $this->getCountryName(),
            'regionName' => $this->getRegionName(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'datetime' => $this->getDatetime(),
            'confirmed' => $this->getConfirmed(),
            'deaths' => $this->getDeaths(),
            'recovered' => $this->getRecovered(),
        ];
    }
}
