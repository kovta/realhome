@php
    /**
    * @var \App\Models\Post $record
    */
@endphp

{{--@include('inc.localeSwitch')--}}

@foreach(config('translatable.locales') as $locale)

<div class="form-group row translatable" data-locale="{{$locale}}">
    <label for="{{$locale}}_title" class="col-lg-12 col-form-label">@lang('messages.post_datapage_title_label')</label>
    <div class="input-group col-12">
        <div class="input-group-prepend">
            <span class="input-group-text">{{$locale}}</span>
        </div>
        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => $locale.'.title'])" name="{{$locale}}[title]"
               value="{{ old($locale.'.title', $record->{'title:'.$locale}) }}">
        @include('inc.field-error-message', ['fieldName' => $locale.'.title'])
    </div>
</div>

<div class="form-group row translatable" data-locale="{{$locale}}">
    <label for="{{$locale}}_lead" class="col-lg-12 col-form-label">@lang('messages.post_datapage_lead_label')</label>
    <div class="input-group col-12">
        <div class="input-group-prepend">
            <span class="input-group-text">{{$locale}}</span>
        </div>
        <textarea class="form-control wysiwyg @include('inc.field-invalid-class', ['fieldName' => $locale.'.lead'])" name="{{$locale}}[lead]">{{ old($locale.'.lead', $record->{'lead:'.$locale}) }}</textarea>
        @include('inc.field-error-message', ['fieldName' => $locale.'.lead'])
    </div>
</div>

<div class="form-group row translatable" data-locale="{{$locale}}">
    <label for="{{$locale}}_description" class="col-lg-12 col-form-label">@lang('messages.post_datapage_description_label')</label>
    <div class="input-group col-12">
        <div class="input-group-prepend">
            <span class="input-group-text">{{$locale}}</span>
        </div>
        <textarea class="form-control wysiwyg @include('inc.field-invalid-class', ['fieldName' => $locale.'.description'])" name="{{$locale}}[description]">{{ old($locale.'.description', $record->{'description:'.$locale}) }}</textarea>
        @include('inc.field-error-message', ['fieldName' => $locale.'.description'])
    </div>
</div>
@endforeach
