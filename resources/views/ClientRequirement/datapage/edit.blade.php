@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.client_requirements_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">

        <div class="admin-form-title">{{ $client->user->name }}@lang('messages.client_requirements_datapage_title_caption')</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-toolbar">
            <a class="btn btn-secondary btn-sm" href="{{ Route('clients.edit', [$record->client->id]) }}">@lang('messages.clients_datapage_title_caption')</a>
        </div>

        <form method="POST" action="{{route('clientRequirements.update', [$record->id])}}">
            @csrf
            @method('PUT')

            <div class="row" style="margin-bottom: 20px;">
                <input type="submit" class="btn btn-primary" value="@lang('messages.button_save_caption')" />
            </div>

            @include('ClientRequirement.datapage.datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary" value="@lang('messages.button_save_caption')" />
            </div>
        </form>
    </div>

@endsection
