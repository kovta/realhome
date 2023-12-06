@php
    /**
    * @var \App\Models\TextContentPage $record
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.text_content_pages_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title"><i class="fas fa-folder-open"></i> @lang('messages.text_content_pages_datapage_title_caption')</div>

        <form method="POST" action="{{route('textContentPages.store', [$record->id])}}">
            @csrf
            @method('POST')

            @include('TextContentPage.datapage-body')

            <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
        </form>
    </div>

@endsection
