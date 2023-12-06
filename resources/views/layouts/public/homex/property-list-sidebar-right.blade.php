@php
    use App\Models\Enum\RealEstateKitchenTypeEnum;
    /**
    * @var \App\Models\RealEstate[] $realEstates
    * @var array $queryParams
    * @var array $areaNameArray
    * @var array $townDistrictNameArray
    * @var array $neighborhoodNameArray
    * @var \Illuminate\Http\Request $request
    * @var \App\Models\SpecialOfferPage $specialOfferPage
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
                        @include('layouts.public.homex.inc.breadcrumb')
                    </div>
                    <div class="float-right color-primary">
                        <h3 class="banner-title font-weight-bold">@lang('public.real_estate_list_title')</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="imageGalleryApp">
        <lightbox :images="images" ref="lightbox" :show-caption="false" :show-light-box="false"></lightbox>
    </div>
    <script type="text/javascript">
        let galleryImages = [];
        let tempImages = [];
    </script>
    <!--	Property List and Grid
    ===============================================================-->
    <section class="full-row">
        <div class="container">
            <div class="row">

                @if ($specialOfferPage != null && is_a($specialOfferPage, '\App\Models\SpecialOfferPage'))
                    <div class="col-md-12 col-lg-12">
                        <div class="main-title-two pb_60">
                            <h3 class="title color-primary">{{$specialOfferPage->menu_name}}</h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12" style="margin-bottom: 50px;">
                        {!! $specialOfferPage->page_text !!}
                        <hr>
                    </div>
                @endif

                <div class="col-md-12 col-lg-8">
                    <div class="choost_listing m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="top_filter pb-4">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-9">
                                            <div class="short_by">
                                                <label>@lang('public.sorts_by_label') :</label>
                                                <div class="form-group m-0 pr-5">
                                                    <select onchange="loadOrderedContent()" id="orderBy" class="form-select" name="orderBy">
                                                        <option @if($selectedOrder == "1") selected @endif value="1">@lang('public.sorts_by_created_desc_label')</option>
                                                        <option @if($selectedOrder == "2") selected @endif value="2">@lang('public.sorts_by_offer_price_asc_label')</option>
                                                        <option @if($selectedOrder == "3") selected @endif value="3">@lang('public.sorts_by_offer_price_desc_label')</option>
                                                    </select>
                                                </div>
                                                <label>
                                                    @lang('public.list_item_numbers_label',
                                                        ['items' => (($realEstates->currentPage()-1)*$realEstates->perPage()+1 ).'-'.((($realEstates->currentPage()-1)*$realEstates->perPage()) + $realEstates->perPage() ),
                                                         'total' => $realEstates->total()
                                                         ])
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            {{--                                        <div class="property-view py-1 float-right color-primary-a">
                                                                                        <a href="property_grid_sidebar_right.html"><i class="fas fa-th-large" aria-hidden="true"></i></a>
                                                                                        <a href="property_list_sidebar_right.html" class="active"><i class="fas fa-th-list" aria-hidden="true"></i></a>
                                                                                    </div>--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="list_item">
                                    @foreach ($realEstates as $key => $realEstate)
                                        {{-- galeria js tomb feltoltese --}}
                                        <script type="text/javascript">
                                            tempImages = [];
                                            @foreach ($realEstate->getPublicDatapageGalleryImages() as $imagekey => $publicDatapageGalleryImageSrc)
                                            tempImages.push({
                                                thumb: '{{ $publicDatapageGalleryImageSrc }}',
                                                src: '{{ $publicDatapageGalleryImageSrc }}'
                                            });
                                            @endforeach
                                                galleryImages[{{ $realEstate->id }}] = tempImages;
                                        </script>

                                    <!-- Thumbnail {{ $key }} Start -->
                                        <div class="thumbnail_one mb_30">
                                            <div class="image_area overlay_one overfollow">
                                                <img src="{{ $realEstate->getPublicListImage() }}" alt=""
                                                     style="min-height: 300px;">
                                                @if ($realEstate->web_status_enum == \App\Models\Enum\RealEstateWebStatusEnum::kiemelt)
                                                    <div class="Featured"
                                                         style="background-color: {{ $TagFeaturedBackgroundColor }}; color: {{ $TagFeaturedForegroundColor }};">@lang('public.featured_properties_card_ribbon_caption')</div>
                                                @endif
                                                <div class="sale sale_position bg-primary"
                                                     style="background-color: {{$TagContractTypeBackgroundColor}} !important; color: {{$TagContractTypeForegroundColor}}">
                                                    {{ $realEstate->getContractTypeCaption() }}
                                                </div>
                                                <div class="area_price price_position"
                                                     style="color: {{$TagPriceForegroundColor}}">{{ $realEstate->getPublicOfferPrice() }}
                                                    <span>{{ $realEstate->getPublicSquareMeterPrice() }} / m<sup>2</sup></span>
                                                </div>
                                            </div>
                                            <div class="thum_one_content">
                                                <div class="thum_title color-secondery">
                                                    <h5 class="hover_primary"><a
                                                                href="{{ route('realEstatePublicDatapage', $realEstate) }}">{{ $realEstate->getPublicName() }}</a>
                                                    </h5>
                                                    @if ($realEstate->getPublicLocation() !== '')
                                                        <p><i class="fas fa-map-marker"
                                                              aria-hidden="true"></i> {{ $realEstate->getPublicLocation() }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="thum_data bg-gray mt_15">
                                                    <ul>
                                                        @if(!is_null($realEstate->base_area_gross))
                                                            <li>@lang('public.real_estate_base_area_gross_label'):
                                                                <span>{{ $realEstate->base_area_gross }} m<sup>2</sup></span>
                                                            </li>
                                                        @endif
                                                        @if(!is_null($realEstate->number_levels))
                                                            <li>
                                                                @lang('public.real_estate_number_levels_label'):
                                                                <span>{{ $realEstate->number_levels }}</span>
                                                            </li>
                                                        @endif
                                                        @if(!is_null($realEstate->number_bedroom))
                                                            <li>
                                                                @lang('public.real_estate_number_bedroom_label'):
                                                                <span>{{ $realEstate->number_bedroom }}</span>
                                                            </li>
                                                        @endif
                                                        @if(!is_null($realEstate->number_bath) || !is_null($realEstate->number_shower))
                                                            <li>
                                                                @lang('public.real_estate_number_bath_label'):
                                                                <span>{{ $realEstate->number_bath + $realEstate->number_shower }}</span>
                                                            </li>
                                                        @endif
                                                        @if(!is_null($realEstate->number_garage))
                                                            <li>
                                                                @lang('public.real_estate_number_garage_label'):
                                                                <span>{{ $realEstate->number_garage }}</span>
                                                            </li>
                                                        @endif
                                                        @if(!is_null($realEstate->terrace_size))
                                                            <li>
                                                                @lang('public.real_estate_terrace_size_label'):
                                                                <span>{{ $realEstate->terrace_size }} m<sup>2</sup></span>
                                                            </li>
                                                        @endif
                                                        @if(!is_null($realEstate->real_estate_kitchen_type_enum))
                                                            <li>
                                                                @lang('public.real_estate_kitchen_type_label'):
                                                                <span>{{ RealEstateKitchenTypeEnum::getDescription($realEstate->real_estate_kitchen_type_enum) }}</span>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="ft_area p_20 d-none-lg d-xs-block"
                                                     style="padding-top: 10px;">

                                                    {{--                                            <div class="post_author">--}}
                                                    {{--                                                <i class="fas fa-user" aria-hidden="true"></i> {{ ($realEstate->getPublicCreatedByName() != null) ? $realEstate->getPublicCreatedByName() : __('public.real_estate_unknown_uploader_label') }}--}}
                                                    {{--                                            </div>--}}
                                                    <div class="post_date float-right">
                                                        {{--                                                <i class="fas fa-calendar-o" aria-hidden="true"></i> {{ ($realEstate->getPublicCreatedAt() != null) ? $realEstate->getPublicCreatedAt() : __('public.real_estate_unknown_upload_time_label') }}--}}
                                                        {{--                                                <br>--}}
                                                        <div class="float-right">
                                                            @if(count($realEstate->getPublicDatapageGalleryImages()) > 0)
                                                                <a href="#"
                                                                   onclick="showLightboxGallery({{ $realEstate->id }}); return false;">
                                                                    <i class="fas fa-image"
                                                                       title="@lang('public.real_estate_gallery_title')"></i>
                                                                </a>
                                                            @else
                                                                <i class="fas fa-image" style="color: #ccc;"
                                                                   title="@lang('public.real_estate_gallery_title')"></i>
                                                            @endif
                                                            <a href="http://www.facebook.com/sharer.php?u={{ urlencode(route('realEstatePublicDatapage', $realEstate)) }}"
                                                               target="_blank"><i class="fab fa-facebook"
                                                                                  title="share"></i></a>
                                                            {{--                                                    <a href="#"><i class="fab fa-twitter" title="share"></i></a>--}}
                                                                @if (Auth::user() != null && Auth::user()->hasRole('clients'))
                                                                    <a href="#"
                                                                       onclick="favoriteRealEstateClick({{$realEstate->id}}, this);return false;"
                                                                       data-activecolor="orange"
                                                                       data-inactivecolor="white"
                                                                       title="@lang('public.real_estate_favorite_star_title')"
                                                                       @if ($realEstate->isFavoriteOfLoginedUser()) style="color: orange;"><i
                                                                                class="fas fa-star"
                                                                                aria-hidden="true"></i>
                                                                       @else style="color: white;"><i
                                                                                class="far fa-star"
                                                                                aria-hidden="true"></i>
                                                                       @endif
                                                                    </a>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Thumbnail {{ $key }} End -->
                                    @endforeach
                                </div>

                                <nav aria-label="Page navigation" class="aligment d-table">
                                    <ul class="pagination mt_30">
                                        {{ $realEstates->appends($queryParams)->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="sidebar-widget">
                        <div class="main-title-two pb_60 color-primary">
                            <h4 class="title">@lang('public.list_search_panel_title')</h4>
                        </div>
                        <form class="form3 formicon" method="get" action="{{ route('realEstatePublicList') }}">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg-gray" name="real_estate_id"
{{--                                                   placeholder="@lang('public.min_area_placeholder')"--}}
                                                   placeholder="@lang('public.first_input_placeholder')"
                                                   value="{{$request->real_estate_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control bg-gray" name="contract_type">
                                            <option value="0">@lang('public.any_status_label')</option>
                                            @foreach ($contractTypeEnums as $key => $item)
                                                <option value="{{ $item->id }}" {{ ($queryParams['contract_type'] == $item->id) ? 'selected' : '' }}>{{ $item->caption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div id="typeMultiselect" class="form-group">
                                        <select class="form-control selectpicker bg-gray" name="type[]" data-live-search="true" multiple @if(isset($offerPage) && $offerPage != 0) disabled @endif>
                                            @foreach ($realEstateTypes as $item)
                                                <option value="{{$item->id}}"
                                                @if(isset($queryParams['type']))
                                                    {{ ( $queryParams['type'] == $item->id) ? 'selected' : '' }}
                                                @endif
                                                >{{ $item->translateOrDefault(App::getLocale())->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-gray" name="minarea"
                                               placeholder="@lang('public.min_area_placeholder')"
                                               value="{{$request->minarea}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-gray" name="maxarea"
                                               placeholder="@lang('public.max_area_placeholder')"
                                               value="{{$request->maxarea}}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-gray" name="number_bedroom_min"
                                               placeholder="@lang('public.min_number_bedroom_placeholder')"
                                               value="{{$request->number_bedroom_min}}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-gray" name="number_bedroom_max"
                                               placeholder="@lang('public.max_number_bedroom_placeholder')"
                                               value="{{$request->number_bedroom_max}}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div id="furnitureFront" class="form-group">
                                        <select class="form-control selectpicker bg-gray" name="furniture_enums[]" data-live-search="true" multiple>
                                            @foreach ($furnitureTypes as $item)
                                                <option value="{{$item->id}}"
                                                    @if(isset($queryParams['furniture_enums'])))
                                                        @foreach($queryParams['furniture_enums'] as $queryItem)
                                                            {{ ($queryItem == $item->id) ? 'selected' : '' }}
                                                        @endforeach
                                                    @endif
                                                >{{$item->caption}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--

                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="number_bedroom">@lang('public.real_estate_list_number_bedroom_label') :</label>
                                                                    <input type="text" class="form-control bg-gray" name="number_bedroom" placeholder="@lang('public.number_bedroom_placeholder')" value="{{$request->number_bedroom}}">
                                                                </div>
                                                            </div>
                                --}}

                                <div class="col-md-12 col-lg-12" id="locationSelectorApp">
                                    <label for="locationSelectorApp">@lang('public.real_estate_list_location_label')
                                        :</label>
                                    <location-selector
                                            @if (!empty($queryParams['location_area_id'])) :data-selected-area="{{ json_encode($areaNameArray) }}"
                                            @endif
                                            @if (!empty($queryParams['location_town_district_id'])) :data-selected-town-district="{{ json_encode($townDistrictNameArray) }}"
                                            @endif
                                            @if (!empty($queryParams['location_neighborhood_id'])) :data-selected-neighborhood="{{ json_encode($neighborhoodNameArray) }}"
                                            @endif
                                            data-column-class="col-md-12 col-lg-12"
                                            data-area-class="form-control bg-gray"
                                            data-town-district-class="form-control bg-gray"
                                            data-town-neighborhood-class="form-control bg-gray"
                                    >
                                    </location-selector>
                                </div>

                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group my-4">
                                        <label for="price">@lang('public.real_estate_list_price_range_label') :</label>
                                        <div class="price_range mb_60">
                                            <div class="price-filter">
											<span class="price-slider">
												<input class="filter_price" type="text" name="price"
                                                       data-from="{{$priceFilterMin}}" data-to="{{$priceFilterMax}}"
                                                       value="{{ $priceFilterMin.';'.$priceFilterMax }}"/>
											</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="form-group mb_30">
                                                                    <label for="validationDefault05">Area Range :</label>
                                                                    <div class="layout-slider mb_60">
                                                                        <span><input id="Slider1" type="text" name="price" value="30000.5; 60000" /></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                --}}
                                <div class="col-md-12 col-lg-12">
                                    <p class="d-inline-block hover_gray mt-4">
                                        <a class="checkbox_collapse" data-toggle="collapse"
                                           href="#multiCollapseExample1" role="button"
                                           aria-expanded="false"
                                           aria-controls="multiCollapseExample1">@lang('public.real_estate_features_label')</a>
                                    </p>
                                    <div class="row">
                                        <div class="col">
                                            <div class="collapse" id="multiCollapseExample1">
                                                <div class="card card-body color-secondery px-0">
                                                    <div class="row">
                                                        @php $counter = 0; @endphp
                                                        @foreach(\App\Models\RealEstate::$features as $item)
                                                            @if ($counter%6 == 0)
                                                                <div class="col-lg-6">
                                                                    <ul class="check_submit">
                                                                        @endif
                                                                        <li>
                                                                            {{-- class="hide"  --}}
                                                                            <input id="feature_{{ $counter }}"
                                                                                   name="{{$item}}" class="hide"
                                                                                   type="checkbox"
                                                                                   value="1" {{ (old($item, $request->$item) == 1) ? 'checked' : '' }} >
                                                                            <label for="feature_{{ $counter }}">{{ __('messages.real_estates_datapage_'.$item.'_label') }}</label>
                                                                        </li>
                                                                        @php $counter++; @endphp
                                                                        @if ($counter%6 == 0)
                                                                    </ul>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                                @if ($counter%6 != 0)
                                                                </ul>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group mt_30">
                                    <button type="submit"
                                            class="btn btn-default1 w-100">@lang('public.search_property_button_label')</button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="sidebar-widget mt-5">
                    <div class="main-title-two pb_60 color-primary">
                        <h4 class="title">@lang('public.featured_property_text')</h4>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="owl-carousel featured_property">
                                @include('layouts.public.homex.inc.right_featured_properties')
                            </div>
                        </div>
                    </div>
                </div>
                {{--                <div class="sidebar-widget mt-5">--}}
                {{--                    <div class="main-title-two pb_60 color-primary">--}}
                {{--                        <h4 class="title">Recent Property</h4>--}}
                {{--                    </div>--}}
                {{--                    <div class="recent_property">--}}
                {{--                        <ul>--}}
                {{--                            <li class="property_item mb_30">--}}
                {{--                                <img src="{{ asset('images/no-pics/no-pic.jpg') }}" alt="">--}}
                {{--                                <div class="property_data">--}}
                {{--                                    <div class="thum_three_content bg-white color-secondery">--}}
                {{--                                        <div class="thum_title2 p-0 icon_default">--}}
                {{--                                            <h5 class="hover_primary"><a href="property_single_1.html">Nirala Appartment</a></h5>--}}
                {{--                                            {{-- <p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p> --}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <ul class="mt_10">--}}
                {{--                                        <li><h6 class="font-weight-bold">$1280 <sub>/ Mo</sub></h6></li>--}}
                {{--                                        <li>|</li>--}}
                {{--                                        <li>Housing</li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="property_item mb_30">--}}
                {{--                                <img src="{{ asset('images/no-pics/no-pic.jpg') }}" alt="">--}}
                {{--                                <div class="property_data">--}}
                {{--                                    <div class="thum_three_content bg-white color-secondery">--}}
                {{--                                        <div class="thum_title2 p-0 icon_default">--}}
                {{--                                            <h5 class="hover_primary"><a href="property_single_1.html">New Luxury Condos</a></h5>--}}
                {{--                                            {{-- <p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p> --}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <ul class="mt_10">--}}
                {{--                                        <li><h6 class="font-weight-bold">$1280 <sub>/ Mo</sub></h6></li>--}}
                {{--                                        <li>|</li>--}}
                {{--                                        <li>Housing</li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="property_item mb_30">--}}
                {{--                                <img src="{{ asset('images/no-pics/no-pic.jpg') }}" alt="">--}}
                {{--                                <div class="property_data">--}}
                {{--                                    <div class="thum_three_content bg-white color-secondery">--}}
                {{--                                        <div class="thum_title2 p-0 icon_default">--}}
                {{--                                            <h5 class="hover_primary"><a href="property_single_1.html">Zarafaloz Appartment</a></h5>--}}
                {{--                                            {{-- <p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p> --}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <ul class="mt_10">--}}
                {{--                                        <li><h6 class="font-weight-bold">$1280 <sub>/ Mo</sub></h6></li>--}}
                {{--                                        <li>|</li>--}}
                {{--                                        <li>Housing</li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                            <li class="property_item mb_30">--}}
                {{--                                <img src="{{ asset('images/no-pics/no-pic.jpg') }}" alt="">--}}
                {{--                                <div class="property_data">--}}
                {{--                                    <div class="thum_three_content bg-white color-secondery">--}}
                {{--                                        <div class="thum_title2 p-0 icon_default">--}}
                {{--                                            <h5 class="hover_primary"><a href="property_single_1.html">Monopuly Trade Center</a></h5>--}}
                {{--                                            {{-- <p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p> --}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                    <ul class="mt_10">--}}
                {{--                                        <li><h6 class="font-weight-bold">$1280 <sub>/ Mo</sub></h6></li>--}}
                {{--                                        <li>|</li>--}}
                {{--                                        <li>Housing</li>--}}
                {{--                                    </ul>--}}
                {{--                                </div>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </section>

    @include('layouts.public.homex.footer')

    <script type="text/javascript">
        //  képnézegető:
        function showLightboxGallery(id) {
            console.log(galleryImages[id]);
            //  kattintaskor beallitja hogy melyik image set -rol van szo:
            if (typeof galleryImages[id] !== "undefined") {
                window.imageGalleryApp.images = galleryImages[id];
                //  megjeleníti a lightbox nagyméretű képlapozót:
                //  imageGalleryApp.$refs.lightbox.showImage(0);
                window.imageGalleryApp.showImage(0);
            }
            return false;
        }

        function loadOrderedContent() {
            let url = new URL(window.location.href);
            url.searchParams.set('orderBy',$('#orderBy').val());
            window.location.href = url.href;
        }
    </script>

@endsection

