
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
<!--	About Our Company
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
                <div class="col-md-12 col-lg-7">
                    <div class="content">
                        {!! $content !!}
                    </div>
{{--

                    <div class="fact-counter mt_30">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms">
                                    <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="1310">0</h2><span>+</span>
                                    </div>
                                    <div class="color-secondery">Deals Success</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms">
                                    <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="946">0</h2><span>+</span>
                                    </div>
                                    <div class="color-secondery">Insurance Done</div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms">
                                    <div class="counting_digit color-default pb_5 mt_15 mb-0"><strong>$</strong><h2 class="count-num" data-speed="3000" data-stop="751867">0</h2><span>+</span>
                                    </div>
                                    <div class="color-secondery">Micro Finincing</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="about_img">
                        <img src="{{ asset('vendor/homex/images/about/01.png') }}" alt="">
                    </div>
                </div>
--}}
            </div>
        </div>
    </div>
    </div>
</section>

<!--	Get In Touch
===============================================================-->
<section class="full-row pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="main-title-one">
                    <h2 class="title color-primary">@lang('public.contact_page_title')</h2>
                    <p class="sub-title color-secondery py_60">@lang('public.contact_page_subtitle')</p>
                </div>
            </div>

            <div class="col-md-12">
                {{--  Nehany dolog ki lett kommentezve a formnal es a submitnal, mert kulonben a tema sajat ajaxos submitja fut (custom.js) --}}
                <form {{--id="contact-form"--}} class="w-100" action="{{ route('kapcsolatfelveteliKeres') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <input type="text" id="nev" name="nev" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'nev'])"
                                       placeholder="@lang('public.contact_name')*" required>
                                @include('inc.field-error-message', ['fieldName' => 'nev'])
                            </div>
                            <div class="form-group">
                                <input type="text" id="email" name="email" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'email'])"
                                       placeholder="@lang('public.contact_email')*" required>
                                @include('inc.field-error-message', ['fieldName' => 'email'])
                            </div>
                            <div class="form-group">
                                <input type="text" id="telefon" name="telefon"  class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'telefon'])"
                                       placeholder="@lang('public.contact_phone')">
                                @include('inc.field-error-message', ['fieldName' => 'telefon'])
                            </div>
                            <div class="form-group">
                                <input type="text" id="targy" name="targy" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'targy'])"
                                       placeholder="@lang('public.contact_object')*" required>
                                @include('inc.field-error-message', ['fieldName' => 'targy'])
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <textarea id="uzenet" name="uzenet" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'uzenet'])"
                                          rows="7" placeholder="@lang('public.contact_message')"></textarea>
                                @include('inc.field-error-message', ['fieldName' => 'uzenet'])
                            </div>
                            <button type="submit" {{--id="send" value="send message"--}} class="btn btn-default1">@lang('public.contact_send_button')</button>
                        </div>
{{--
                        <div class="col-md-12">
                            <div class="error-handel">
                                <div id="success">Your email sent Successfully, Thank you.</div>
                                <div id="error"> Error occurred while sending email. Please try again later.</div>
                            </div>
                        </div>
--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!--	Contact Information
===============================================================-->
<section class="full-row">
    <div class="container">
        <div class="row">
{{--            <div class="col-md-12 col-lg-4">--}}
{{--                <div class="contact_info">--}}
{{--                    <h3 class="mb-4 color-primary">Support</h3>--}}
{{--                    <div class="d-flex">--}}
{{--                        <div class="circle mr-4"><img src="/vendor/homex/images/team/01.jpg" alt=""></div>--}}
{{--                        <div class="contact_details">--}}
{{--                            <h5 class="d-table">Lawrance Kyle</h5>--}}
{{--                            <span class="d-table color-secondery">Support Member</span>--}}
{{--                            <a class="color-default" href="#">www.support@homex.com</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-12 col-lg-4">
                <div class="contact_info">
                    <h3 class="mb-4 color-primary">@lang('public.contact_page_contacts')</h3>
                    <ul class="icon_default">
                        <li class="d-flex mb-4">
                            <span class="fa-1x mr-4 w-25-px"><i class="fas fa-map-marker" aria-hidden="true"></i></span>
                            <div class="contact_address">
                                <h5 class="color-primary">@lang('public.contact_page_contacts_address')</h5>
                                <span>{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerAddress', 'SiteOwnerAddress') }}</span>
                            </div>
                        </li>
                        <li class="d-flex mb-4">
                            <span class="fa-1x mr-4 w-25-px"><i class="fas fa-phone" aria-hidden="true"></i></span>
                            <div class="contact_address">
                                <h5 class="color-primary">@lang('public.contact_page_contacts_phone')</h5>
                                <span class="d-table">{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerPhone', 'SiteOwnerPhone') }}</span>
                                <span></span>
                            </div>
                        </li>
                        <li class="d-flex mb-4">
                            <span class="fa-1x mr-4 w-25-px"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                            <div class="contact_address">
                                <h5 class="color-primary">@lang('public.contact_page_contacts_email')</h5>
                                <span>{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerEmail', 'SiteOwnerEmail') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="contact_info">
                    <h3 class="mb-4 color-primary">@lang('public.contact_page_social')</h3>
                    <div class="social_media pt-3 hover_primary">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
{{--                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>--}}
{{--                            <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>--}}
                            <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
{{--                            <li><a href="#"><i class="fas fa-rss" aria-hidden="true"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--	Map
===============================================================-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div id="map" class="contact-location"></div>
            </div>
        </div>
    </div>
</div>

@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPZ-Erd-14Vf2AoPW2Pzlxssf6-2R3PPs"></script>
    <script src="{{ asset('homex/js/map.scripts.js') }}"></script>
    <script>
        (function($){
            var _latitude = 36.596165;
            var _longitude = -97.062988;
            init(_latitude, _longitude);
        })(jQuery);
    </script>
@endsection
