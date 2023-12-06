
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
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">{{ $title }}</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">{{ $title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="full-row">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-5">
                <div class="login_form">
                    <ul class="d-inline-block mb_30">
                        <li class="active"><a href="{{ route('login') }}" class="color-primary">@lang('public.mainmenu_login_label')</a></li>
                        <li><a href="{{ route('register') }}" class="color-primary">@lang('public.mainmenu_register_label')</a></li>
                    </ul>
                    <form class="form9" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group user">
                            <label for="emai1">@lang('public.login_name_label')</label>
                            <input id="email" type="email" placeholder="@lang('public.login_name_placeholder')" class="form-control bg-gray {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group password">
                            <label for="password">@lang('public.login_password_label')</label>
                            <input id="password" type="password" placeholder="@lang('public.login_password_placeholder')" class="form-control bg-gray {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">@lang('public.login_remember_me_label')</label>
                        </div>
                        <button type="submit" class="btn btn-default1 mt_15">@lang('public.login_submit_button_caption')</button>
                        @if (Route::has('password.request'))
                            <a  class="color-primary d-block mt_30" href="{{ route('password.request') }}">@lang('public.login_forgot_password_label')</a>
                        @endif

{{--                        <div class="from_socalmedia d-block mt_60">--}}
{{--                            <button class="btn facebook w-100">Login With Facebook</button>--}}
{{--                            <button class="btn twiter w-100">Login With Twitter</button>--}}
{{--                            <button class="btn googleplus w-100">Login With Google Plus</button>--}}
{{--                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
