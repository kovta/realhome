@php
    /**
    * @var \App\Models\RealEstateOffer $record
    * @var \App\Models\enum\RealEstateOfferStatusEnum[] $statuses
    * @var \App\Models\Client[] $clients
    * @var \App\Models\Client[] $coWorkers
    * @var \App\Models\enum\LanguageEnum[] $languages
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.offers_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.offers_datapage_title_caption')</div>
        @if(session('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <ul>
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif

        @if(is_null($noClient))
            <div class="alert alert-warning" role="alert">
                @lang('messages.offer_sending_not_available')
            </div>
            <div class="tab-content">
                <div class="card admin-list-filterbox">
                    <div class="card-header" id="filter-heading">
                        <h5 class="mb-0">
                            @lang('messages.offers_datapage_panel_1_title_caption')
                        </h5>
                    </div>

                    <div id="filter-collapse" class="collapse show" aria-labelledby="filter-heading">
                        <div class="card-body">
                            <form action="{{ route('realEstateOffers.addClient.toOffer') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <div id="backendSearchableSelect" class="form-group">
                                            <label for="client_id" class="col-form-label col-form-label-sm">@lang('messages.offers_datapage_client_label')</label>
                                            <select class="form-control form-control-sm table-filter selectpicker" name="client_id" data-live-search="true">
                                                @foreach($clients as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="offerId" value="{{ $record->id }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="admin-filter-button-wrapper">
                                    <button class="btn btn-primary btn-sm">@lang('messages.button_save_caption')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="admin-toolbar">
            <a class="btn btn-secondary btn-sm"
               onclick="if ( !confirm('@lang('messages.crud_sure_confirm_text')') ) return false;"
               href="{{ route('realEstateOffers.clone', [$record->id]) }}">
                <i class="fas fa-clone"></i> @lang('messages.offers_datapage_clone_button_caption')
            </a>
            <a class="btn btn-secondary btn-sm" href="{{ route('realEstateOffers.printableDatapage', [$record->id, 0]) }}" target="_blank"><i class="fas fa-folder"></i> Adatlapok HTML</a>
            <a class="btn btn-secondary btn-sm" href="{{ route('realEstateOffers.printableDatapage', [$record->id, 1]) }}" target="_blank"><i class="fas fa-folder"></i> Adatlapok PDF</a>
            <a class="btn btn-secondary btn-sm"
               onclick="if ( !confirm('@lang('messages.crud_sure_confirm_text')') ) return false;"
               href="{{ route('realEstateOffers.createRouteFromOffer', [$record->id]) }}">
                <i class="fas fa-route"></i> @lang('messages.offers_datapage_createRouteFromOffer_button_caption')
            </a>
            <a class="btn btn-secondary btn-sm @if(is_null($noClient)) disabled @endif" href="{{ route('realEstateOffers.sendmailPage', [$record->id]) }}"><i class="fas fa-paper-plane"></i> Kiküldés</a>
        </div>

        <form method="POST" action="{{route('realEstateOffers.update', [$record->id])}}">
            @csrf
            @method('PUT')

            <div class="row" style="margin-bottom: 20px;">
                <input style="margin-right: 1rem" type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
                @if(!is_null($record->client_id))
                    <a class="btn btn-primary" href="{{ route('clients.view', [$record->client_id]) }}">@lang('messages.offers_datapage_realestates_redirect_client_offer_list_label')</a>
                @else
                    <a class="btn btn-primary" href="{{ route('realEstateOffers.index') }}">@lang('messages.offers_datapage_realestates_redirect_offers_list_label')</a>
                @endif
            </div>

            @include('RealEstateOffer.datapage.datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>


    </div>
@endsection

