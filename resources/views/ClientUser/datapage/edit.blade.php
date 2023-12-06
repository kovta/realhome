@php
    /**
    * @var \App\Models\Client $record
    * @var \App\User $record->user
    */

    $title = __('messages.clientusers_datapage_title_caption');
@endphp


@extends('layouts.admin.defaultpage')

@section('title', $title)

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title"><i class="fas fa-user"></i> {{ $title }}</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('clientusers.update', [$record->id])}}" class="col-6">
            @csrf
            @method('PUT')

            @include('ClientUser.datapage.datapage-body')

            <input type="submit" class="btn btn-primary" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
