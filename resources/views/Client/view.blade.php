@php
    use App\Models\Client
    /**
    * @var Client $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.clients_datapage_title_caption'))

@section('content')

    <div class="admin-form-wrapper">

        <div class="admin-form-title">@lang('messages.clients_datapage_title_caption')</div>
            @include('Client.datapage.view.client-view-body')
    </div>

@endsection
