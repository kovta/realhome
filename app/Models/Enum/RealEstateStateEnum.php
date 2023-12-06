<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateStateEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const ujepitesu = 1;
    const ujszeru = 2;
    const felujitott = 3;
    const joAllapotu = 4;
    const felujitando = 5;

}
