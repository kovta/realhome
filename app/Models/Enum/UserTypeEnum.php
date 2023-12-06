<?php

namespace App\Models\Enum;

use App\Http\Traits\SelectableEnum;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * Class UserTypeEnum
 * @package App\Models\Enum
 */
final class UserTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const adminuser = 1;
    const ugyfel = 2;
}
