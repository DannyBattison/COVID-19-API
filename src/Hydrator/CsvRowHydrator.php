<?php

namespace App\Hydrator;

use App\Dto\CsvRow;
use DateTime;

class CsvRowHydrator
{
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

    public function hydrate(array $data): CsvRow
    {
        $row = new CsvRow();

        foreach ($data as $key => $value) {
            if (isset(self::$setterMap[$key])) {
                if (isset(self::$setterMap[$key]['transform'])) {
                    switch(self::$setterMap[$key]['transform']) {
                        case 'date':
                            $value = (new DateTime())->setTimestamp(strtotime($value));
                            break;
                        case 'int':
                            $value = (int) $value;
                            break;
                        case 'float':
                            $value = (float) $value;
                            break;
                    }
                }
                $row->{self::$setterMap[$key]['setter']}($value);
            }
        }

        return $row;
    }
}
