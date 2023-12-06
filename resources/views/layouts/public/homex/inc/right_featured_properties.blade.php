@php
    /**
    * @var \App\Models\RealEstate[] $featuredRealEstates
    */
@endphp

@foreach ($featuredRealEstates as $key => $realEstate)

    <div class="thumbnail_three">
        <div class="image_area overlay_one overfollow">
            <img src="{{ asset('images/no-pics/no-pic.jpg') }}" alt="">
{{--            <img src="{{ $realEstate->getPublicFeaturedImage('images/no-pics/no-pic.jpg') }}" alt="">--}}
            @if ($realEstate->web_status_enum == \App\Models\Enum\RealEstateWebStatusEnum::kiemelt)
            <div class="Featured" style="background-color: {{ $TagFeaturedBackgroundColor }}; color: {{ $TagFeaturedForegroundColor }};">
                @lang('public.featured_properties_card_ribbon_caption')
            </div>
            @endif
            <div class="sale sale_position bg-primary">
                {{ $realEstate->getContractTypeCaption() }}
            </div>
            <div class="area_price price_position" style="color: {{$TagPriceForegroundColor}}">{{ $realEstate->getPublicOfferPrice() }}
                <span>{{ $realEstate->getPublicSquareMeterPrice() }} / m<sup>2</sup></span>
            </div>
            <div class="starmark starmark_position">
                @if (Auth::user() != null && Auth::user()->hasRole('clients'))
                <a href="#"
                   onclick="favoriteRealEstateClick({{$realEstate->id}}, this);return false;"
                   data-activecolor="orange"
                   data-inactivecolor="white"
                   title="@lang('public.real_estate_favorite_star_title')"
                    @if ($realEstate->isFavoriteOfLoginedUser())style="color: orange;"><i class="far fa-star" aria-hidden="true"></i>
                    @else style="color: white;"><i class="far fa-star" aria-hidden="true"></i>
                    @endif
                </a>
                @endif
            </div>
        </div>
        <div class="thum_three_content bg-white color-secondery">
            <div class="thum_title2 icon_default bg-gray">
                <h5 class="hover_primary"><a href="{{ route('realEstatePublicDatapage', $realEstate) }}">{{ $realEstate->getPublicName() }}</a></h5>
                {{-- <p><i class="fas fa-map-marker" aria-hidden="true"></i> Avenue South Burlington, Los Angles</p> --}}
            </div>
        </div>
    </div>
@endforeach
