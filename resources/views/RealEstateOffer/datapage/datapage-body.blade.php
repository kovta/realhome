@php
    /**
    * @var \App\Models\RealEstateOffer $record
    * @var \App\Models\enum\RealEstateOfferStatusEnum[] $statuses
    * @var \App\Models\Client[] $clients
    * @var \App\Models\Client[] $coWorkers
    * @var \App\Models\enum\LanguageEnum[] $languages
    */
@endphp

<div class="row">
    <div class="col-xl-12 col-lg-12 accordion" id="leftSections">
        @include('RealEstateOffer.datapage.datapage-panel-1')
        @if (!is_null($record->id))
            @include('RealEstateOffer.datapage.datapage-panel-2')
        @endif
    </div>
    <div class="col-xl-6 col-lg-12 accordion">
        @if (is_null($record->id))
            <ul class="nav nav-tabs">
                <li style="padding-right: 0.5rem" class="nav-item"><a class="btn btn-primary active" data-toggle="tab" href="#home">@lang('messages.offers_datapage_panel_client_title_caption')</a></li>
                <li class="nav-item"><a class="btn btn-primary" data-toggle="tab"  href="#menu1">@lang('messages.offers_datapage_panel_new_client_title_caption')</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active show">
                    @include('RealEstateOffer.datapage.create-select-user')
                </div>
                <div id="menu1" class="tab-pane fade">
                    @include('RealEstateOffer.datapage.create-with-user')
                </div>
            </div>
        @endif
    </div>
</div>

