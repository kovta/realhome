@php
    /**
    * @var TextContentPage $record
    * @var RealEstateType $realEstateTypes
    */
    use App\Models\RealEstateType;
    use App\Models\TextContentPage;
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.special_offer_pages_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.special_offer_pages_datapage_title_caption')</div>

        <form method="POST" action="{{route('specialOfferPages.update', [$record->id])}}">
            @csrf
            @method('PUT')

            @include('SpecialOfferPage.datapage.datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>
    </div>

@endsection
