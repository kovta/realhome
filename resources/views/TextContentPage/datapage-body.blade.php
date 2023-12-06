@php
    /**
    * @var \App\Models\TextContentPage $record
    */
@endphp

<div class="form-group row">
    <label for="inner_name" class="col-lg-12 col-form-label">@lang('messages.text_content_pages_datapage_name_label')</label>
    <div class="col-xl-8 col-lg-12">
        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'inner_name'])" name="inner_name" value="{{ old('inner_name', $record->inner_name) }}">
        @include('inc.field-error-message', ['fieldName' => 'inner_name'])
    </div>
</div>

<br>
{{--@include('inc.localeSwitch')--}}
@foreach(config('translatable.locales') as $locale)

<div class="form-group row translatable" data-locale="{{$locale}}">
    <label for="{{$locale}}_title" class="col-lg-12 col-form-label">@lang('messages.text_content_pages_datapage_title_label')</label>
    <div class="input-group col-xl-8 col-lg-12">
        <div class="input-group-prepend">
            <span class="input-group-text">{{$locale}}</span>
        </div>
        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => $locale.'.title'])" name="{{$locale}}[title]"
               value="{{ old($locale.'.title', $record->{'title:'.$locale}) }}">
        @include('inc.field-error-message', ['fieldName' => $locale.'.title'])
    </div>
</div>

<div class="form-group row translatable" data-locale="{{$locale}}">
    <label for="{{$locale}}_content" class="col-lg-12 col-form-label">@lang('messages.text_content_pages_datapage_content_label')</label>
    <div class="input-group col-lg-12">
        <div class="input-group-prepend">
            <span class="input-group-text">{{$locale}}</span>
        </div>
        <textarea class="form-control wysiwyg @include('inc.field-invalid-class', ['fieldName' => $locale.'.content'])" name="{{$locale}}[content]">{{ old($locale.'.content', $record->{'content:'.$locale}) }}</textarea>
        @include('inc.field-error-message', ['fieldName' => $locale.'.content'])
    </div>
</div>
@endforeach
