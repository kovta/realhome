@php
    /**
    * @var \App\Models\Post $record
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.post_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="row">
            <div class="admin-form-title"><i class="fas fa-edit"></i> @lang('messages.post_datapage_title_caption')</div>
        </div>
        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{route('posts.store', [$record->id])}}">
                    @csrf
                    @method('POST')

                    @include('Post.datapage-body')

                    <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
                </form>
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>

@endsection
