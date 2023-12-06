@php
    use App\Models\Client
    /**
    * @var Client $record
    */
@endphp
<div class="row">
    <div class="col-12 accordion" id="leftSections">
        {{-- Ugyfel es Partner adatok --}}
        <div class="row">
            {{-- Ugyfel adatok --}}
            <div class="col-6">
                @include('Client.datapage.view.view-client-panel')
            </div>
            {{-- Partner adatok --}}
            <div class="col-6">
                @include('Client.datapage.view.view-partner-panel')
            </div>
        </div>
        {{-- Ugyfel ajanlatok --}}
        <div class="row">
            <div class="col-12">
                @include('Client.datapage.view.client-real-estate-offer-list-panel')
            </div>
        </div>
        {{-- Ugyfel igenyei --}}
        <div class="row">
            <div class="col-12">
                @include('Client.datapage.view.client-requirements-panel')
            </div>
        </div>
    </div>
</div>
