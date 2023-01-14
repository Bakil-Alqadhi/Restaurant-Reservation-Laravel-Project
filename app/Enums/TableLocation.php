<?php
namespace App\Enums;

use MyCLabs\Enum\Enum;

class TableLocation extends Enum
{
    const Front= 'front';
    const Inside = 'inside';
    const Outside = 'outside';

    public static function getValues() : array
    {
        return array_values(self::toArray());
    }
}