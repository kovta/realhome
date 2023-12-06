<?php

namespace App\Http\Traits;


/**
 * Ha ez jellemzi az entitast, akkor az tamogatja hogy az enum ertek keszletet megjelenitse HTML select-ben,
 * figyelembe veve annak kivalasztott erteket is.
 *
 * @package App\Http\Traits
 */
trait SelectableEntity {

    /**
     * @param $valueSet
     * @param null $selectedId
     * @param string $idField
     * @param string $captionField
     * @return array
     */
    public static function toSelectValueSet($valueSet, $selectedId = null, $idField = 'id', $captionField = 'name'){

        $items = array();
        foreach ($valueSet as $key => $object) {
            $o = new GuiSelectItem($object->$idField, $object->$captionField);
            $o->gui_selected = ($object->$idField == $selectedId) ? 'selected' : '';
            $items[] = $o;
        }
        return $items;
    }


}
