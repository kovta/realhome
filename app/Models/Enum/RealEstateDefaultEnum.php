<?php


namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

class RealEstateDefaultEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const nem = 0;
    const igen = 1;
}