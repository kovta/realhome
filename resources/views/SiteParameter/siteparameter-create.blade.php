@php
    /**
    * @var \App\Models\SiteParameter $record
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.siteparameters_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.siteparameters_datapage_title_caption')</div>

        <form method="POST" action="{{route('siteParameters.store', [$record->id])}}" class="col-xl-6 col-lg-12">
            @csrf
            @method('POST')

            @include('SiteParameter.datapage-body')

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
