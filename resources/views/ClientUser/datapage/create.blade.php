@php
    /**
    * @var \App\Models\Client $record
    * @var \App\User $record->user
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.clientusers_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title"><i class="fas fa-user"></i> @lang('messages.clientusers_datapage_title_caption')</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('clientusers.store', [$record->id])}}" class="col-6">
            @csrf
            @method('POST')

            @include('ClientUser.datapage.datapage-body')

            <input type="submit" class="btn btn-primary" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
