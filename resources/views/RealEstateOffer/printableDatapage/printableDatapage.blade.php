@php
    /**
    * @var \App\Models\RealEstateOffer $offer
    * @var string $locale
    */

    $realEstate = $offer->realEstates[0];

@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Ajánlat adatlap')

@section('content')

    <div>
        <div style="float:left; display:inline; width: 50%; overflow-y: hidden;">
            <div style="width:230px; height:80px;">
                @if($realEstate->crop_logo_included === 1)
                    <img src="https://realhome.hu/images/logo/realhome.svg" style="width:235px; height:auto; margin-left:-7px; margin-top:-4px;"/>
                @endif
            </div>
        </div>
        <div style="float:left; display:inline;width: 50%; overflow-y: hidden;">
            <div style="margin-top:5px; margin-left:30%; height:75px; text-align:left; font-weight:300; font-size:13px;">
                @if($realEstate->crop_logo_included === 1)
                    1095 Budapest, Lechner Ödön fasor 2.<br/>
                    +36 70 335 8000, +36 1 335 8000<br/>
                    web: realhome.hu, email: info@realhome.hu
                @endif
            </div>
        </div>
        <div style="clear:left;"></div>
    </div>

    <div class="row">
        <div class="col-md-4"><h2>{{ $offer->realEstates[0]->marketing_name }}</h2></div>
        <div class="col-md-4 offset-md-4" style="text-align: right;"><h3>{{ $realEstate->code }}</h3></div>
    </div>


    <div class="row">
        <div class="col-12" style="border: 0px dotted grey; text-align: center; margin: 0; padding: 0;">
            @if ($realEstate->getFeaturedImage() != null)
            <img style="margin: 0; padding: 0; width: 100%;" src="{{ $realEstate->getFeaturedImage()->getUrl('printable-realestate-featured') }}">
            @endif
        </div>
    </div>

    <div class="lead">
        <div class="row">
            <div class="col-12">
                <h3>Tulajdonságok</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Település: {{ ($realEstate->locationArea) ? $realEstate->locationArea->name : '' }}</p>
            </div>
            <div class="col-4">
                <p>Kerület: {{ ($realEstate->locationTownDistrict) ? $realEstate->locationTownDistrict->name : '' }}</p>
            </div>
            <div class="col-4">
                <p>Városrész: {{ ($realEstate->locationNeighborhood) ? $realEstate->locationNeighborhood->name : '' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Alapterület: {{ $realEstate->base_area_gross }} m<sup>2</sup></p>
            </div>
            <div class="col-4">
                <p>Irányár: {{ $realEstate->offer_price }}</p>
            </div>
            <div class="col-4">
                <p>Építés éve: {{ $realEstate->build_year }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Felújítva: {{ $realEstate->renovation_year }}</p>
            </div>
            <div class="col-4">
                <p>Emeletek száma: {{ $realEstate->floor }}</p>
            </div>
            <div class="col-4">
                <p>Hálók száma: {{ $realEstate->number_bedroom }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Fürdők száma: {{ $realEstate->number_bath }}</p>
            </div>
            <div class="col-4">
                <p>Nappali alapterület: {{ $realEstate->living_room_size }} m<sup>2</sup></p>
            </div>
            <div class="col-4">
                <p>Konyha: {{ \App\Models\Enum\RealEstateKitchenTypeEnum::getDescription($realEstate->real_estate_kitchen_type_enum) }}</p>
            </div>
        </div>
    </div>

    @php
        $counter = 0;
    @endphp

    @if($realEstate->features !== null)
        @foreach($realEstate->features as $item)
            @if ($item == 1)
                @if ($counter%3 == 0)
                    <div class="row lead">
                    @php $counter++; @endphp
                @endif
                <div class="col-4">
                    <i class="fas fa-check"></i> {{ __('messages.real_estates_datapage_'.$item.'_label') }}
                </div>
                @if ($counter%3 == 0)
                    </div>
                @endif
            @endif
        @endforeach
    @endif

    <div class="row" style="margin-top: 50px;">
        <div class="{{ ($realEstate->getOtherImages() == null) ? 'col-12' : 'col-6' }}">
            <h3>Leírás</h3>
            <div class="lead">{!!  $realEstate->translate($locale)->description  !!}</div>
        </div>

        <div class="col-6">
            @if ($realEstate->getOtherImages() != null)
            <img style="margin: 10px; padding: 0; width: 100%;" src="{{ $realEstate->getOtherImages()->first()->getUrl('printable-realestate-thumb') }}">
            @endif
        </div>
    </div>


@if ($offer->one_page_limit != 1 && $realEstate->getOtherImages() != null)

    <div style="page-break-before: always;"></div>

    @php
        // tovabbi kepek ket oszlopban...
        $counter = 0;
    @endphp
    @foreach($realEstate->getOtherImages() as $image)

            @if ($counter%2 == 0)
            <div class="row">
            @endif
                <div class="col-6">
                    <img style="margin: 10px; padding: 0; width: 100%;" src="{{ $image->getUrl('printable-realestate-thumb') }}">
                </div>
                @php $counter++; @endphp
            @if ($counter%2 == 0)
                </div>
            @endif

    @endforeach

@endif

@endsection
