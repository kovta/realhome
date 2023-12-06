<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateDevelopmentSiteEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const lakoTerulet = 1;
    const kereskedelmiTerulet = 2;
    const lakoKereskedelmiTerulet = 3;
    const udoloTerulet = 4;
    const ipariTerulet = 5;

}
