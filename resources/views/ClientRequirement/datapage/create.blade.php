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

        <div class="admin-form-title">{{ $client->name }}@lang('messages.client_requirements_datapage_title_caption')</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('clientRequirements.store', [$record->id])}}">
            @csrf
            @method('POST')

            @include('ClientRequirement.datapage.datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary" value="@lang('messages.button_save_caption')" />
            </div>
        </form>
    </div>

@endsection
