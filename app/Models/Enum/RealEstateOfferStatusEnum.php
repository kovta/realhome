<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateOfferStatusEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const vazlat = 1;
    const mentett = 2;
    const kikuldve = 3;

}
