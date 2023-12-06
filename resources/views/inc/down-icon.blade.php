@php
    /**
    * @var \Illuminate\Routing\Route $deleteRoute
    */
@endphp
<form style="display: inline; margin: 0; padding: 5px;" action="{{ $downRoute }}" method="POST">
    @method('PUT')
    @csrf
    <button class="btn btn-link" type="submit" title="down" style="margin:2px; padding:0;"><i class="fas fa-arrow-down"></i></button>
</form>
