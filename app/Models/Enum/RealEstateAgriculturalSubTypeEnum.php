<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateAgriculturalSubTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const pince = 1;
    const termofold = 2;
    const szanto = 3;
    const erdo = 4;
    const tanya = 5;

}
