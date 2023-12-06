@php
    use App\Models\Client;
    use App\Models\enum\LanguageEnum;
    use App\Models\Enum\RealEstateOfferStatusEnum;
    use App\Models\RealEstateOffer;
    /**
    * @var RealEstateOffer $newRealEstateOffers
    * @var RealEstateOffer[] $realEstateOffers
    * @var Client[] $record
    * @var LanguageEnum[] $languages
    */
@endphp
<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0 float-left" style="padding: .75rem  1.25rem">
            @lang('messages.clients_datapage_view_offer_panel_title')
        </h5>
        @if(!is_null($realEstateOffers))
        <a href="{{ route('realEstateOffers.index', ['filter' => "client_id=" . $record->id]) }}"
           style="padding: .75rem  1.25rem;"
           class="btn btn-primary float-right">@lang('messages.clients_datapage_view_offer_panel_change_button')</a>
        @endif
        <form class="float-right" style="padding: 0 5px"  method="POST" action="{{route('realEstateOffers.store')}}">
            @csrf
            @method('POST')
            <input type="text" hidden name="name" value="{{ $record->name ." ". date("Y-m-d H:m") }}">
            <input type="text" hidden name="client_id" value="{{$record->id}}">
            <input type="text" hidden name="language_enum" value="{{$languages->value}}">
            <button style="padding: .75rem  1.25rem;" class="btn btn-primary" type="submit">@lang('messages.crud_new_offer_button_caption')</button>
        </form>
    </div>
    @if(!is_null($realEstateOffers))
        <div class="table-sm-responsive">
            <table id="table" class="table table-striped dataTables no-footer">
                <thead>
                <th scope="col" class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                <th scope="col" style="width:300px;">@lang('messages.real_estate_offers_list_name_column_caption')</th>
                <th scope="col"
                    style="width:300px;">@lang('messages.real_estate_offers_list_client_column_caption')</th>
                <th scope="col"
                    style="width:100px;">@lang('messages.real_estate_offers_list_status_column_caption')</th>
                <th scope="col">@lang('messages.real_estate_offers_list_realestates_column_caption')</th>

                </thead>
                <tbody>
                @foreach($realEstateOffers as $offer)
                    <tr>
                        <td style="text-align: center">
                            <div class="float-left" style="padding-top: 0.1rem; max-width: 50%">
                                <a href="{{ route('realEstateOffers.edit', $offer->id) }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </div>
                            <form class="float-right" method="post" action="{{ route('realEstateOffers.destroy') }}" style="max-width: 50%">
                                @csrf
                                @method('POST')
                                <input type="hidden"  name="offer_id" value="{{ $offer->id }}">
                                <input type="hidden"  name="referer" value="clientview">
                                <input type="hidden"  name="client_id" value="{{ $record->id }}">
                                <button style="padding-top: 0; padding-bottom: 0" type="submit" class="btn btn-link"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ RealEstateOfferStatusEnum::getDescription($offer->offer_status_enum) }}</td>
                        <td>
                            @foreach($offer->realEstates as $realEstate)
                                {{ $realEstate->code }}@if(!$loop->last),@endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


