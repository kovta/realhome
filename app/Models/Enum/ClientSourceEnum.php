<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class ClientSourceEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const sajatWeb = 1;
    const kereso = 2;
    const ingatlanCom = 3;
    const attelepitesiCeg = 4;
    const regiUgyfel = 5;
    const egyeb = 6;

}
