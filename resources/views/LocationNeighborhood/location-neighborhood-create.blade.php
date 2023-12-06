@php
    /**
    * @var \App\Models\LocationNeighborhood $record
    * @var \App\Models\LocationTownDistrict[] $districts
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.locationneighborhoods_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.locationneighborhoods_datapage_title_caption')</div>

        <form method="POST" action="{{route('locationNeighborhoods.store', [$record->id])}}" class="col-6">
            @csrf
            @method('POST')

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">@lang('messages.locationneighborhoods_datapage_name_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{ old('name', $record->name) }}">
                    @include('inc.field-error-message', ['fieldName' => 'name'])
                </div>
            </div>

            <div class="form-group row">
                <label for="location_town_district_id" class="col-sm-2 col-form-label">@lang('messages.locationneighborhoods_datapage_district_label')</label>
                <div class="col-sm-10">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'location_town_district_id'])" name="location_town_district_id">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($districts as $item)
                            <option value="{{$item->id}}" @if (old('location_town_district_id', $record->location_town_district_id) == $item->id) selected @endif>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'location_town_district_id'])
                </div>
            </div>

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
