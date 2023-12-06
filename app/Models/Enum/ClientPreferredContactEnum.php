<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class ClientPreferredContactEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    public const email = 1;
    public const telefon = 2;

}
