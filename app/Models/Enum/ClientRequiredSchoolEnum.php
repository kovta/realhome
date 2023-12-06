<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class ClientRequiredSchoolEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const ovoda = 1;
    const amerikai = 2;
    const brit = 3;
    const francia = 4;
    const nemet = 5;
    const osztrak = 6;

}
