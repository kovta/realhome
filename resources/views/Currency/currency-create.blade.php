@php
    /**
    * @var \App\Models\Currency $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.currencies_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.currencies_datapage_title_caption')</div>

        <form method="POST" action="{{route('currencies.store', [$record->id])}}" class="col-6">
            @csrf
            @method('POST')

            <div class="form-group row">
                <label for="iso_code" class="col-sm-2 col-form-label">@lang('messages.currencies_datapage_iso_code_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'iso_code'])" name="iso_code" value="{{ old('iso_code', $record->iso_code) }}">
                    @include('inc.field-error-message', ['fieldName' => 'iso_code'])
                </div>
            </div>

            <div class="form-group row">
                <label for="rate" class="col-sm-2 col-form-label">@lang('messages.currencies_datapage_rate_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'rate'])" name="rate" value="{{ old('rate', $record->rate) }}">
                    @include('inc.field-error-message', ['fieldName' => 'rate'])
                </div>
            </div>

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
