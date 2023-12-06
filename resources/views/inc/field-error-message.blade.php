@php
    /**
    * @var \Illuminate\Support\MessageBag $errors
    * @var string $fieldName
    */
@endphp
<div class="invalid-feedback" style="@if ($errors->has($fieldName)){{ 'display: inline;' }}@endif">@if ($errors->has($fieldName)){{ $errors->first($fieldName) }}@endif</div>
