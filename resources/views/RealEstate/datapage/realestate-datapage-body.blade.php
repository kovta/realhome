@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

            <div class="row">
                <div class="col-8 accordion" id="leftSections">
                    @include('RealEstate.datapage.realestate-datapage-panel-1')
                    @include('RealEstate.datapage.realestate-datapage-panel-2')
                    @include('RealEstate.datapage.realestate-datapage-panel-3')
                    @include('RealEstate.datapage.realestate-datapage-panel-4')
                    @include('RealEstate.datapage.realestate-datapage-panel-5')
                    @include('RealEstate.datapage.realestate-datapage-panel-6')
                    @include('RealEstate.datapage.realestate-datapage-panel-7')
                    @include('RealEstate.datapage.realestate-datapage-panel-8')
                </div>

                <div class="col-4 accordion" id="rightSections">
                    @include('RealEstate.datapage.realestate-datapage-panel-right-1')
                    @include('RealEstate.datapage.realestate-datapage-panel-right-2')
                    @include('RealEstate.datapage.realestate-datapage-panel-right-3')
                    <div class="card"></div>
                </div>
            </div>

