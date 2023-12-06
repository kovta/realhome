<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateIndustrialSubTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const telephely = 1;
    const muhely = 2;
    const egyeb = 3;

}
