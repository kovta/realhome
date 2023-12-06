@php
    /**
    * @var \App\Models\LocationTownDistrict $record
    * @var \App\Models\LocationArea[] $areas
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.locationtowndistricts_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.locationtowndistricts_datapage_title_caption')</div>

        <form method="POST" action="{{route('locationTownDistricts.update', [$record->id])}}" class="col-6">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">@lang('messages.locationtowndistricts_datapage_name_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{ old('name', $record->name) }}">
                    @include('inc.field-error-message', ['fieldName' => 'name'])
                </div>
            </div>

            <div class="form-group row">
                <label for="location_area_id" class="col-sm-2 col-form-label">@lang('messages.locationtowndistricts_datapage_area_label')</label>
                <div class="col-sm-10">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'location_area_id'])" name="location_area_id">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($areas as $item)
                            <option value="{{$item->id}}" @if (old('location_area_id', $record->location_area_id) == $item->id) selected @endif>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'location_area_id'])
                </div>
            </div>

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
