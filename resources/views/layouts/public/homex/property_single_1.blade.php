@php
	use App\Models\RealEstate;
    /**
    * @var \App\Models\RealEstate $realEstate
    */
@endphp

@extends('layouts.public.homex.base')

@section('htmlheader')
{{--	@parent--}}
{{--	<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>--}}
{{--	<link href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" rel="stylesheet"/>--}}
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
                        @include('layouts.public.homex.inc.breadcrumb')
                    </div>
                    <div class="float-right color-primary">
                        <h3 class="banner-title font-weight-bold">@lang('public.real_estate_public_datapage_title')</h3>
                    </div>
				</div>
			</div>
		</div>
	</div>

	<section class="full-row">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="property_single_top mb_20">
						<div class="row">
							<div class="col-md-6 col-lg-6">
							<div class="sale bg-default">{{ $realEstate->getContractTypeCaption() }}</div>
							<div class="icon_default">
								<h5 class="mt_10 color-primary">{{ $realEstate->getPublicName() }}</h5>
								@if ($realEstate->getPublicLocation() !== '')
									<p><i class="fas fa-map-marker" aria-hidden="true"></i> {{ $realEstate->getPublicLocation() }}</p>
								@endif
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="property-price">
                                @if (Auth::user() != null && Auth::user()->hasRole('clients'))
                                <div class="add_favourite color-secondery">
                                    <button onclick="favoriteRealEstateClick({{$realEstate->id}}, this);return false;"
                                            data-activecolor="orange" data-inactivecolor="black"
                                            title="@lang('public.real_estate_favorite_star_title')"
                                    @if ($realEstate->isFavoriteOfLoginedUser()) style="color: orange;"><i class="fas fa-star" aria-hidden="true"></i>
                                    @else style="color: black;"><i class="far fa-star" aria-hidden="true"></i>@endif
                                    </button>
                                </div>
                                @endif
{{--
								<div class="add_favourite color-secondery">
									<form action="#">
										<button title="Add to favourite property"><i class="far fa-star" aria-hidden="true"></i></button>
									</form>
								</div>
--}}
								<div class="area_price">
									@if(!$realEstate->currency->iso_code == 'EUR')
										{{-- $realEstate->getPublicOfferPrice() --}}
										{!! Helper::to_million_string($realEstate->offer_price) !!} {{ $realEstate->currency->iso_code }}
									@else
										{!! Helper::add_space_to_price($realEstate->offer_price) !!} {{ $realEstate->currency->iso_code }}
									@endif
								</div>
								{{--<div class="amount">Fixed Amount</div>--}}
							</div>
						</div>
						</div>
					</div>
                    @php
                        $gallery = $realEstate->getPublicDatapageGalleryImages();
                    @endphp
                    @if (is_array($gallery) && count($gallery))
					<div class="row">
						<div class="col-md-12">
							<div class="full-row overflow-hidden">
								<div class="ls-popup property-slider-one">
									<div id="single-property" style="width:1200px;height:700px;margin:0 auto;margin-bottom: 0px;">
                                        @foreach($gallery as $key => $image)
                                        <!-- Slide {{ $key }}-->
                                        <div class="ls-slide" data-ls="duration:7500; transition2d:5; kenburnszoom:in; kenburnsscale:1.2;">
                                            <img width="1920" height="1080" src="{{ $image }}" class="ls-bg" alt="" />
                                        </div>
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
                    @endif
					<div class="property_details">
						<div class="row">
							<div class="col-md-12 col-lg-8">
								<div class="pro_det">
									<div class="thum_data bg-gray mt_60">
										@include('layouts.public.homex.inc.important-realestate-data-row')
{{--										<ul>--}}
{{--                                            <li><span>{{ $realEstate->base_area_gross }} m<sup>2</sup></span> @lang('public.real_estate_base_area_gross_label')</li>--}}
{{--                                            <li><span>{{ $realEstate->number_levels }}</span> @lang('public.real_estate_number_levels_label')</li>--}}
{{--                                            <li><span>{{ $realEstate->number_bedroom }}</span> @lang('public.real_estate_number_bedroom_label')</li>--}}
{{--                                            <li><span>{{ $realEstate->number_bath }}</span> @lang('public.real_estate_number_bath_label')</li>--}}
{{--                                            <li><span>{{ $realEstate->number_garage }}</span> @lang('public.real_estate_number_garage_label')</li>--}}
{{--                                            <li><span>{{ $realEstate->terrace_size }} m<sup>2</sup></span> @lang('public.real_estate_terrace_size_label')</li>--}}
{{--                                            <li><span>{{ \App\Models\Enum\RealEstateKitchenTypeEnum::getDescription($realEstate->real_estate_kitchen_type_enum) }}</span> @lang('public.real_estate_kitchen_type_label')</li>--}}
{{--										</ul>--}}
									</div>
									<h4 class="color-primary mt_30 mb_30">@lang('public.real_estate_description_label')</h4>
                                    {!! $realEstate->description !!}

{{--									<p class="mt_30">Consectetuer aliquet. Libero porttitor curabitur vivamus accumsan placerat mattis, in lobortis auctor dolor mus, morbi. Dictumst dictumst. Faucibus. Est mollis. Turpis tortor. In vivamus venenatis neque hendrerit risus amet auctor cras, varius augue nullam morbi posuere lacus porttitor dictumst tincidunt curabitur ilisis torquent magnis cras maecenas vel. Odio proin, aptent tristique urna, nibh iaculis auctor Arcu faucibus sollicitudin donec inceptos dapibus viverra. Lorem consequat. Ac viverra torquent.</p>--}}
{{--									 <a class="btn-link clops mt_30" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">More Details</a>
									 <div class="collapse multi-collapse" id="multiCollapseExample1">
									  <div class="card card-body">
										<p>Hymenaeos class nullam pretium cras tristique orci tincidunt, dapibus. Blandit phasellus ligula. Elit senectus posuere commodo in semper, et placerat vehicula ante. Vehicula dui bibendum curabitur. Scelerisque mus mattis elit dolor suspendisse gravida. Faucibus, viverra feugiat dignissim dis. Nulla accumsan nonummy a semper donec rhoncus hendrerit, mi gravida eget nulla neque torquent parturient facilisis praesent enim mus sem. Cubilia. Suscipit. Senectus curae; id augue dapibus sagittis tempor. Cursus. Tortor montes imperdiet sollicitudin tristique consequat. Pellentesque conubia euismod proin convallis donec torquent elit nisi eget aliquam ipsum lorem convallis velit sapien augue tempor ligula aliquet euismod eget nisl justo urna suscipit.</p>
										<p class="mt_30">Purus morbi sociis. Torquent montes convallis magna potenti gravida laoreet id. Nam vehicula aliquam massa suspendisse in facilisi in pharetra eget justo viverra, posuere. Sed interdum euismod adipiscing lobortis massa risus ad enim lectus magnis lacinia ultricies dolor curabitur gravida, potenti dapibus est hymenaeos maecenas. Scelerisque vehicula. Turpis lacus pellentesque nisl platea urna ut sapien semper mus amet aptent. Volutpat nam nascetur commodo vitae maecenas augue feugiat, sem interdum molestie ultricies dictumst. Ante suscipit. Netus ultrices class mollis elit potenti auctor penatibus. Commodo per. Praesent torquent, rhoncus porttitor vitae sem platea, sed dapibus facilisi nam convallis, tristique eleifend taciti ultricies elit varius. Ipsum habitant senectus turpis magna nostra lacus nisl aliquam pharetra pellentesque, eros ullamcorper. Hymenaeos sit laoreet ante per convallis ornare posuere, cum vitae elementum fusce amet. Eget. At laoreet. Molestie sit ac. Vestibulum quis ipsum neque curabitur convallis Convallis nisi adipiscing ligula. Imperdiet habitasse condimentum, sed potenti accumsan tristique cras tempus. Consectetuer curae; ad consequat platea aliquet est enim dis justo justo torquent eget pede malesuada curae; scelerisque dolor Cras natoque commodo molestie elit mauris conubia ad ultrices mus cum dictum. Quisque urna aliquam, ridiculus curae; egestas turpis aptent elit curabitur ipsum. Euismod rhoncus orci vestibulum euismod nunc.</p>
									  </div>
									</div>--}}
									{{-- Tulajdonságok felirat --}}
									<h5 class="pt_60 mb_30 color-primary">@lang('public.real_estate_properties_label')</h5>
									{{-- Tulajdonságok --}}
									<div class="table overflow-x-scroll">
										<table class="table table-striped color-secondery">
										  <tbody>
                                             @php
                                             $properties = $realEstate->getPublicMainProperties();
                                             $counter = 0;
                                             @endphp
                                             @foreach($properties as $property)
												 {{-- Change EUR to HUF --}}
												 @if ($property['labelKey'] == 'Közös költség' || $property['labelKey'] == 'Common charge')
													 @if(preg_replace('/[^0-9]/', '', $property['value']) == '0')
														 @continue
													 @endif
													 @php $property['value'] = str_replace('EUR', 'HUF', $property['value']);@endphp
                                                 @endif
												 @if ($property['labelKey'] == 'Üzemeltetési költség' || $property['labelKey'] == 'Közművesített' || $property['labelKey'] == 'Helyrajzi szám' || $property['labelKey'] == 'Plate number' || $property['labelKey'] == 'Operation fee' || $property['labelKey'] == 'Utilities')
													 @continue
												 @endif
                                                 @if ($property['value'] != '')
													 @if(substr($property['value'],0,2) != ' <')
														 @if($property['labelKey'] != 'Marketing név' && $property['labelKey'] != 'Pontszám' && $property['labelKey'] != 'Score' && $property['labelKey'] != 'Marketing name')
															 @if ($counter % 2 == 0)<tr>@endif
																 @if($realEstate->contract_type_enum == 2 && $property['labelKey'] == 'Irányár')
																	 @php
																		 $property['labelKey'] = "Bérleti díj"
																	 @endphp
																 @endif
																 <td>{{ $property['labelKey'] }}</td>
																 <td style="color: #0d1432">{!! $property['value'] !!}</td>
																 @php
																	 $counter++;
																 @endphp
																 @if ($counter % 2 == 0)</tr>@endif
														 @endif
													 @endif
                                                 @endif
                                             @endforeach
										  </tbody>
										</table>
									</div>
									{{-- Felszereltség felirat --}}
									<h5 class="pt_60 mb_30 color-primary">@lang('public.real_estate_features_label')</h5>
									{{-- Felszereltség --}}
                                    <div class="row">
                                    @php $counter = 0; @endphp
                                    @foreach(RealEstate::$features as $item)
                                        @if ($realEstate->$item == 1)
                                            @if ($counter%4 == 0)
                                                <div class="col-md-12 col-lg-4">
                                                    <div class="more_details">
                                                        <ul>
                                            @endif
                                                            <li class="color-secondery">
                                                                <i class="fas fa-check"></i>
                                                                <span class="color-primary" style="font-weight: normal !important;">{{ __('messages.real_estates_datapage_'.$item.'_label') }}</span>
                                                            </li>
                                                            @php $counter++; @endphp
                                            @if ($counter%4 == 0)
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if ($counter%4 != 0)
                                                        </ul>
                                                    </div>
                                                </div>
                                    @endif
                                    </div>

{{--									<h5 class="pt_60 mb_30 color-primary">Floor Plans</h5>--}}
{{--									<div class="accordion" id="accordionExample">--}}
{{--									  <div class="card">--}}
{{--										<div class="card-header" id="headingOne">--}}
{{--										  <h5 class="mb-0">--}}
{{--											<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
{{--											  Floor Plans	[ 4200 sqft ]--}}
{{--											</button>--}}
{{--										  </h5>--}}
{{--										</div>--}}

{{--										<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">--}}
{{--										  <div class="card-body">--}}
{{--											<ul class="mb_30">--}}
{{--												<li><span>Bed: </span>162.5 sqft</li>--}}
{{--												<li><span>Kitchen: </span>108.2 sqft</li>--}}
{{--												<li><span>Dining: </span>145.7 sqft</li>--}}
{{--												<li><span>Bath:  </span>38.7 sqft</li>--}}
{{--												<li><span>Storage:  </span>123. 2 sqft</li>--}}
{{--											</ul>--}}
{{--											<img src="/vendor/homex/images/house-floor-plan.png" alt="">--}}
{{--										  </div>--}}
{{--										</div>--}}
{{--									  </div>--}}
{{--									  <div class="card">--}}
{{--										<div class="card-header" id="headingTwo">--}}
{{--										  <h5 class="mb-0">--}}
{{--											<button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
{{--											  Garage Plan     [ 340 sqft ]--}}
{{--											</button>--}}
{{--										  </h5>--}}
{{--										</div>--}}
{{--										<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">--}}
{{--										  <div class="card-body">--}}
{{--											<ul class="mb_30">--}}
{{--												<li><span>Bed: </span>162.5 sqft</li>--}}
{{--												<li><span>Kitchen: </span>108.2 sqft</li>--}}
{{--												<li><span>Dining: </span>145.7 sqft</li>--}}
{{--												<li><span>Bath:  </span>38.7 sqft</li>--}}
{{--												<li><span>Storage:  </span>123. 2 sqft</li>--}}
{{--											</ul>--}}
{{--											<img src="/vendor/homex/images/house-floor-plan.png" alt="">--}}
{{--										  </div>--}}
{{--										</div>--}}
{{--									  </div>--}}
{{--									  <div class="card">--}}
{{--										<div class="card-header" id="headingThree">--}}
{{--										  <h5 class="mb-0">--}}
{{--											<button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">--}}
{{--											  Garden Design    [ 480 sqft ]--}}
{{--											</button>--}}
{{--										  </h5>--}}
{{--										</div>--}}
{{--										<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">--}}
{{--										  <div class="card-body">--}}
{{--											<ul class="mb_30">--}}
{{--												<li><span>Bed: </span>162.5 sqft</li>--}}
{{--												<li><span>Kitchen: </span>108.2 sqft</li>--}}
{{--												<li><span>Dining: </span>145.7 sqft</li>--}}
{{--												<li><span>Bath:  </span>38.7 sqft</li>--}}
{{--												<li><span>Storage:  </span>123. 2 sqft</li>--}}
{{--											</ul>--}}
{{--											<img src="/vendor/homex/images/house-floor-plan.png" alt="">--}}
{{--										  </div>--}}
{{--										</div>--}}
{{--									  </div>--}}
{{--									</div>--}}
{{--									<h5 class="pt_60 mb_30 color-primary">Nearby Places</h5>--}}
{{--									<ul class="nav nav-pills mb-3 bg-gray" id="pills-tab" role="tablist">--}}
{{--									  <li class="nav-item">--}}
{{--										<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Hospital</a>--}}
{{--									  </li>--}}
{{--									  <li class="nav-item">--}}
{{--										<a class="nav-link" id="pills-profile-tab2" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Shopping</a>--}}
{{--									  </li>--}}
{{--									  <li class="nav-item">--}}
{{--										<a class="nav-link" id="pills-contact-tab3" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">School</a>--}}
{{--									  </li>--}}
{{--									  <li class="nav-item">--}}
{{--										<a class="nav-link" id="pills-contact-tab4" data-toggle="pill" href="#pills-resturant" role="tab" aria-controls="pills-contact" aria-selected="false">Resturant</a>--}}
{{--									  </li>--}}
{{--									</ul>--}}
{{--									<div class="tab-content" id="pills-tabContent">--}}
{{--									  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home">--}}
{{--										<div class="table overflow-x-scroll">--}}
{{--											<table class="table">--}}
{{--											  <thead>--}}
{{--												<tr>--}}
{{--												  <th scope="col">Name</th>--}}
{{--												  <th scope="col">Distance</th>--}}
{{--												  <th scope="col">Type</th>--}}
{{--												</tr>--}}
{{--											  </thead>--}}
{{--											  <tbody>--}}
{{--												<tr>--}}
{{--												  <td>Massachusetts General Hospital</td>--}}
{{--												  <td>23.7 km</td>--}}
{{--												  <td>Medical Collage</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Langone Medical Center</td>--}}
{{--												  <td>13.2 km</td>--}}
{{--												  <td>Hart Hospital</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Mount Sinai Hospital</td>--}}
{{--												  <td>58.0 km</td>--}}
{{--												  <td>Eye Hospital</td>--}}
{{--												</tr>--}}
{{--											  </tbody>--}}
{{--											</table>--}}
{{--										</div>--}}
{{--									  </div>--}}
{{--									  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile">--}}
{{--										<div class="table overflow-x-scroll">--}}
{{--											<table class="table">--}}
{{--											  <thead>--}}
{{--												<tr>--}}
{{--												  <th scope="col">Name</th>--}}
{{--												  <th scope="col">Distance</th>--}}
{{--												  <th scope="col">Type</th>--}}
{{--												</tr>--}}
{{--											  </thead>--}}
{{--											  <tbody>--}}
{{--												<tr>--}}
{{--												  <td>Massachusetts General Hospital</td>--}}
{{--												  <td>23.7 km</td>--}}
{{--												  <td>Medical Collage</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Langone Medical Center</td>--}}
{{--												  <td>13.2 km</td>--}}
{{--												  <td>Hart Hospital</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Mount Sinai Hospital</td>--}}
{{--												  <td>58.0 km</td>--}}
{{--												  <td>Eye Hospital</td>--}}
{{--												</tr>--}}
{{--											  </tbody>--}}
{{--											</table>--}}
{{--										</div>--}}
{{--									  </div>--}}
{{--									  <div class="tab-pane fade" id="pills-resturant" role="tabpanel" aria-labelledby="pills-resturant">--}}
{{--										<div class="table overflow-x-scroll">--}}
{{--											<table class="table">--}}
{{--											  <thead>--}}
{{--												<tr>--}}
{{--												  <th scope="col">Name</th>--}}
{{--												  <th scope="col">Distance</th>--}}
{{--												  <th scope="col">Type</th>--}}
{{--												</tr>--}}
{{--											  </thead>--}}
{{--											  <tbody>--}}
{{--												<tr>--}}
{{--												  <td>Massachusetts General Hospital</td>--}}
{{--												  <td>23.7 km</td>--}}
{{--												  <td>Medical Collage</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Langone Medical Center</td>--}}
{{--												  <td>13.2 km</td>--}}
{{--												  <td>Hart Hospital</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Mount Sinai Hospital</td>--}}
{{--												  <td>58.0 km</td>--}}
{{--												  <td>Eye Hospital</td>--}}
{{--												</tr>--}}
{{--											  </tbody>--}}
{{--											</table>--}}
{{--										</div>--}}
{{--									  </div>--}}
{{--									  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact">--}}
{{--										  <div class="table overflow-x-scroll">--}}
{{--											<table class="table">--}}
{{--											  <thead>--}}
{{--												<tr>--}}
{{--												  <th scope="col">Name</th>--}}
{{--												  <th scope="col">Distance</th>--}}
{{--												  <th scope="col">Type</th>--}}
{{--												</tr>--}}
{{--											  </thead>--}}
{{--											  <tbody>--}}
{{--												<tr>--}}
{{--												  <td>Massachusetts General Hospital</td>--}}
{{--												  <td>23.7 km</td>--}}
{{--												  <td>Medical Collage</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Langone Medical Center</td>--}}
{{--												  <td>13.2 km</td>--}}
{{--												  <td>Hart Hospital</td>--}}
{{--												</tr>--}}
{{--												<tr>--}}
{{--												  <td>Mount Sinai Hospital</td>--}}
{{--												  <td>58.0 km</td>--}}
{{--												  <td>Eye Hospital</td>--}}
{{--												</tr>--}}
{{--											  </tbody>--}}
{{--											</table>--}}
{{--										  </div>--}}
{{--									  </div>--}}
{{--									</div>--}}
{{--									<h5 class="pt_60 mb_30 color-primary">Property Video</h5>--}}
{{--									<div class="property_video overlay_one mb_30">--}}
{{--										<img src="/vendor/homex/images/video.jpg" alt="">--}}
{{--										<a class="video-popup" href="https://vimeo.com/10749235" title="video popup">--}}
{{--										<i class="fas fa-play" aria-hidden="true"></i></a>--}}
{{--										<div class="loader xy-center">--}}
{{--											<div class="loader-inner ball-scale-multiple">--}}
{{--												<div></div>--}}
{{--												<div></div>--}}
{{--												<div></div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}

{{--									<div class="main-title-two pt_60 pb_60">--}}
{{--										<h3 class="title color-primary">Give Your Review</h3>--}}
{{--									</div>--}}
{{--									<p class="color-secondery">Move Mouse for Rating Active Star</p>--}}
{{--									<ul class="d-inline-block rating float-left mt-4 mr-2 icon_default">--}}
{{--										<li><i class="fas fa-star" aria-hidden="true"></i></li>--}}
{{--										<li><i class="fas fa-star" aria-hidden="true"></i></li>--}}
{{--										<li><i class="fas fa-star" aria-hidden="true"></i></li>--}}
{{--										<li><i class="fas fa-star" aria-hidden="true"></i></li>--}}
{{--										<li><i class="fas fa-star" aria-hidden="true"></i></li>--}}
{{--									</ul>--}}
{{--									<p class="color-default py_15">Very Good</p>--}}
{{--									<form class="form6 w-100 d-inline-block" action="action.html" method="post">--}}
{{--										<div class="row">--}}
{{--											<div class="col-md-6 col-lg-6">--}}
{{--												<div class="form-group">--}}
{{--												  <input class="form-control" name="firstname" placeholder="Name" type="text">--}}
{{--												</div>--}}
{{--											</div>--}}
{{--											<div class="col-md-6 col-lg-6">--}}
{{--												<div class="form-group">--}}
{{--												  <input class="form-control" name="email" placeholder="Email" type="text">--}}
{{--												</div>--}}
{{--											</div>--}}
{{--											<div class="col-md-12 col-lg-12">--}}
{{--												<div class="form-group">--}}
{{--												  <textarea class="form-control" name="comments" cols="30" rows="6" placeholder="Comments"></textarea>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--											<div class="col-lg-12">--}}
{{--												<button type="submit" value="Submit" class="btn btn-default1">Submit</button>--}}
{{--										  </div>--}}
{{--										</div>--}}
{{--									</form>--}}



{{--									<h5 class="mt_60 mb_30 color-primary">User Reviews</h5>--}}
{{--									<ul class="property_feedback">--}}
{{--										<li class="user_reviews borber_b py_30">--}}
{{--											<div class="user_img img_80"><img src="/vendor/homex/images/user/01.jpg" alt=""></div>--}}
{{--											<div class="feedback d-table">--}}
{{--												<div class="d-inline-block">--}}
{{--													<h5 class="font-weight-bold color-primary">Rebecca D. Nagy</h5>--}}
{{--													<div class="star-rating color-default">--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--												<div class="float-right">--}}
{{--													<p class="float-left pr_20 color-secondery">27 February, 2018 at 3.27 pm</p>--}}
{{--													<a href="#" class="btn-link">Replay</a>--}}
{{--												</div>--}}
{{--												<p class="color-secondery mt_15">Fermentum mus porttitor tempor arcu posuere. Nibh consectetuer condimentum ultricies pulvinar eget pede litora interdum magna aenean ullamcorper nisi dis. Viverra. Vulputate. Quisque neque luctus quis rhoncus.</p>--}}
{{--											</div>--}}
{{--										</li>--}}
{{--										<li class="user_reviews borber_b py_30 ml_30">--}}
{{--											<div class="user_img img_80"><img src="/vendor/homex/images/user/01.jpg" alt=""></div>--}}
{{--											<div class="feedback d-table">--}}
{{--												<div class="d-inline-block">--}}
{{--													<h5 class="font-weight-bold color-primary">Rebecca D. Nagy</h5>--}}
{{--													<div class="star-rating color-default">--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--												<div class="float-right">--}}
{{--													<p class="float-left pr_20 color-secondery">27 February, 2018 at 3.27 pm</p>--}}
{{--													<a href="#" class="btn-link">Replay</a>--}}
{{--												</div>--}}
{{--												<p class="color-secondery mt_15">Fermentum mus porttitor tempor arcu posuere. Nibh consectetuer condimentum ultricies pulvinar eget pede litora interdum magna aenean ullamcorper nisi dis. Viverra. Vulputate. Quisque neque luctus quis rhoncus.</p>--}}
{{--											</div>--}}
{{--										</li>--}}
{{--										<li class="user_reviews py_30">--}}
{{--											<div class="user_img img_80"><img src="/vendor/homex/images/user/01.jpg" alt=""></div>--}}
{{--											<div class="feedback d-table">--}}
{{--												<div class="d-inline-block">--}}
{{--													<h5 class="font-weight-bold color-primary">Rebecca D. Nagy</h5>--}}
{{--													<div class="star-rating color-default">--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--														<i class="fas fa-star" aria-hidden="true"></i>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--												<div class="float-right">--}}
{{--													<p class="float-left pr_20 color-secondery">27 February, 2018 at 3.27 pm</p>--}}
{{--													<a href="#" class="btn-link">Replay</a>--}}
{{--												</div>--}}
{{--												<p class="color-secondery mt_15">Fermentum mus porttitor tempor arcu posuere. Nibh consectetuer condimentum ultricies pulvinar eget pede litora interdum magna aenean ullamcorper nisi dis. Viverra. Vulputate. Quisque neque luctus quis rhoncus.</p>--}}
{{--											</div>--}}
{{--										</li>--}}
{{--									</ul>--}}

								</div>
							</div>
							<div class="col-md-12 col-lg-4">
{{--								<ul class="property_btn mt_60 d-inline-block">--}}
{{--									<li class="download"><a href="#" class="btn btn-primary"><i class="fas fa-download" aria-hidden="true"></i></a></li>--}}
{{--									<li><a href="#" class="btn btn-primary">Add to Compare</a></li>--}}
{{--								</ul>--}}
								@if (Auth::user() != null && Auth::user()->hasRole('clients'))
									<a href="#" onclick="favoriteRealEstateClick({{$realEstate->id}}, this); return false;" data-activecolor="orange" data-inactivecolor="white"
									   title="@lang('public.real_estate_favorite_star_title')"
									   @if ($realEstate->isFavoriteOfLoginedUser())style="color: orange;"><i class="far fa-star" aria-hidden="true"></i>
										@else style="color: white;"><i class="far fa-star" aria-hidden="true"></i>
										@endif
										Hozzáadás a kedvencekhez
									</a>
								@endif

								<div class="broker_contact mt_30 mb-5 d-inline-block p_30 boxshadow_one">
									<div class=" float-left pr_20 mb_20">
										<img src="{{ asset('images/logo/realhome.svg') }}" alt="realhome logo" style="width: 100%; height:auto;">
									</div>
									<h6 class="font-weight-bold color-default">@lang('public.real_estate_offer+logo')</h6>
									<form class="form4 w-100 d-inline-block" action="{{ route('kapcsolatfelveteliKeres') }}" method="post">
										@csrf
										@method('POST')
										<div class="row">
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													<input type="text" id="nev" name="nev" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'nev'])"
														   placeholder="@lang('public.contact_name')*" required>
													@include('inc.field-error-message', ['fieldName' => 'nev'])
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													<input type="text" id="email" name="email" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'email'])"
														   placeholder="@lang('public.contact_email')*" required>
													@include('inc.field-error-message', ['fieldName' => 'email'])
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													<input type="text" id="telefon" name="telefon"  class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'telefon'])"
														   placeholder="@lang('public.contact_phone')">
													@include('inc.field-error-message', ['fieldName' => 'telefon'])
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
													@foreach($properties as $property)
														@if($property['labelKey'] == 'ID' && $property['value'] != '')
															<input type="text" id="targy2" name="targy2" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'targy2'])"
																   placeholder="@lang('public.contact_object')*" value="@lang('public.real_estate_list_contact_form_object'){!! $property['value'] !!}" disabled required>
															@include('inc.field-error-message', ['fieldName' => 'targy2'])
															<input type="hidden" id="targy" name="targy" value="Ingatlan ID {!! $property['value'] !!}">
														@endif
													@endforeach
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<div class="form-group">
												  <textarea id="uzenet" name="uzenet" class="form-control bg-gray @include('inc.field-invalid-class', ['fieldName' => 'uzenet'])"
															rows="7" placeholder="@lang('public.contact_message')"></textarea>
													@include('inc.field-error-message', ['fieldName' => 'uzenet'])
												</div>
											</div>
											<div class="col-md-12 col-lg-12">
												<button type="submit" {{--id="send" value="submit"--}} class="btn btn-default1 w-100">@lang('public.contact_send_button')</button>
											</div>
										</div>
									</form>
								</div>
{{--								<div class="mb-5">--}}
{{--									<h5 class="mb_30 color-primary">Instalment Calculator</h5>--}}
{{--									<form class="form5 w-100 d-inline-block" action="action.html" method="post">--}}
{{--										<label class="sr-only" for="inlineFormInputGroupUsername2">Property Price</label>--}}
{{--										<div class="input-group mb-2 mr-sm-2">--}}
{{--											<div class="input-group-prepend">--}}
{{--												<div class="input-group-text">$</div>--}}
{{--											</div>--}}
{{--											<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Property Price">--}}
{{--										</div>--}}
{{--										<label class="sr-only" for="inlineFormInputGroupUsername3">Down Payment</label>--}}
{{--										<div class="input-group mb-2 mr-sm-2">--}}
{{--											<div class="input-group-prepend">--}}
{{--												<div class="input-group-text">$</div>--}}
{{--											</div>--}}
{{--											<input type="text" class="form-control" id="inlineFormInputGroupUsername3" placeholder="Down Payment">--}}
{{--										</div>--}}
{{--										<label class="sr-only" for="inlineFormInputGroupUsername4">Duration Year</label>--}}
{{--										<div class="input-group mb-2 mr-sm-2">--}}
{{--											<div class="input-group-prepend">--}}
{{--												<div class="input-group-text"><i class="fas fa-calendar-o" aria-hidden="true"></i></div>--}}
{{--											</div>--}}
{{--											<input type="text" class="form-control" id="inlineFormInputGroupUsername4" placeholder="Duration Year">--}}
{{--										</div>--}}
{{--										<label class="sr-only" for="inlineFormInputGroupUsername5">Interest Rate</label>--}}
{{--										<div class="input-group mb-2 mr-sm-2">--}}
{{--											<div class="input-group-prepend">--}}
{{--												<div class="input-group-text">%</div>--}}
{{--											</div>--}}
{{--											<input type="text" class="form-control" id="inlineFormInputGroupUsername5" placeholder="Interest Rate">--}}
{{--										</div>--}}
{{--										<button type="submit" value="submit" class="btn btn-default1 mt-4">Calclute Instalment</button>--}}
{{--									</form>--}}
{{--								</div>--}}

{{--								<div class="mb-5">--}}
{{--									<h5 class="mb_30 color-primary">Monthly Best Deal</h5>--}}
{{--									<div class="owl-carousel featured_property">--}}
{{--										<div class="thumbnail_three">--}}
{{--											<div class="image_area overlay_one overfollow">--}}
{{--												<img src="{{ asset('images/no-pics/no-pic.jpg') }}" alt="">--}}
{{--												<div class="Featured">Featured</div>--}}
{{--												<div class="sale sale_position bg-primary">For Sale</div>--}}
{{--												<div class="area_price price_position">$352,000 <span>$1200/Sqft</span></div>--}}
{{--												<div class="starmark starmark_position"><i class="far fa-star" aria-hidden="true"></i></div>--}}
{{--											</div>--}}
{{--											<div class="thum_three_content bg-white color-secondery">--}}
{{--												<div class="thum_title2 icon_default bg-gray">--}}
{{--													<h5 class="hover_primary"><a href="#">Nirala Appartment</a></h5>--}}
{{--													<p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--										<div class="thumbnail_three">--}}
{{--											<div class="image_area overlay_one overfollow">--}}
{{--												<img src="{{ asset('vendor/homex/images/thumbnail/02.jpg') }}" alt="">--}}
{{--												<div class="Featured">Featured</div>--}}
{{--												<div class="sale sale_position bg-primary">For Sale</div>--}}
{{--												<div class="area_price price_position">$212,000 <span>$1200/Sqft</span></div>--}}
{{--												<div class="starmark starmark_position"><i class="far fa-star" aria-hidden="true"></i></div>--}}
{{--											</div>--}}
{{--											<div class="thum_three_content bg-white color-secondery">--}}
{{--												<div class="thum_title2 icon_default bg-gray">--}}
{{--													<h5 class="hover_primary"><a href="#">Apolo Family Appartment</a></h5>--}}
{{--													<p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--										<div class="thumbnail_three">--}}
{{--											<div class="image_area overlay_one overfollow">--}}
{{--												<img src="{{ asset('vendor/homex/images/thumbnail/03.jpg') }}" alt="">--}}
{{--												<div class="Featured">Featured</div>--}}
{{--												<div class="sale sale_position bg-primary">For Sale</div>--}}
{{--												<div class="area_price price_position">$52,000 <span>$1200/Sqft</span></div>--}}
{{--												<div class="starmark starmark_position"><i class="far fa-star" aria-hidden="true"></i></div>--}}
{{--											</div>--}}
{{--											<div class="thum_three_content bg-white color-secondery">--}}
{{--												<div class="thum_title2 icon_default bg-gray">--}}
{{--													<h5 class="hover_primary"><a href="#">Office Floor In Trade Center</a></h5>--}}
{{--													<p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--										<div class="thumbnail_three">--}}
{{--											<div class="image_area overlay_one overfollow">--}}
{{--												<img src="{{ asset('vendor/homex/images/thumbnail/01.jpg') }}" alt="">--}}
{{--												<div class="Featured">Featured</div>--}}
{{--												<div class="sale sale_position bg-primary">For Sale</div>--}}
{{--												<div class="area_price price_position">$352,000 <span>$1200/Sqft</span></div>--}}
{{--												<div class="starmark starmark_position"><i class="far fa-star" aria-hidden="true"></i></div>--}}
{{--											</div>--}}
{{--											<div class="thum_three_content bg-white color-secondery">--}}
{{--												<div class="thum_title2 icon_default bg-gray">--}}
{{--													<h5 class="hover_primary"><a href="#">Nirala Appartment</a></h5>--}}
{{--													<p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</div>--}}

{{--								<div class="mb-5">--}}
{{--									<h5 class="mb_30 color-primary">Property Location</h5>--}}
{{--									<div class="map_widget" id="map">--}}
{{--                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d405916.6669451416!2d18.913780488302212!3d47.45764364475219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c334d1d4cfc9%3A0x400c4290c1e1160!2sBudapest!5e0!3m2!1shu!2shu!4v1564055503723!5m2!1shu!2shu" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
{{--									</div>--}}
{{--									<script>--}}
{{--										//	leafletjs map widget rendering:--}}
{{--										var element = document.getElementById('map');--}}
{{--										element.style = 'height:400px;';--}}
{{--										var map = L.map(element);--}}
{{--										// Add OSM tile leayer to the Leaflet map--}}
{{--										L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {--}}
{{--											attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'--}}
{{--										}).addTo(map);--}}
{{--										// Target's GPS coordinates.--}}
{{--										var target = L.latLng('47.50737', '19.04611');--}}
{{--										// Set map's center to target with zoom 14.--}}
{{--										map.setView(target, 14);--}}
{{--										// Place a marker on the same location.--}}
{{--										//	L.marker(target).addTo(map);--}}
{{--									</script>--}}
{{--								</div>--}}
							</div>
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
