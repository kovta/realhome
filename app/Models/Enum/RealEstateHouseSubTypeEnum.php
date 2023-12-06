<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateHouseSubTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const csaladiHaz = 1;
    const ikerHaz = 2;
    const sorHaz = 3;
    const villa = 4;

}
