<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateRetailUnitLocationEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const utcaiBejarat = 1;
    const udvariBejarat = 2;
    const uzletkozpontban = 3;
    const egyeb = 4;

}
