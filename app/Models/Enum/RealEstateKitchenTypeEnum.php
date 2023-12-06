<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateKitchenTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const openPlan = 1;
    const openPlanDiningRoom = 2;
    const openPlanDiningArea = 3;
    const openPlanCanBeSepareted = 4;
    const separeted = 5;
    const separetedDiningRoom = 6;
    const separetedDiningArea = 7;
    const teaKitchen = 8;
    const eatInKitchen = 9;

}
