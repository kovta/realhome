<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class LanguageEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const angol = 1;
    const magyar = 2;

}
