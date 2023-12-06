@php
    use App\Models\Partner;
    /**
    * @var Partner[] $partners
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.partners_partner_panel_title'))

@section('content')

    <div class="admin-form-wrapper">

        <div class="admin-form-title">@lang('messages.partners_partner_panel_title')</div>
            @include('Partner.datapage.list')
    </div>

@endsection
