<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateWebStatusEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const aktiv = 1;
    const inaktiv = 2;
    const kiemelt = 3;

}
