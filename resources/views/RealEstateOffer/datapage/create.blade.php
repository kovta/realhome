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

        <form method="POST" action="{{route('realEstateOffers.new.store', [$record->id])}}">
            @csrf
            @method('POST')

            @include('RealEstateOffer.datapage.datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>


    </div>
@endsection
