@php
    /**
    * @var \App\Models\Route $record
    */
@endphp

<div class="row">
    <div class="col-xl-12 col-lg-12 accordion" id="leftSections">
        @include('Route.datapage.datapage-panel-1')
        @if ($record->id > 0)
            @include('Route.datapage.datapage-panel-2')
        @endif
    </div>
</div>

