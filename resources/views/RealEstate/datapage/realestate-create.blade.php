@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.real_estates_datapage_title_caption'))

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.real_estates_datapage_title_caption'){{--@include('inc.localeSwitch')--}}</div>

        @include('RealEstate.datapage.realestate-datapage-toolbar')

        <form method="POST" action="{{route('realEstates.store', [$record->id])}}">
            @csrf
            @method('POST')

            <div class="row" style="margin-bottom: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>

            @include('RealEstate.datapage.realestate-datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>
    </div>

@endsection
