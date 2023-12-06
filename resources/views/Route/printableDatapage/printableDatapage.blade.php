@php
    use App\Models\Enum\ClientRequiredSchoolEnum;
    use App\Models\Enum\RealEstateStatusEnum;
    use App\Models\Enum\RealEstateKitchenTypeEnum;
    use App\Models\Enum\RealEstateFurnitureEnum;
    use App\Models\Enum\RealEstateGardenTypeEnum;
    /**
    * @var \App\Models\Route $route
    * @var string $locale
    */

    $alphas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
@endphp


@extends('PrintableDatapages.defaultprintable')
@section('title', 'Bemutató út adatlap')

@section('css-links')
<link href="{{ asset(mix('css/global/printable/datapage-routes.css')) }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid" {{-- style="border: 1px solid black;" --}}>

    {{-- fejléc rész --}}
    <div class="row" style="border: 1px solid black;">
        <div class="col-3">
            <img src="{{ asset('images/logo/realhome-logo01.png') }}" style="width: auto; height: auto;"/>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-4">
                    @if(!empty($route->date) || isset($route->date))
                        <b>{{ $route->date }}</b>
                    @else
                        <b> - </b>
                    @endif
                </div>
                <div class="col-4">
                    Találkozó:
                    @if(!empty($route->meeting_location) || isset($route->meeting_location))
                        <b>{{ $route->meeting_location }}</b>
                    @else
                        <b> - </b>
                    @endif
                </div>
                <div class="col-4">
                    @if(!empty($route->presenter->name) || isset($route->presenter->name))
                        <b>{{ $route->presenter->name }}</b>
                    @else
                        <b> - </b>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    Megjegyzés:
                    @if(!empty($route->comment))
                        <b>{{ $route->comment }}</b>
                    @else
                        <b> - </b>
                    @endif
                </div>
            </div>
        </div>
    </div>

@php $itemIndex = 0; @endphp
@foreach($route->routeComponents as $item)
{{--    @dd($route->client->name,$item->route->client,$item->client)--}}

    {{-- ügyfél- és kapcsolattartói adatok, elérhetőségek (FEJLÉC) --}}
    @if($loop->first)
    <div class="row" style="border-top:1px; border-left: 1px solid black; border-right: 1px solid black;">
        <div class="col-4">
            <ul class="list-unstyled">
                <li>Ügyfél név: <b>{{ $route->client->name ?? '-' }}</b></li>
                <li>Cégnév: <b>{{ $route->client->partner->partner_name ?? '-' }}</b></li>
                <li>Tel1: <b>{{ $route->client->phone_1 ?? '-' }}</b></li>
                <li>Tel2: <b>{{ $route->client->phone_2 ?? '-' }}</b></li>
                <li>E-mail: <b>{{ $route->client->email ?? '-' }}</b></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-unstyled">
                <li>Kapcsolattartó: <b>{{ $route->client->partner->contact_name ?? '-' }}</b></li>
                <li>Tel1: <b>{{ $route->client->partner->contact_phone_1 ?? '-' }}</b></li>
                <li>Tel2: <b>{{ $route->client->partner->contact_phone_2 ?? '-' }}</b></li>
                <li>E-mail: <b>{{ $route->client->partner->contact_email ?? '-' }}</b></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-unstyled">
                <li>Bérlők száma: <b>{{ $route->client->number_tenants ?? '-' }}</b></li>
                <li>Gyerekek száma: <b>{{ $route->client->number_children ?? '-' }}</b></li>
                <li>Gyerekek életkora: <b>{{ $route->client->children_age ?? '-' }}</b></li>
                <li>Iskola: <b>{{ !empty($route->client->required_school_enum) ? ClientRequiredSchoolEnum::getDescription($route->client->required_school_enum) : '-' }}</b></li>
                <li>Háziállat: <b>{{ $route->client->clientRequirement->pet_allowed ?? '-' }}</b></li>
            </ul>
        </div>
    </div>
    @endif
    <div class="row" style="border: 1px solid black;">
        {{-- bal oldali sáv, ABC-vel számsorozott  --}}
        <div class="col-2" style="border-right: 1px solid black;">
            <div class="real-estate-id">ID: <b>{{ $item->realEstate->code ?? '-'}}</b></div>
            <div class="real-estate-index"><b>{{ $alphas[$itemIndex] ?? '-'}}</b></div>
            <div class="real-estate-time"><b>{{ $item->visit_time ?? ''}}</b></div>
        </div>
        {{-- adatok listája  --}}
        <div class="col-10">
            {{-- cím, elhelyezkedés  --}}
            <div class="row">
                <div class="col-2">
                    Település: <b>{{ $item->realEstate->locationArea->name ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Kerület: <b>{{ $item->realEstate->locationTownDistrict->name ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Utca: <b>{{ $item->realEstate->street_address_1 ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Házszám: <b>{{ $item->realEstate->street_address_2 ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Em./Ajtó: <b>{{ $item->realEstate->street_address_3 ?? '-' }}</b>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row" style="border-bottom: 1px solid black;">
                <div class="col-2">
                    Pont: <b>{{ $item->realEstate->score ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Aktuális: <b>{{ !empty($item->realEstate->status_enum) ? RealEstateStatusEnum::getDescription($item->realEstate->status_enum) : '-'}}</b>
                </div>
                <div class="col-2">
                    Megbízás: <b>{{ !empty($item->realEstate->moveindate) ? __('messages.something_exists') : __('messages.something_not_exists') }}</b>
                </div>
                <div class="col-2">
                    Bekölt.: <b>{{ $item->realEstate->moveindate ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Csengő: <b>{{ $item->realEstate->owner_bell ?? '-' }}</b>
                </div>
                <div class="col-2">
                    Kulcs: <b>{{ !empty($item->realEstate->owner_keys) && $item->realEstate->owner_keys == 1 ? __('messages.yes') : __('messages.no') }}</b>
                </div>
{{--                <div class="col-2">--}}
{{--                    Helyrajzi sz.: <b><br>{{ $item->realEstate->place_number ?? '-' }}</b>--}}
{{--                </div>--}}
            </div>
            {{-- Kapcsolati adatok  --}}
            <div class="row">
                <div class="col-4">
                    Tulaj: <b>{{ $item->realEstate->owner_name ?? '-' }}</b>
                </div>
                <div class="col-4">
                    Tel1: <b>{{ $item->realEstate->owner_phone_1 ?? '-' }}</b>
                </div>
                <div class="col-4">
                    Tel2: <b>{{ $item->realEstate->owner_phone_2 ?? '-' }}</b>
                </div>
            </div>
            <div class="row" style="border-bottom: 1px solid black;">
                <div class="col-4">
                    Kapcs.tart: <b>{{ $item->realEstate->owner_contact_name ?? '-' }}</b>
                </div>
                <div class="col-4">
                    Tel1: <b>{{ $item->realEstate->owner_contact_phone ?? '-' }}</b>
                </div>
                <div class="col-4">
                    Tel2: <b>{{ $item->realEstate->owner_contact_phone_2 ?? '-' }}</b>
                </div>
            </div>
            {{-- Ingatlan adatok  --}}
            <div class="row">
                <div class="col-3">
                    Típus: <b>{{ !empty($item->realEstate->realEstateType->name) ? $item->realEstate->realEstateType->name : '-' }}</b>
                </div>
                <div class="col-3">
                    Alapterület: <b>{{ !empty($item->realEstate->base_area_gross) ? $item->realEstate->base_area_gross : '-'}}</b>
                </div>
                <div class="col-3">
                    Bruttó ár: <b>{{ !empty($item->realEstate->offer_price) ? number_format($item->realEstate->offer_price, 0, ',', '.').' '.$item->realEstate->currency->iso_code : '-'}}</b>
                </div>
                <div class="col-3">
                    Minimum ár: <b>{{ !empty($item->realEstate->limit_price) ? number_format($item->realEstate->limit_price, 0, ',', '.').' '.$item->realEstate->currency->iso_code : '-'}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Építve: <b>{{ !empty($item->realEstate->build_year) ? $item->realEstate->build_year : '-'}}</b>
                </div>
                <div class="col-3">
                    Felújítva: <b>{{ !empty($item->realEstate->renovation_year) ? $item->realEstate->renovation_year : '-'}}</b>
                </div>
                <div class="col-3">
                    Telek: <b>{{ !empty($item->realEstate->lot_size) ? $item->realEstate->lot_size : '-'}}</b>
                </div>
                <div class="col-3">
                    Háló: <b>{{ !empty($item->realEstate->number_bedroom) ? $item->realEstate->number_bedroom : '-'}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Szintek: <b>{{ !empty($item->realEstate->number_levels) ? $item->realEstate->number_levels : '-'}}</b>
                </div>
                <div class="col-3">
                    Közös ktsg.: <b>{{ !empty($item->realEstate->common_charge) ? number_format($item->realEstate->common_charge, 0, ',', '.').' HUF' : '-' }}</b>
                </div>
                <div class="col-3">
                    Nappali nm.: <b>{{ !empty($item->realEstate->living_room_size) ? $item->realEstate->living_room_size : '-'}}</b>
                </div>
                <div class="col-3">
                    Konyha: <b>{{ !empty($item->realEstate->real_estate_kitchen_type_enum) ? RealEstateKitchenTypeEnum::getDescription($item->realEstate->real_estate_kitchen_type_enum) : '-'}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Fürdő: <b>{{ !empty($item->realEstate->number_bath) ? $item->realEstate->number_bath : '-'}}</b>
                </div>
                <div class="col-3">
                    Zuhany: <b>{{ !empty($item->realEstate->number_shower) ? $item->realEstate->number_shower : '-'}}</b>
                </div>
                <div class="col-3">
                    WC: <b>{{ !empty($item->realEstate->number_wc) ? $item->realEstate->number_wc : '-'}}</b>
                </div>
                <div class="col-3">
                    Bútor: <b>{{ !empty($item->realEstate->real_estate_furniture_enum) ? RealEstateFurnitureEnum::getDescription($item->realEstate->real_estate_furniture_enum) : '-'}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    Kert: <b>{{ !empty($item->realEstate->real_estate_garden_type_enum) ? RealEstateGardenTypeEnum::getDescription($item->realEstate->real_estate_garden_type_enum) : '' }}</b>
                </div>
                <div class="col-3">
                    Kert nm.: <b>{{ !empty($item->realEstate->garden_size) ? $item->realEstate->garden_size : '-'}}</b>
                </div>
                <div class="col-3">
                    Garázs: <b>{{ !empty($item->realEstate->number_garage) ? $item->realEstate->number_garage : '-'}}</b>
                </div>
                <div class="col-3">
                    Beálló: <b>{{ !empty($item->realEstate->number_parking) ? $item->realEstate->number_parking : '-'}}</b>
                </div>
            </div>
            {{-- extrák lista --}}
            <div class="row">
                <div class="col-12">
                    Extrák: <b>{{ !empty($item->realEstate->getCommaSeparatedFeatureList()) ? $item->realEstate->getCommaSeparatedFeatureList() : '-'}}</b>
                </div>
            </div>
            {{-- Megjegyzések --}}
            <div class="row">
                <div class="col-12">
                    Megjegyzés: <b><br>{{ !empty($item->comment) ? $item->comment : '-'}}</b>
                </div>
            </div>
        </div>
    </div>
@php $itemIndex++; @endphp
@endforeach
    </div>
@endsection
