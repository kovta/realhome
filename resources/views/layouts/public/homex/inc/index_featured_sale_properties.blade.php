@php
    /**
    * @var \App\Models\RealEstate[] $featuredSaleRealEstates
    */
@endphp

@foreach ($featuredSaleRealEstates as $key => $realEstate)
    <div class="thumbnail_one mb_30">
        <div class="image_area overlay_one overfollow">
            <img src="{{ $realEstate->getPublicFeaturedImage('images/no-pics/no-pic.jpg') }}" alt="">
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
                    <a href="#" onclick="favoriteRealEstateClick({{$realEstate->id}}, this);return false;"
                       data-activecolor="orange" data-inactivecolor="white" title="@lang('public.real_estate_favorite_star_title')"
                       @if ($realEstate->isFavoriteOfLoginedUser()) style="color: orange;"><i class="fas fa-star" aria-hidden="true"></i>
                        @else style="color: white;"><i class="far fa-star" aria-hidden="true"></i>@endif
                    </a>
                @endif
            </div>
            {{--<div class="starmark starmark_position"><i class="far fa-star" aria-hidden="true"></i></div>--}}
        </div>
        <div class="thum_one_content">
            <div class="thum_title color-secondery">
                <h5 class="hover_primary"><a href="{{ route('realEstatePublicDatapage', $realEstate) }}">{{ $realEstate->getPublicName() }}</a></h5>
                @if ($realEstate->getPublicLocation() !== '')
                <p><i class="fas fa-map-marker" aria-hidden="true"></i> {{ $realEstate->getPublicLocation() }}</p>
                @endif
            </div>
            <div class="thum_data bg-gray mt_15">
                <ul>
                    <li><span>@if(!is_null($realEstate->base_area_gross)) {{ $realEstate->base_area_gross }} @else 0 @endif m<sup>2</sup></span> @lang('public.real_estate_base_area_gross_label')</li>
                    <li><span>@if(!is_null($realEstate->number_levels))  {{ $realEstate->number_levels }} @else 0 @endif</span> @lang('public.real_estate_number_levels_label')</li>
                    <li><span>@if(!is_null($realEstate->number_bedroom))  {{ $realEstate->number_bedroom }} @else 0 @endif</span> @lang('public.real_estate_number_bedroom_label')</li>
                    <li><span>{{ $realEstate->number_bath + $realEstate->number_shower }}</span> @lang('public.real_estate_number_bath_label')</li>
                    <li><span>@if(!is_null($realEstate->number_garage))  {{ $realEstate->number_garage }} @else 0 @endif</span> @lang('public.real_estate_number_garage_label')</li>
                    <li><span>@if(!is_null($realEstate->terrace_size))  {{ $realEstate->terrace_size }} @else 0 @endif m<sup>2</sup></span> @lang('public.real_estate_terrace_size_label')</li>
                    <li><span>{{ \App\Models\Enum\RealEstateKitchenTypeEnum::getDescription($realEstate->real_estate_kitchen_type_enum) }}</span> @lang('public.real_estate_kitchen_type_label')</li>
                </ul>
            </div>
            <div class="ft_area p_20">
{{--                <div class="post_author"><i class="fas fa-user" aria-hidden="true"></i> {{ ($realEstate->getPublicCreatedByName() != null) ? $realEstate->getPublicCreatedByName() : __('public.real_estate_unknown_uploader_label') }}</div>--}}
{{--                <div class="post_date float-right"><i class="fas fa-calendar-o" aria-hidden="true"></i> {{ ($realEstate->getPublicCreatedAt() != null) ? $realEstate->getPublicCreatedAt() : __('public.real_estate_unknown_upload_time_label') }}</div>--}}
            </div>
        </div>
    </div>
@endforeach
