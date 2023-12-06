<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateFurnitureEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const butorozott = 1;
    const butorozatlan = 2;
    const reszbenButorozott = 4;
    const keresreMegoldhato = 3;

}
