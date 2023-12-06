@php
    use App\Models\Enum\RealEstateContractTypeEnum;
    use App\Models\Enum\RealEstateKitchenTypeEnum;
    use App\Models\Enum\RealEstateOrientationEnum;
    /**
    * @var \App\Models\Route $route
    * @var string $locale
    */

    $alphas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
@endphp
<div style="margin:5mm 8mm 4mm 8mm; padding:2mm 4mm; border: 2px solid #20ed20; background-color: #e4fdd6;">
    <table class="greentable">
        <tr>
            <td style="width: 40%">
                <b>@lang('offerpdf.Város'): </b> @if (!empty($item->locationArea)) {{ $item->locationArea->name }} @else - @endif
            </td>
            <td style="width: 28%">
                <b>@lang('offerpdf.Kerület'): </b> @if (!empty($item->locationTownDistrict)) {{ $item->locationTownDistrict->name }} @else - @endif </p>
            </td>
            <td style="width: 28%">
                @if($realestateoffer->street_address_included === 1)
                    <b>@lang('offerpdf.Utcanév'): </b>
                    @if (!empty($item->locationNeighborhood))
                        {{ $item->street_address_1 }}
                    @else
                        -
                    @endif
                @else
                    <b>@lang('offerpdf.Városrész'): </b>
                    @if (!empty($item->locationNeighborhood))
                        {{ $item->locationNeighborhood->name }}
                    @else
                        -
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <b>@lang('offerpdf.Ingatlan típus'): </b> @if (!empty($item->realEstateType)) {{ $item->realEstateType->getTranslation($locale)->name }} @else - @endif
            </td>
            <td>
                <b>@lang('offerpdf.Alapterület'): </b> @if (!empty($item->base_area_gross)) {{ $item->base_area_gross }} @else - @endif m<sup>2</sup>
            </td>
            <td>
                @if($item->contract_type_enum == RealEstateContractTypeEnum::elado)
                    <b>@lang('offerpdf.Irányár'): </b> @if (!empty($item->offer_price)) {{ number_format($item->offer_price, 0, ',', '.').' '.$item->currency->iso_code }} @else {{'- '.$item->currency->iso_code}} @endif
                @else
                    <b>@lang('offerpdf.Bérleti díj'): </b> @if (!empty($item->offer_price)) {{ number_format($item->offer_price, 0, ',', '.').' '.$item->currency->iso_code }} @else {{'- '.$item->currency->iso_code}} @endif
                @endif
            </td>
        </tr>
        <tr>
            <td>
                @if($item->realEstateType->real_estate_offer_pdf_green_box === 0)
                    <b>@lang('offerpdf.Építés éve'): </b> @if (!empty($item->build_year)) {{ $item->build_year }} @else - @endif
                @else
                    <b>@lang('offerpdf.Emelet'): </b> @if (!empty($item->number_levels)) {{ $item->number_levels }} @else - @endif
                @endif
            </td>
            <td>
                @if($item->realEstateType->real_estate_offer_pdf_green_box === 0)
                    <b>@lang('offerpdf.Felújítás éve'): </b> @if (!empty($item->renovation_year))  {{ $item->renovation_year }} @else - @endif
                @else
                    <b>@lang('offerpdf.Építés éve'): </b> @if (!empty($item->build_year))  {{ $item->build_year }} @else - @endif
                @endif
            </td>
            <td>
                @if($item->realEstateType->real_estate_offer_pdf_green_box === 0)
                    <b>@lang('offerpdf.Telekterület'): </b> @if (!empty($item->lot_size)) {{ $item->lot_size }} @else - @endif
                @else
                    <b>@lang('offerpdf.Felújítás éve'): </b> @if (!empty($item->renovation_year)) {{ $item->renovation_year }} @else - @endif
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <b>@lang('offerpdf.Hálószoba'): </b> @if (!empty($item->number_bedroom)) {{ $item->number_bedroom }} @else - @endif
            </td>
            <td>
                <b>@lang('offerpdf.Fürdő'): </b> @if (!empty($item->number_bath))  {{ $item->number_bath }} @else - @endif
            </td>
            <td>
                <b>@lang('offerpdf.Zuhany'): </b> @if (!empty($item->number_shower)) {{ $item->number_shower }} @else - @endif
            </td>
        </tr>
        <tr>
            <td>
                <b>@lang('offerpdf.Konyha'): </b> @if (!empty($item->real_estate_kitchen_type_enum)) {{ RealEstateKitchenTypeEnum::getDescription($item->real_estate_kitchen_type_enum) }} @else - @endif
            </td>
            <td>
                <b>@lang('offerpdf.Tájolás'): </b> @if (!empty($item->real_estate_orientation_enum)) {{ RealEstateOrientationEnum::getDescription($item->real_estate_orientation_enum) }} @else - @endif
            </td>
            <td>
                @if($item->realEstateType->real_estate_offer_pdf_green_box === 0)
                    <b>@lang('offerpdf.Garázs'): </b> @if (!empty($item->number_garage)) {{ $item->number_garage }} @else - @endif
                @else
                    <b>@lang('offerpdf.Terasz'): </b> @if (!empty($item->terrace) && ($item->terrace > 0)) Igen @else Nem @endif
                @endif
            </td>
        </tr>
    </table>
</div>
