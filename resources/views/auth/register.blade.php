
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
                        <li><a href="{{ route('login') }}" class="color-primary">@lang('public.mainmenu_login_label')</a></li>
                        <li class="active"><a href="{{ route('register') }}" class="color-primary">@lang('public.mainmenu_register_label')</a></li>
                    </ul>
                    <form class="form9" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="g_recaptcha_response" id="g_recaptcha_response" value=""/>
                        @if ($errors->has('g_recaptcha_response'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('g_recaptcha_response') }}</strong>
                                </span>
                        @endif
                        <div class="form-group user">
                            <label for="name">@lang('public.register_name_label')</label>
                            <input id="name" type="text" class="form-control bg-gray {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('public.register_email_label')</label>
                            <input id="email" type="email" class="form-control bg-gray {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>


                        {{-- sajat mezok ------------------------------------------------------------------------------- --}}

                        <div class="form-group">
                            <label for="phone_1">@lang('public.register_contact_phone_label')</label>
                            <input id="phone_1" type="text" class="form-control bg-gray {{ $errors->has('phone_1') ? ' is-invalid' : '' }}" name="phone_1" value="{{ old('phone_1') }}" required>
                            @if ($errors->has('phone_1'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_1') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="preferred_contact">@lang('public.register_preferred_contact_label')</label>
                            @foreach(\App\Models\Enum\ClientPreferredContactEnum::asArray() as $contactType)
                                <div class="form-check">
                                    <input class="form-check-input" style="display: inline !important;" type="radio" name="preferred_contact" value="{{$contactType}}" {{ (old('preferred_contect') == $contactType) ? 'checked' : '' }} required>
                                    <label class="form-check-label">
                                        {{ \App\Models\Enum\ClientPreferredContactEnum::getDescription($contactType) }}
                                    </label>
                                </div>
                            @endforeach
                            @if ($errors->has('preferred_contact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('preferred_contact') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{-- sajat mezok ------------------------------------------------------------------------------- --}}


                        <div class="form-group password">
                            <label for="password">@lang('public.register_password_label')</label>
                            <input id="password" type="password" class="form-control bg-gray {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">@lang('public.register_password_confirm_label')</label>
                            <input id="password-confirm" type="password" class="form-control bg-gray" name="password_confirmation" required>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input {{ $errors->has('acceptTerms') ? ' is-invalid' : '' }}" name="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">
                                <a href="{{ route('feltetelek') }}">@lang('public.register_accept_terms_label')</a></label>
                            @if ($errors->has('acceptTerms'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('acceptTerms') }}</strong>
                                </span>
                            @endif
                        </div>


                        <button type="submit" class="btn btn-default1 mt_15">@lang('public.register_submit_button_caption')</button>
                        <a class="color-primary d-block mt_30" href="{{ route('feltetelek') }}">@lang('public.register_view_terms_label')</a>
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
