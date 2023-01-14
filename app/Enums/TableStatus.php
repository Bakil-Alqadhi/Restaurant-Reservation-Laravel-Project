<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;




class TableStatus extends Enum
{
    const Pending= 'pending';
    const Available = 'available';
    const Unavailable = 'unavailable';

    public static function getValues() : array
    {
        return array_values(self::toArray());
    }
}
