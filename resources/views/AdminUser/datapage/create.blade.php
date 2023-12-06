@php
    /**
    * @var \App\Models\Client $record
    * @var \App\User $record->user
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.adminusers_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title"><i class="fas fa-user"></i> @lang('messages.adminusers_datapage_title_caption')</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('adminusers.store', [$record->id])}}" class="col-6">
            @csrf
            @method('POST')

            @include('AdminUser.datapage.datapage-body')


            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
