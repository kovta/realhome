<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateCateringSubTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const etterem = 1;
    const hotel = 2;
    const panzio = 3;
    const egyeb = 4;

}
