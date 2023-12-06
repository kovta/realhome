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
                            <li class="color-default">E-mail ellenőrzés</li>
                        </ul>
                    </div>
                    <div class="float-right color-primary">
                        <h3 class="banner-title font-weight-bold">E-mail ellenőrzés</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--	Contact text section by Vili
    =================================================================-->
    <section class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="main-title-two pb_60">
                        <h3 class="title color-primary">{{ __('E-mail ellenőrzés') }}</h3>
                    </div>
                </div>
            </div>
            <div class="about_company">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="content">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Az új visszaigazoló linket kiküldtük az e-mail címre.') }}
                                </div>
                            @endif

                            {{ __('A kívánt oldal eléréséhez igazolnod kell, hogy tied a felhasználóhoz tartozó e-mail cím. Ezt egy levélben kapott linkkel teheted meg.') }}
                            {{ __('Ha nem kaptál visszaigazoló e-mailt') }}, <a href="{{ route('verification.resend') }}">{{ __('kattints ide hogy kérj egy új visszaigazoló linket') }}</a>.
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
