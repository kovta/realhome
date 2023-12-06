<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateVistaEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const utcara = 1;
    const udvarra = 2;
    const zoldre = 3;
    const parkra = 4;
    const panoramas = 5;

}
