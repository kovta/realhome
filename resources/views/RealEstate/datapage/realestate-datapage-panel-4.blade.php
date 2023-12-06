@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-4">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-4" aria-expanded="true" aria-controls="collapse-4">
                @lang('messages.real_estates_datapage_left_col_panel_4_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-4" class="collapse show" aria-labelledby="heading-4" data-parent="#leftSections">
        <div class="card-body">
            @php $counter = 0; @endphp
            @foreach(\App\Models\RealEstate::$features as $item)

                @if ($counter%4 == 0)
                <div class="col-12 row">
                @endif
                    <div class="form-check col-3">
                        <input class= "form-check-input" type="checkbox"  value="1"
                               {{ (old($item, $record->$item) == 1) ? 'checked' : '' }} id="{{$item}}" name="{{$item}}">
                        <label class="form-check-label" for="{{$item}}">{{ __('messages.real_estates_datapage_'.$item.'_label') }}</label>
                        @include('inc.field-error-message', ['fieldName' => $item])
                    </div>
                    @php $counter++; @endphp
                @if ($counter%4 == 0)
                </div>
                @endif
                @endforeach


        </div>
    </div>
</div>
