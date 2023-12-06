<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateCategoryEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const lakoIngatlan = 1;
    const kereskedelmiIngatlan = 2;

}
