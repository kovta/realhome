@php
    /**
    * @var \Illuminate\Routing\Route $deleteRoute
    */
@endphp
<form style="display: inline; margin: 0; padding: 5px;" action="{{ $deleteRoute }}" method="POST" onsubmit="return confirm('@lang('messages.crud_delete_confirm_text')');">
    @method('DELETE')
    @csrf
    <button class="btn btn-link" type="submit" title="@lang('messages.crud_delete_item_button_tooltip')"><i class="fas fa-trash"></i></button>
</form>
