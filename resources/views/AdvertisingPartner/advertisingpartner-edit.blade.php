@php
    /**
    * @var \App\Models\AdvertisingPartner $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.advertisingpartners_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.advertisingpartners_datapage_title_caption')</div>

        <form method="POST" action="{{route('advertisingPartners.update', [$record->id])}}" class="col-6">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">@lang('messages.advertisingpartners_datapage_name_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{ old('name', $record->name) }}">
                    @include('inc.field-error-message', ['fieldName' => 'name'])
                </div>
            </div>

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
