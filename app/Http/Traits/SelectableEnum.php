<?php

namespace App\Http\Traits;


/**
 * Ha ez jellemzi az enumot, akkor az tamogatja hogy az enum ertek keszletet megjelenitse HTML select-ben,
 * figyelembe veve annak kivalasztott erteket is.
 *
 * @package App\Http\Traits
 */
trait SelectableEnum {

    /**
     * @param array|null $selectedIds
     * @return array
     */
    public static function toSelectValueSet(array $selectedIds = null){
        $enumValueSet = parent::toSelectArray();
        $items = array();
        foreach ($enumValueSet as $key => $desc) {
            $o = new GuiSelectItem($key, $desc);
            $o->gui_selected = ($selectedIds!= null && is_array($selectedIds) && in_array($key, $selectedIds)) ? 'selected' : '';
            $items[] = $o;
        }
        return $items;
    }


}
