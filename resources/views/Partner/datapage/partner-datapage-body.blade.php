@php
    use App\Models\Partner;
    use App\Models\Enum\ClientPreferredContactEnum;
    /**
    * @var Partner $partner
    * @var ClientPreferredContactEnum $preferredContacts
    */
@endphp

            <div class="row">
                <div class="col-12 accordion" id="leftSections">
                    @include('Partner.datapage.datapage-panel-1')
                </div>
            </div>
