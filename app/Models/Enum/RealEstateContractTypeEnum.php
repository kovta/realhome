<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateContractTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const elado = 1;
    const kiado = 2;

}
