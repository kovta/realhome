@php
    /**
    * @var \App\Models\Client $record
    */
@endphp

@extends('layouts.public.homex.base')

@section('htmlheader')
@endsection


@section('descendant-site')

@include('layouts.public.homex.header-four')

<!--	Banner
===============================================================-->
<div class="page-banner bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumbs color-secondery">
                    <ul>
                        <li class="hover_gray"><a href="#">Home</a></li>
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">@lang('public.myprofile_datapage_title_caption')</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">@lang('public.myprofile_datapage_title_caption')</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="full-row">
    <div class="container">

        <form action="{{ route('updateClientProfile', [Auth::user()->client->id]) }}" method="post">
            @csrf

            <div class="main-title-two pb_60">
                <h3 class="title color-primary">@lang('public.myprofile_datapage_title_caption')</h3>
            </div>

            {{--<h5 class="color-primary">@lang('public.myprofile_datapage_title_caption')</h5>--}}
            {{--<hr>--}}
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>@lang('public.myprofile_datapage_name_label')</label>
                        <input type="text" name="user_name" class="form-control" value="{{ $record->user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>@lang('public.myprofile_datapage_email_label')</label>
                        <input type="text" name="email" class="form-control" value="{{ $record->user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>@lang('public.myprofile_datapage_phone-1_label')</label>
                        <input type="text" name="phone_1" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'phone_1'])"
                               value="{{ old('', $record->phone_1) }}" placeholder="@lang('public.myprofile_datapage_phone-1_placeholder')">
                        @include('inc.field-error-message', ['fieldName' => 'phone_1'])
                    </div>
                    <div class="form-group">
                        <label>@lang('public.myprofile_datapage_phone-2_label')</label>
                        <input type="text" name="phone_2" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'phone_2'])"
                               value="{{ old('phone_2', $record->phone_2) }}" placeholder="@lang('public.myprofile_datapage_phone-2_placeholder')">
                        @include('inc.field-error-message', ['fieldName' => 'phone_2'])
                    </div>
                    <button class="btn btn-default1 mb-3">@lang('public.button_save_caption')</button>
                </div>
            </div>
        </form>

    </div>
</section>



@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
