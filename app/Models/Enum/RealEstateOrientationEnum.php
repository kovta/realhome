<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateOrientationEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const eszaki = 1;
    const deli = 2;
    const keleti = 3;
    const nyugati = 4;

    const eszakKeleti = 5;
    const delKeleti = 6;
    const eszakNyugati = 7;
    const delNyugati = 8;

}
