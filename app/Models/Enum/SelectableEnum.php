<?php

namespace App\Models\Enum;

interface SelectableEnum
{
    public static function toSelectValueSet($selectedId);
}
