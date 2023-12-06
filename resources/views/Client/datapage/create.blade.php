@php
    /**
    * @var \App\Models\Client $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.clients_datapage_title_caption'))

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.clients_datapage_title_caption')</div>

        <form method="POST" action="{{route('clients.store', [$record->id])}}">
            @csrf
            @method('POST')

            @include('Client.datapage.client-datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>

    </div>

@endsection
