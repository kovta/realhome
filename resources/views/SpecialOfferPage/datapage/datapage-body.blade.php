@php
    /**
    * @var \App\Models\SpecialOfferPage $record
    * @var RealEstateType $realEstateTypes
    */
@endphp

<div class="row">
    <div class="col-xl-8 col-lg-12 accordion" id="leftSections">
        @include('SpecialOfferPage.datapage.datapage-panel-1')
        @include('SpecialOfferPage.datapage.datapage-panel-2')
    </div>
</div>

