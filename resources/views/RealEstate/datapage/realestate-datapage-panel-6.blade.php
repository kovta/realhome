@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-6">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-6" aria-expanded="true" aria-controls="collapse-6">
                @lang('messages.real_estates_datapage_left_col_panel_6_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-6" class="collapse show" aria-labelledby="heading-6" data-parent="#leftSections">
        <div class="card-body">

            <div class="form-group row">
                <label for="operation_fee" class="col-3 col-form-label">@lang('messages.real_estates_datapage_operation_fee_label')</label>
                <div class="input-group col-3">
                    <input type="text" class= "form-control currency @include('inc.field-invalid-class', ['fieldName' => 'operation_fee'])" name="operation_fee" value="{{ old('operation_fee', $record->operation_fee) }}">
                    <div class="input-group-append">
                        {{--
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'price_currency_id'])" name="price_currency_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($currencies as $item)
                                <option value="{{ $item->id }}" @if (old('price_currency_id', $record->price_currency_id) == $item->id) selected @endif>{{$item->iso_code}}</option>
                            @endforeach
                        </select>
                        --}}
                        <span class="input-group-text devisa devisaupdater">
                            {{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}
                        </span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'price_currency_id'])
                    @include('inc.field-error-message', ['fieldName' => 'operation_fee'])
                </div>
            </div>

            <div class="form-group row">
                <label for="common_area_mult" class="col-3 col-form-label">@lang('messages.real_estates_datapage_common_area_mult_label')</label>
                <div class="col-3">
                    <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'common_area_mult'])" name="common_area_mult" value="{{ old('common_area_mult', $record->common_area_mult) }}">
                    @include('inc.field-error-message', ['fieldName' => 'common_area_mult'])
                </div>
            </div>

            <div class="form-group row">
                <label for="common_charge" class="col-3 col-form-label">@lang('messages.real_estates_datapage_common_charge_label')</label>
                <div class="input-group col-3">
                    <input type="text" class= "form-control currency @include('inc.field-invalid-class', ['fieldName' => 'common_charge'])" name="common_charge" value="{{ old('common_charge', $record->common_charge) }}">
                    <div class="input-group-append">
                        {{-- ezt fixen kérték, nem állítható --}}
                        <span class="input-group-text devisa">HUF</span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'common_charge'])
                </div>
            </div>

        </div>
    </div>
</div>
