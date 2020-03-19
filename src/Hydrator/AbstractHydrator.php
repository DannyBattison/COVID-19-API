<?php

namespace App\Hydrator;

use DateTime;

abstract class AbstractHydrator
{
    protected static $class;
    protected static $setterMap = [];

    public function hydrate(array $data): object
    {
        $row = new static::$class();

        foreach ($data as $key => $value) {
            if (isset(static::$setterMap[$key])) {
                if (isset(static::$setterMap[$key]['transform'])) {
                    switch(static::$setterMap[$key]['transform']) {
                        case 'date':
                            $value = (new DateTime())->setTimestamp(strtotime($value));
                            break;
                        case 'int':
                            $value = (int) $value;
                            break;
                        case 'float':
                            $value = (float) $value;
                            break;
                        default:
                            $value = trim($value);
                    }
                }
                $row->{static::$setterMap[$key]['setter']}($value);
            }
        }

        return $row;
    }
}
