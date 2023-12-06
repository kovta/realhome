@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-3">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="true" aria-controls="collapse-3">
                @lang('messages.client_requirements_datapage_panel_3_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-3" class="collapse show" aria-labelledby="heading-3" data-parent="#leftSections">
        <div class="card-body">

            @php $counter = 0; @endphp
            @foreach(\App\Models\ClientRequirement::$features as $item)
                @if ($counter%3 == 0)
                <div class="col-12 row">
                @endif
                <div class="form-check col-4">
                    <input class= "form-check-input three-states @include('inc.field-invalid-class', ['fieldName' => $item])" type="checkbox"  value="{{ old($item, $record->$item) }}" id="{{ $item }}" name="{{ $item }}">
                    <label class="form-check-label" for="{{ $item }}">{{ __('messages.real_estates_datapage_'.$item.'_label') }}</label>
                    @include('inc.field-error-message', ['fieldName' => $item])
                </div>
                @php $counter++; @endphp
                @if ($counter%3 == 0)
                </div>
                @endif
            @endforeach
            @if ($counter%3 != 0)
            </div>
            @endif

        </div>
    </div>
</div>
