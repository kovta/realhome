@php
    /**
    * @var \App\Models\Client $record
    */
@endphp

            <div class="row">
                <div class="col-8 accordion" id="leftSections">
                    {{-- Alap adatok --}}
                    @include('Client.datapage.datapage-panel-1')
                    {{-- Szemelyes --}}
                    @include('Client.datapage.datapage-panel-3')
                </div>
{{--
                <div class="col-4 accordion" id="rightSections">
                    @include('Client.datapage.datapage-panel-right-1')
                    <div class="card"></div>
                </div>
--}}
            </div>
