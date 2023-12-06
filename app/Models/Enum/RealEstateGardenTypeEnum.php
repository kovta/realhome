<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateGardenTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const nincs = 1;
    const privat = 2;
    const kozos = 3;
    const parkositott = 4;
    const tetokert = 5;

}
