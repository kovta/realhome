
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

{{--                    <div class="fact-counter mt_30">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4 col-lg-4">--}}
{{--                                <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms">--}}
{{--                                    <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="1310">0</h2><span>+</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="color-secondery">Deals Success</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 col-lg-4">--}}
{{--                                <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms">--}}
{{--                                    <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="946">0</h2><span>+</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="color-secondery">Insurance Done</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 col-lg-4">--}}
{{--                                <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms">--}}
{{--                                    <div class="counting_digit color-default pb_5 mt_15 mb-0"><strong>$</strong><h2 class="count-num" data-speed="3000" data-stop="751867">0</h2><span>+</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="color-secondery">Micro Finincing</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
{{--                <div class="col-md-12 col-lg-5">--}}
{{--                    <div class="about_img">--}}
{{--                        <img src="{{ asset('vendor/homex/images/about/01.png') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</section>
<!--	Happy Living
============================================================-->

{{--<section class="full-row living bg_one overlay_three">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12 col-lg-6">--}}
{{--                <div class="living-list color-white">--}}
{{--                    <h3 class="pb_30">Make life for happy living</h3>--}}
{{--                    <ul>--}}
{{--                        <li class="pb_30 icon_default icon_font">--}}
{{--                            <i class="flaticon-reward" aria-hidden="true"></i>--}}
{{--                            <h5 class="pb_20">Experience Quality</h5>--}}
{{--                            <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>--}}
{{--                        </li>--}}
{{--                        <li class="pb_30 icon_default icon_font">--}}
{{--                            <i class="flaticon-real-estate" aria-hidden="true"></i>--}}
{{--                            <h5 class="pb_20">Experience Quality</h5>--}}
{{--                            <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>--}}
{{--                        </li>--}}
{{--                        <li class="pb_30 icon_default icon_font">--}}
{{--                            <i class="flaticon-seller" aria-hidden="true"></i>--}}
{{--                            <h5 class="pb_20">Experience Quality</h5>--}}
{{--                            <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<!--	How it work
============================================================-->

{{--<section class="full-row">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12 col-lg-12">--}}
{{--                <div class="main-title-one">--}}
{{--                    <h2 class="title color-primary">How It Work</h2>--}}
{{--                    <p class="sub-title color-secondery py_60">We listed our oppertunity and servies as a real estate company</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="box-six text-center icon_default icon_font color-secondery mb_30">--}}
{{--                    <div class="marking bg-default color-white">1</div>--}}
{{--                    <div class="left-arrow"><i class="flaticon-investor" aria-hidden="true"></i></div>--}}
{{--                    <div class="box_six_textarea">--}}
{{--                        <h5 class="color-primary mt_15 mb_20">Discussion</h5>--}}
{{--                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="box-six text-center icon_default icon_font color-secondery mb_30">--}}
{{--                    <div class="marking bg-default color-white">2</div>--}}
{{--                    <div class="left-arrow"><i class="flaticon-search" aria-hidden="true"></i></div>--}}
{{--                    <div class="box_six_textarea">--}}
{{--                        <h5 class="color-primary mt_15 mb_20">Files Review</h5>--}}
{{--                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="box-six text-center icon_default icon_font color-secondery mb_30">--}}
{{--                    <div class="marking bg-default color-white">3</div>--}}
{{--                    <div><i class="flaticon-handshake" aria-hidden="true"></i></div>--}}
{{--                    <div class="box_six_textarea">--}}
{{--                        <h5 class="color-primary mt_15 mb_20">Acquire</h5>--}}
{{--                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="box-six text-center icon_default icon_font color-secondery mb_30">--}}
{{--                    <div class="marking bg-default color-white">6</div>--}}
{{--                    <div><i class="flaticon-money" aria-hidden="true"></i></div>--}}
{{--                    <div class="box_six_textarea">--}}
{{--                        <h5 class="color-primary mt_15 mb_20">Collect</h5>--}}
{{--                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="box-six text-center icon_default icon_font color-secondery mb_30">--}}
{{--                    <div class="marking bg-default color-white">5</div>--}}
{{--                    <div class="right-arrow"><i class="flaticon-diagram" aria-hidden="true"></i></div>--}}
{{--                    <div class="box_six_textarea">--}}
{{--                        <h5 class="color-primary mt_15 mb_20">Survey</h5>--}}
{{--                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-lg-4">--}}
{{--                <div class="box-six text-center icon_default icon_font color-secondery mb_30">--}}
{{--                    <div class="marking bg-default color-white">4</div>--}}
{{--                    <div class="right-arrow"><i class="flaticon-strategy" aria-hidden="true"></i></div>--}}
{{--                    <div class="box_six_textarea">--}}
{{--                        <h5 class="color-primary mt_15 mb_20">Managment</h5>--}}
{{--                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!--	Achievement
============================================================-->

{{--<section class="full-row achievement bg_two overlay_two">--}}
{{--    <div class="container">--}}
{{--        <div class="fact-counter">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-3 col-lg-3">--}}
{{--                    <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms"><i class="flaticon-house" aria-hidden="true"></i>--}}
{{--                        <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="1732">0</h2>--}}
{{--                        </div>--}}
{{--                        <div class="ach_name">Property Available</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-lg-3">--}}
{{--                    <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms"><i class="flaticon-man" aria-hidden="true"></i>--}}
{{--                        <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="341">0</h2>--}}
{{--                        </div>--}}
{{--                        <div class="ach_name">Registered Agents</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-lg-3">--}}
{{--                    <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms"><i class="flaticon-budget" aria-hidden="true"></i>--}}
{{--                        <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="2350">0</h2>--}}
{{--                        </div>--}}
{{--                        <div class="ach_name">People Are Invested</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-3 col-lg-3">--}}
{{--                    <div class="counter count wow icon_white color-white text-center icon_font" data-wow-duration="300ms"><i class="flaticon-investment" aria-hidden="true"></i>--}}
{{--                        <div class="counting_digit color-default pb_5 mt_15 mb-0"> <h2 class="count-num" data-speed="3000" data-stop="13780">0</h2><h2>K</h2>--}}
{{--                        </div>--}}
{{--                        <div class="ach_name">Total Investment</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!--	Our Team
============================================================-->

{{--<section class="full-row">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12 col-lg-12">--}}
{{--                <div class="main-title-one">--}}
{{--                    <h2 class="title color-primary">Our Agents</h2>--}}
{{--                    <p class="sub-title color-secondery py_60">Process to get your right one, almost easy, flexible and fun.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="team-one">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 col-lg-4">--}}
{{--                    <div class="profile">--}}
{{--                        <div class="pro-img overfollow">--}}
{{--                            <img src="/vendor/homex/images/team/01.jpg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="profile_data color-secondery hover_primary">--}}
{{--                            <div class="agent_name p_20">--}}
{{--                                <h5 class="font-weight-bold"><a href="#">Karen Eilla Boyette</a></h5>--}}
{{--                                <span>Appartment Agent</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-4">--}}
{{--                    <div class="profile">--}}
{{--                        <div class="pro-img overfollow">--}}
{{--                            <img src="/vendor/homex/images/team/02.jpg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="profile_data color-secondery hover_primary">--}}
{{--                            <div class="agent_name p_20">--}}
{{--                                <h5 class="font-weight-bold"><a href="#">Walter Devid Moye</a></h5>--}}
{{--                                <span>Condos Agent</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 col-lg-4">--}}
{{--                    <div class="profile">--}}
{{--                        <div class="pro-img overfollow">--}}
{{--                            <img src="/vendor/homex/images/team/03.jpg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="profile_data color-secondery hover_primary">--}}
{{--                            <div class="agent_name p_20">--}}
{{--                                <h5 class="font-weight-bold"><a href="#">Linda Dina Pate</a></h5>--}}
{{--                                <span>Commercial Building Agent</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!--	Partner
===========================================================-->

{{--<section class="full-row pt-0">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12 col-lg-12">--}}
{{--                <div class="main-title-one">--}}
{{--                    <h2 class="title color-primary">Whome We Worked</h2>--}}
{{--                    <p class="sub-title color-secondery py_60">We listed our oppertunity and servies as a real estate company</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-12 col-lg-12">--}}
{{--                <div class="partner">--}}
{{--                    <div class="owl-carousel partners">--}}
{{--                        <img src="/vendor/homex/images/partner/1.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/2.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/3.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/4.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/5.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/3.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/1.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/2.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/3.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/4.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/5.png" alt="">--}}
{{--                        <img src="/vendor/homex/images/partner/3.png" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
