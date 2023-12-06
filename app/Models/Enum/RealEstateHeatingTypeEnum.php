<?php

namespace App\Models\Enum;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
use \App\Http\Traits\SelectableEnum;

final class RealEstateHeatingTypeEnum extends Enum implements LocalizedEnum
{
    use SelectableEnum;

    const gazCirko = 1;
    const gazKonvektor = 2;
    const hazKozponti = 3;
    const hazKozpontiEgyediMeressel = 4;
    const tavFutes = 5;
    const tavFutesEgyediMeressel = 6;
    const elektromos = 7;
    const fanCoil = 8;
    const vegyesTuzelesuKazan = 9;
    const egyebKazan = 10;
    const padlofutes = 11;
    const falfutes = 12;
    const mennyezetiHutesFutes = 13;
    const hooszivattyu = 14;
    const megujulo = 15;
    const egyeb = 16;
    const nincs = 17;

}
