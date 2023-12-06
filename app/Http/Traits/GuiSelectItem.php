<?php

namespace App\Http\Traits;


/**
 * Class GuiSelectItem
 * A HTML select egy OPTION tagját reprezentálja.
 * @package App\Http\Traits
 */
class GuiSelectItem
{
    public $id;
    public $caption;
    public $gui_selected;

    /**
     * GuiSelectItem constructor.
     * @param null $id
     * @param null $caption
     */
    public function __construct($id = null, $caption = null)
    {
        if ($id != null){
            $this->id = $id;
        }
        if ($caption != null){
            $this->caption = $caption;
        }
        $this->gui_selected = '';
    }

}
