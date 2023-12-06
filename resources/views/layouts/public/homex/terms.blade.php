
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
                        <li class="hover_gray"><a href="#">@lang('public.homepage_label')</a></li>
                        {{--<li><i class="fas fa-angle-right" aria-hidden="true"></i></li>--}}
                        {{--<li class="hover_gray"><a href="#">Pages</a></li>--}}
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li>{{ $title }}</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">{{ $title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!--	content
=================================================================-->
<section class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="main-title-two pb_60">
                    <h3 class="title color-primary">{{ $title }}</h3>
                </div>
            </div>
        </div>
        <div class="about_company">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        {!! $content !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
