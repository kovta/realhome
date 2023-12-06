<?php

namespace App\Helpers;

use function GuzzleHttp\Psr7\str;

class Helper
{

    /**
     * Blade helper: milliós értékeknél "M"-et írjon ki
     * használata blade template-ben: {!! Helper::to_million_string('this is how to use autoloading correctly!!') !!}
     * @param int
     * @return string|int
    */
    public static function to_million_string(int $number)
    {
        if($number >= 1000000)
        {
            return  number_format(($number/1000000), 1, '.', ' ') . 'M';
        }
        return $number;
    }

    /**
     * @param int $number
     * @return int Formatted integer
     */
    public static function add_space_to_price(int $number)
    {
        return number_format($number, 0, '', ' ');
    }
}
