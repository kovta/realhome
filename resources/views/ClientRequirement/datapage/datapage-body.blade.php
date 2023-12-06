@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    */
@endphp

            <div class="row">
                <div class="col-xl-8 col-lg-12 accordion" id="leftSections">
                    @include('ClientRequirement.datapage.datapage-panel-1')
                    @include('ClientRequirement.datapage.datapage-panel-2')
                    @include('ClientRequirement.datapage.datapage-panel-3')
                </div>
            </div>
