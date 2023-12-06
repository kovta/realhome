<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class ClientRequirementStatusEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const aktualis = 1;
    const nemAktualis = 2;

}
