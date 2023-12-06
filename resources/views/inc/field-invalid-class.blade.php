@php
    /**
    * @var \Illuminate\Support\MessageBag $errors
    * @var string $fieldName
    */
@endphp
@if ($errors->has($fieldName)) is-invalid @endif
