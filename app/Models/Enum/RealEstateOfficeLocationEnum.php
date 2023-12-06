<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateOfficeLocationEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const irodahazban = 1;
    const csaladihazban = 2;
    const lakasban = 3;
    const egyeb = 4;

}
