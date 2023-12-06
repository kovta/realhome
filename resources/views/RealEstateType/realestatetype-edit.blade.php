@php
    /**
    * @var \App\Models\RealEstateType $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.real_estate_types_datapage_title_caption'))

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.real_estate_types_datapage_title_caption'){{--@include('inc.localeSwitch')--}}</div>

        <form method="POST" action="{{route('realEstateTypes.update', [$record->id])}}" class="col-6">
            @csrf
            @method('PUT')

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />

            @foreach(config('translatable.locales') as $locale)
                <div class="form-group row translatable" data-locale="{{$locale}}">
                    <label for="{{$locale}}_name" class="col-sm-2 col-form-label">@lang('messages.real_estate_types_datapage_name_label')</label>
                    <div class="input-group col-sm-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{$locale}}</span>
                        </div>
                        <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => $locale.'.name'])" name="{{$locale}}[name]"
                               value="{{ old($locale.'.name', $record->{'name:'.$locale}) }}">
                        @include('inc.field-error-message', ['fieldName' => $locale.'.name'])
                    </div>
                </div>
            @endforeach

            <div class="form-group row">
                <label for="real_estate_category_id" class="col-sm-2 col-form-label">@lang('messages.real_estate_types_datapage_category_label')</label>
                <div class="col-sm-10">
                    <select class="form-control @if ($errors->has('real_estate_category_id')) is-invalid @endif" name="real_estate_category_id" value="{{$record->real_estate_category_id}}">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}" @if (old('real_estate_category_id', $record->real_estate_category_id) == $item->id) selected @endif>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">@if ($errors->has('real_estate_category_id')){{ $errors->first('real_estate_category_id') }}@endif</div>
                </div>
            </div>

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
