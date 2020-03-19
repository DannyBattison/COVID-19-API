<?php

namespace App\Hydrator;

use App\Dto\CsvRow;

/**
 * @method CsvRow hydrate(array $data)
 */
class CsvRowHydrator extends AbstractHydrator
{
    protected static $class = CsvRow::class;

    protected static $setterMap = [
        'Province/State' => ['setter' => 'setRegion'],
        'Country/Region' => ['setter' => 'setCountry'],
        'Last Update' => ['setter' => 'setDatetime', 'transform' => 'date'],
        'Confirmed' => ['setter' => 'setConfirmed', 'transform' => 'int'],
        'Deaths' => ['setter' => 'setDeaths', 'transform' => 'int'],
        'Recovered' => ['setter' => 'setRecovered', 'transform' => 'int'],
        'Latitude' => ['setter' => 'setLatitude', 'transform' => 'float'],
        'Longitude' => ['setter' => 'setLongitude', 'transform' => 'float'],
    ];
}
