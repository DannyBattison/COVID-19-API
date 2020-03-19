<?php

namespace App\Hydrator;

use App\Dto\Statistic;

/**
 * @method Statistic hydrate(array $data)
 */
class StatisticHydrator extends AbstractHydrator
{
    protected static $class = Statistic::class;

    protected static $setterMap = [
        'countryName' => ['setter' => 'setCountryName'],
        'regionName' => ['setter' => 'setRegionName'],
        'latitude' => ['setter' => 'setLatitude', 'transform' => 'float'],
        'longitude' => ['setter' => 'setLongitude', 'transform' => 'float'],
        'datetime' => ['setter' => 'setDatetime', 'transform' => 'date'],
        'confirmed' => ['setter' => 'setConfirmed', 'transform' => 'int'],
        'deaths' => ['setter' => 'setDeaths', 'transform' => 'int'],
        'recovered' => ['setter' => 'setRecovered', 'transform' => 'int'],
    ];
}
