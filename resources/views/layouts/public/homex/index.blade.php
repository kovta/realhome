
@extends('layouts.public.homex.base')

@section('htmlheader')
@endsection

@section('descendant-site')
<!--	Header
============================================================-->
@include('layouts.public.homex.header-one')


<!-- Slider HTML markup -->
<div class="full-row overflow-hidden">
	<div id="image-slider-2" style="width:1200px; height:800px; margin:0 auto; margin-bottom: 0px;">

		<!-- Slide 1-->
		<div class="ls-slide" data-ls="bgposition:50% 50%; duration:9000; transition2d:4; kenburnsscale:1.2;">

			{{-- <img width="1920" height="1080" src="{{ asset('vendor/homex/images/slider/01.jpg') }}" class="ls-bg" alt="" /> --}}
			<img width="1920" height="1080" src="{{ asset('images/slider/02.jpg') }}" class="ls-bg" alt="" />

			<div style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; width:100%; height:100%;" class="ls-l slider-layer-1" data-ls="showinfo:1; position:fixed; durationout:400;"></div>
{{--			<p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:76px; color:#ffffff; top:320px; left:50px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:300; offsetyout:-30; durationout:400; parallaxlevel:0;">Oldal mottója</p>--}}
{{--			<p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:20px; top:290px; left:50px;" class="ls-l color-default" data-ls="offsetyin:30; durationin:1000; delayin:150 offsetyout:-30; durationout:400; parallaxlevel:0;">Oldal címe</p>--}}
{{--			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:370px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:600; offsetyout:-30; durationout:400; parallaxlevel:0;">Vagy a hónap ajánlata</p>--}}
{{--			<div style="top:440px; left:53px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; height:2px; width:350px; background:#adadad;" class="ls-l" data-ls="showinfo:1; durationin:1000; delayin:1200; offsetyout:-30; durationout:400; scalexin:0;"></div>--}}
{{--			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:430px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:1600; offsetyout:-30; durationout:400; parallaxlevel:0;"><i class="fas fa-map-marker color-default" aria-hidden="true"></i> 1744 Daylene Drive Newport MI 48166, Australia</p>--}}
{{--			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:470px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:0; durationin:1000; delayin:2200; offsetyout:-30; durationout:400; parallaxlevel:0;">$ 12500.00 / Monthly</p>--}}
{{--			<a style="" class="ls-l" href="#" target="_self" data-ls="offsetyin:30; durationin:1000; delayin:2800; offsetyout:-30; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#ffffff; hovercolor:#444444; parallaxlevel:0;">--}}
{{--				<p style="font-weight:500; text-align:center;cursor:pointer; padding-top:8px; paddingde -bottom:7px; font-family:'Varela Round', sans-serif; font-size:15px; top:560px; left:53px; border-top:2px solid #fff; border-right:2px solid #fff; padding-right:25px; border-bottom:2px solid #fff; border-left:2px solid #fff; padding-left:25px; line-height:30px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; color:#ffffff; background:rgba(0, 0, 0, 0.1); border-radius:2px; style:font-weight:500; text-align:center;cursor:pointer;" class=" ls-button">View Details</p>--}}
{{--			</a>--}}
{{--			<div style="text-align:center; width:100px; height:35px; line-height: 35px; font-family:'Varela Round', sans-serif; font-size:15px; color:#ffffff; border-radius:3px; top:490px; left:260px;" class="ls-l bg-default" data-ls="delayin:3200; easingin:easeOutElastic; rotateyin:-300; durationout:400; rotateyout:-400; parallaxlevel:0;">For Rent</div>--}}
		</div>
{{--

		<!-- Slide 2-->
		<div class="ls-slide" data-ls="bgposition:50% 50%; duration:9000; transition2d:4; kenburnsscale:1.2;">
			<img width="1920" height="1080" src="{{ asset('vendor/homex/images/slider/01.jpg') }}" class="ls-bg" alt="" />

			<div style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; width:100%; height:100%;" class="ls-l slider-layer-1" data-ls="showinfo:1; position:fixed; durationout:400;"></div>

			<p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:76px; color:#ffffff; top:320px; left:50px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:300; offsetyout:-30; durationout:400; parallaxlevel:0;">House for your family</p>
			<p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:20px; top:290px; left:50px;" class="ls-l color-default" data-ls="offsetyin:30; durationin:1000; delayin:150 offsetyout:-30; durationout:400; parallaxlevel:0;">Dream</p>
			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:370px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:600; offsetyout:-30; durationout:400; parallaxlevel:0;">Best featured family appartment this month</p>
			<div style="top:440px; left:53px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; height:2px; width:350px; background:#adadad;" class="ls-l" data-ls="showinfo:1; durationin:1000; delayin:1200; offsetyout:-30; durationout:400; scalexin:0;"></div>
			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:430px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:1600; offsetyout:-30; durationout:400; parallaxlevel:0;"><i class="fas fa-map-marker color-default" aria-hidden="true"></i> 1744 Daylene Drive Newport MI 48166, Australia</p>
			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:470px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:0; durationin:1000; delayin:2200; offsetyout:-30; durationout:400; parallaxlevel:0;">$ 12500.00 / Monthly</p>
			<a style="" class="ls-l" href="#" target="_self" data-ls="offsetyin:30; durationin:1000; delayin:2800; offsetyout:-30; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#ffffff; hovercolor:#444444; parallaxlevel:0;">
				<p style="font-weight:500; text-align:center;cursor:pointer; padding-top:8px; padding-bottom:7px; font-family:'Varela Round', sans-serif; font-size:15px; top:560px; left:53px; border-top:2px solid #fff; border-right:2px solid #fff; padding-right:25px; border-bottom:2px solid #fff; border-left:2px solid #fff; padding-left:25px; line-height:30px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; color:#ffffff; background:rgba(0, 0, 0, 0.1); border-radius:2px; style:font-weight:500; text-align:center;cursor:pointer; ;" class=" ls-button">View Details</p>
			</a>
			<div style="text-align:center; width:100px; height:35px; line-height: 35px; font-family:'Varela Round', sans-serif; font-size:15px; color:#ffffff; border-radius:3px; top:490px; left:260px;" class="ls-l bg-default" data-ls="delayin:3200; easingin:easeOutElastic; rotateyin:-300; durationout:400; rotateyout:-400; parallaxlevel:0;">For Rent</div>
		</div>

		<!-- Slide 3-->
		<div class="ls-slide" data-ls="bgposition:50% 50%; duration:9000; transition2d:4; kenburnsscale:1.2;">
			<img width="1920" height="1080" src="{{ asset('vendor/homex/images/slider/01.jpg') }}" class="ls-bg" alt="" />

			<div style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; width:100%; height:100%;" class="ls-l slider-layer-1" data-ls="showinfo:1; position:fixed; durationout:400;"></div>

			<p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:76px; color:#ffffff; top:320px; left:50px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:300; offsetyout:-30; durationout:400; parallaxlevel:0;">House for your family</p>
			<p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:20px; top:290px; left:50px;" class="ls-l color-default" data-ls="offsetyin:30; durationin:1000; delayin:150 offsetyout:-30; durationout:400; parallaxlevel:0;">Dream</p>
			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:370px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:600; offsetyout:-30; durationout:400; parallaxlevel:0;">Best featured family appartment this month</p>
			<div style="top:440px; left:53px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; height:2px; width:350px; background:#adadad;" class="ls-l" data-ls="showinfo:1; durationin:1000; delayin:1200; offsetyout:-30; durationout:400; scalexin:0;"></div>
			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:430px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:1600; offsetyout:-30; durationout:400; parallaxlevel:0;"><i class="fas fa-map-marker color-default" aria-hidden="true"></i> 1744 Daylene Drive Newport MI 48166, Australia</p>
			<p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:470px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:0; durationin:1000; delayin:2200; offsetyout:-30; durationout:400; parallaxlevel:0;">$ 12500.00 / Monthly</p>
			<a style="" class="ls-l" href="#" target="_self" data-ls="offsetyin:30; durationin:1000; delayin:2800; offsetyout:-30; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#ffffff; hovercolor:#444444; parallaxlevel:0;">
				<p style="font-weight:500; text-align:center;cursor:pointer; padding-top:8px; padding-bottom:7px; font-family:'Varela Round', sans-serif; font-size:15px; top:560px; left:53px; border-top:2px solid #fff; border-right:2px solid #fff; padding-right:25px; border-bottom:2px solid #fff; border-left:2px solid #fff; padding-left:25px; line-height:30px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; color:#ffffff; background:rgba(0, 0, 0, 0.1); border-radius:2px; style:font-weight:500; text-align:center;cursor:pointer; ;" class=" ls-button">View Details</p>
			</a>
			<div style="text-align:center; width:100px; height:35px; line-height: 35px; font-family:'Varela Round', sans-serif; font-size:15px; color:#ffffff; border-radius:3px; top:490px; left:260px;" class="ls-l bg-default" data-ls="delayin:3200; easingin:easeOutElastic; rotateyin:-300; durationout:400; rotateyout:-400; parallaxlevel:0;">For Rent</div>
		</div>
--}}
	</div>
</div>
<!-- Property Search Form One
=============================================================-->
@include('layouts.public.homex.inc.index_search_form_one')
<!--	Featured Properties
=======================================================-->
{{--
@if ($featuredRealEstates->count() > 0)
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">@lang('public.featured_properties_block_title')</h2>
					<p class="sub-title color-secondery py_60">@lang('public.featured_properties_block_subtitle')</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="owl-carousel carousel-main">
                    @include('layouts.public.homex.inc.index_featured_properties')
				</div>
			</div>
		</div>
	</div>
</section>
@endif
--}}
<!--	Featured Rental Properties
=======================================================-->
@if ($featuredRentalRealEstates->count() > 0)
    <section class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="main-title-one">
                        <h2 class="title color-primary">@lang('public.featured_rental_properties_block_title')</h2>
                        <p class="sub-title color-secondery py_60">@lang('public.featured_rental_properties_block_subtitle')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="owl-carousel carousel-main">
                        @include('layouts.public.homex.inc.index_featured_rental_properties')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!--	Featured Sale Properties
=======================================================-->
@if ($featuredSaleRealEstates->count() > 0)
    <section class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="main-title-one">
                        <h2 class="title color-primary">@lang('public.featured_sale_properties_block_title')</h2>
                        <p class="sub-title color-secondery py_60">@lang('public.featured_sale_properties_block_subtitle')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="owl-carousel carousel-main">
                        @include('layouts.public.homex.inc.index_featured_sale_properties')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!--	Text Block One
======================================================-->
{{--
<section class="full-row bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">What We Do</h2>
					<p class="sub-title color-secondery py_60">We listed our oppertunity and servies as a real estate company</p>
				</div>
			</div>
		</div>
		<div class="text-box-one">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="box-one p-4 text-center rounded icon_default icon_font">
						<i class="flaticon-rent" aria-hidden="true"></i>
						<h5 class="hover_primary py_15 m-0"><a href="service_details.html">Selling Service</a></h5>
						<p class="color-secondery">Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-one p-4 text-center rounded icon_default icon_font">
						<i class="flaticon-for-rent" aria-hidden="true"></i>
						<h5 class="hover_primary py_15 m-0"><a href="service_details.html">Rental Service</a></h5>
						<p class="color-secondery">Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-one p-4 text-center rounded icon_default icon_font">
						<i class="flaticon-list" aria-hidden="true"></i>
						<h5 class="hover_primary py_15 m-0"><a href="service_details.html">Property Listing</a></h5>
						<p class="color-secondery">Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-one p-4 text-center rounded icon_default icon_font">
						<i class="flaticon-diagram" aria-hidden="true"></i>
						<h5 class="hover_primary py_15 m-0"><a href="service_details.html">Legal Investment</a></h5>
						<p class="color-secondery">Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
					</div>
				</div>
				<div class="col-md-12 col-lg-12">
					<div class="alinment pt-5"><a class="btn btn-default1" href="{{ route('rolunk') }}">@lang('public.footer_about_label')</a></div>
				</div>
			</div>
		</div>
	</div>
</section>
--}}
<!--	Happy Living
============================================================-->
{{--
<section class="full-row living bg_one overlay_three">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-6">
				<div class="living-list color-white pr-4">
					<h3 class="pb_30">Make life for happy living</h3>
					<ul>
						<li class="pb_30 icon_default icon_font">
							<i class="flaticon-reward" aria-hidden="true"></i>
							<h5 class="pb_20">Experience Quality</h5>
							<p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
						</li>
						<li class="pb_30 icon_default icon_font">
							<i class="flaticon-real-estate" aria-hidden="true"></i>
							<h5 class="pb_20">Experience Quality</h5>
							<p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
						</li>
						<li class="pb_30 icon_default icon_font">
							<i class="flaticon-seller" aria-hidden="true"></i>
							<h5 class="pb_20">Experience Quality</h5>
							<p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
--}}
<!--	How It Work
============================================================-->
{{--
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">How It Works</h2>
					<p class="sub-title color-secondery py_60">Process to get your right one, almost easy, flexible and fun.</p>
				</div>
			</div>
		</div>
		<div class="text-box-two">
			<div class="row">
				<div class="col-lg-4">
					<div class="box-two p_30 icon_default icon_font color-secondery rounded mb-4">
						<i class="flaticon-home" aria-hidden="true"></i>
						<h5 class="color-primary py-2 m-0">Search Your Home</h5>
						<p class="pt_15">Select your home or appartment and let’s contact with us. Ask what answer you need. You can also contact with the agent if you have any question.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="box-two p_30 icon_default icon_font color-secondery rounded mb-4">
						<i class="flaticon-contact" aria-hidden="true"></i>
						<h5 class="color-primary py-2 m-0">Let's Contact With Us</h5>
						<p class="pt_15">Select your home or appartment and let’s contact with us. Ask what answer you need. You can also contact with the agent if you have any question.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="box-two p_30 icon_default icon_font color-secondery rounded mb-4">
						<i class="flaticon-payment" aria-hidden="true"></i>
						<h5 class="color-primary py-2 m-0">Make a Deal and Payment</h5>
						<p class="pt_15">Sign upi online and move in as soon as you ready! We complete your property deal in our office. After the deal you can pay the instalment or rent in online.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
--}}
<!--	Popular Place
============================================================-->
{{--
<section class="full-row bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">Popular Places</h2>
					<p class="sub-title color-secondery py_60">We listed our oppertunity and servies as a real estate company</p>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6 col-lg-3 pb-1">
					<div class="thumbnail_two overlay_two overfollow mx-n13">
						<img src="{{ asset('vendor/homex/images/thumbnail4/1.jpg') }}" alt="">
						<div class="thum_two_text color-white hover_white">
							<h4><a href="#">New York</a></h4>
							<span>31 Properties Listed</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 pb-1">
					<div class="thumbnail_two overlay_two overfollow mx-n13">
						<img src="{{ asset('vendor/homex/images/thumbnail4/2.jpg') }}" alt="">
						<div class="thum_two_text color-white hover_white">
							<h4><a href="#">Florida</a></h4>
							<span>12 Properties Listed</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 pb-1">
					<div class="thumbnail_two overlay_two overfollow mx-n13">
						<img src="{{ asset('vendor/homex/images/thumbnail4/3.jpg') }}" alt="">
						<div class="thum_two_text color-white hover_white">
							<h4><a href="#">Los Angeles</a></h4>
							<span>17 Properties Listed</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 pb-1">
					<div class="thumbnail_two overlay_two overfollow mx-n13">
						<img src="{{ asset('vendor/homex/images/thumbnail4/4.jpg') }}" alt="">
						<div class="thum_two_text color-white hover_white">
							<h4><a href="#">Miami</a></h4>
							<span>25 Properties Listed</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
--}}
<!--	Blog
============================================================-->
{{--
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">Recent Articles</h2>
					<p class="sub-title color-secondery py_60">The most recent posted articles and valuable tips.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="row">
					<div class="col-md-6 col-lg-4 mb-4">
						<div class="blog_one bg-white boxshadow_one h-100">
							<div class="blog_img overlay_one color-white">
								<img src="{{ asset('vendor/homex/images/blog/01.jpg') }}" alt="image">
								<div class="date">November 26, 2018</div>
							</div>
							<div class="blog_content p_30 color-secondery">
								<div class="hover_primary pb_20">
									<h6 class="blog_title m-0"><a href="blog_details.html">Our team are working to provide the owneship of property.</a></h6>
								</div>
								<p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
								<a class="btn-link mt_15" href="#">Read More</a>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-4 mb-4">
						<div class="blog_one bg-white boxshadow_one h-100">
							<div class="blog_img overlay_one color-white">
								<img src="{{ asset('vendor/homex/images/blog/02.jpg') }}" alt="image">
								<div class="date">November 10, 2018</div>
							</div>
							<div class="blog_content p_30 color-secondery">
								<div class="hover_primary pb_20">
									<h6 class="blog_title m-0"><a href="blog_details.html">Your investment is our heart, so you can stay in relax.</a></h6>
								</div>
								<p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
								<a class="btn-link mt_15" href="#">Read More</a>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-4 mb-4">
						<div class="blog_one bg-white boxshadow_one h-100">
							<div class="blog_img overlay_one color-white">
								<img src="{{ asset('vendor/homex/images/blog/03.jpg') }}" alt="image">
								<div class="date">October 31, 2018</div>
							</div>
							<div class="blog_content p_30 color-secondery">
								<div class="hover_primary pb_20">
									<h6 class="blog_title m-0"><a href="blog_details.html">What do you thinking for your family house.</a></h6>
								</div>
								<p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
								<a class="btn-link mt_15" href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
--}}
<!--	Massage Box One
============================================================-->
{{--
<div class="full-row massage bg-default py-5">
	<div class="container">
		<div class="row">
			<div class="col-mg-12 col-lg-12">
				<div class="alinment color-white">
					<h3 class="massage_one">How to Become Easy and Flexible to Living in Los Angles. Get A Comfortable Appartment in Budget.</h3>
				</div>
			</div>
		</div>
	</div>
</div>
--}}
<!--	FOOTER
============================================================-->
@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
