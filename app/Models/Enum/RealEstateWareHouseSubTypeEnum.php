<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateWareHouseSubTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const logisztikaiPark = 1;
    const raktarbazis = 2;
    const raktarhelyiseg = 3;

}
