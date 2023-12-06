
@extends('layouts.public.homex.base')

@section('htmlheader')
@endsection


@section('descendant-site')

@include('layouts.public.homex.header-four')

<!--	Banner
===============================================================-->
@if($admin)
    <div class="alert alert-danger" style="text-align: center" role="alert">
        @lang('public.error_text')
    </div>
@else
<div class="page-banner bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumbs color-secondery">
                    <ul>
                        <li class="hover_gray"><a href="/">Home</a></li>
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">@lang('public.mainmenu_my_favorites_label')</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">@lang('public.mainmenu_my_favorites_label')</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--	Property List and Grid
===============================================================-->
<section class="full-row">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-lg-12">
                <div class="main-title-two pb_60">
                    <h3 class="title color-primary">@lang('public.mainmenu_my_favorites_label')</h3>
                </div>
            </div>
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
                                                <select class="form-control bg-gray border-none">
                                                    <option>@lang('public.sorts_by_created_desc_label')</option>
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
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="list_item">
                            @foreach ($realEstates as $key => $realEstate)
                                <!-- Thumbnail {{ $key }} Start -->
                                    <div class="thumbnail_one mb_30">
                                        <div class="image_area overlay_one overfollow">
                                            <img src="{{ $realEstate->getPublicListImage() }}" alt="" style="min-height: 300px;">
                                            @if ($realEstate->web_status_enum == \App\Models\Enum\RealEstateWebStatusEnum::kiemelt)
                                                <div class="Featured" style="background-color: {{ $TagFeaturedBackgroundColor }}; color: {{ $TagFeaturedForegroundColor }};">@lang('public.featured_properties_card_ribbon_caption')</div>
                                            @endif
                                            <div class="sale sale_position bg-primary" style="background-color: {{$TagContractTypeBackgroundColor}} !important; color: {{$TagContractTypeForegroundColor}}">
                                                {{ $realEstate->getContractTypeCaption() }}
                                            </div>
                                            <div class="area_price price_position" style="color: {{$TagPriceForegroundColor}}">{{ $realEstate->getPublicOfferPrice() }}
                                                <span>{{ $realEstate->getPublicSquareMeterPrice() }} / m<sup>2</sup></span>
                                            </div>
                                            <div class="starmark starmark_position">
                                                @if (Auth::user() != null && Auth::user()->hasRole('clients'))
                                                    @if ($realEstate->isFavoriteOfLoginedUser())
                                                        <a href="#" onclick="favoriteRealEstateClick({{$realEstate->id}}, this);return false;" style="color: yellow;" title="@lang('public.real_estate_favorite_star_title')"><i class="fas fa-star" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="#" onclick="favoriteRealEstateClick({{$realEstate->id}}, this);return false;" style="color: #ffffff;" title="@lang('public.real_estate_favorite_star_title')"><i class="far fa-star" aria-hidden="true"></i></a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="thum_one_content">
                                            <div class="thum_title color-secondery">
                                                <h5 class="hover_primary"><a href="{{ route('realEstatePublicDatapage', $realEstate) }}">{{ $realEstate->getPublicName() }}</a></h5>
                                                <p><i class="fas fa-map-marker" aria-hidden="true"></i>{{ $realEstate->getPublicLocation() }}</p>
                                            </div>
                                            <div class="thum_data bg-gray mt_15">
                                                @include('layouts.public.homex.inc.important-realestate-data-row')
                                            </div>
                                            <div class="ft_area p_20 d-none-lg d-xs-block" style="padding-top: 10px;">
{{--                                                <div class="post_author">--}}
{{--                                                    <i class="fas fa-user" aria-hidden="true"></i> {{ ($realEstate->getPublicCreatedByName() != null) ? $realEstate->getPublicCreatedByName() : __('public.real_estate_unknown_uploader_label') }}--}}
{{--                                                </div>--}}

{{--                                                <div class="post_date float-right">--}}
{{--                                                    <i class="fas fa-calendar-o" aria-hidden="true"></i> {{ ($realEstate->getPublicCreatedAt() != null) ? $realEstate->getPublicCreatedAt() : __('public.real_estate_unknown_upload_time_label') }}--}}
{{--                                                    <br>--}}
{{--                                                    <div class="float-right">--}}
{{--                                                        <a href="#"><i class="fas fa-image" title="gallery"></i></a>--}}
{{--                                                        <a href="#"><i class="fab fa-facebook" title="share"></i></a>--}}
{{--                                                        <a href="#"><i class="fab fa-twitter" title="share"></i></a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
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

            </div>
        </div>
    </div>
</section>
@endif




@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
