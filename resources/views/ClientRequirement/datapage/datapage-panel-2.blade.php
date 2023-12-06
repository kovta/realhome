@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    * @var \App\Models\Enum\RealEstateKitchenTypeEnum[] $availableKitchenTypeEnums
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-2">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                @lang('messages.client_requirements_datapage_panel_2_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-2" class="collapse show" aria-labelledby="heading-2" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="price_min" class="col-form-label">@lang('messages.client_requirements_datapage_price_min_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'price_min'])" name="price_min" value="{{ old('price_min', $record->price_min) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">{{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}</span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'price_min'])
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="price_max" class="col-form-label">@lang('messages.client_requirements_datapage_price_max_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'price_max'])" name="price_max" value="{{ old('price_max', $record->price_max) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">{{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}</span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'price_max'])
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="price_currency_id" class="col-form-label">@lang('messages.client_requirements_datapage_price_currency_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'price_currency_id'])" name="price_currency_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($currencies as $item)
                                <option value="{{ $item->id }}" @if ($item->id == old('price_currency_id', $record->price_currency_id)) selected @endif>{{$item->iso_code}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'price_currency_id'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="build_year_min" class="col-form-label">@lang('messages.client_requirements_datapage_build_year_min_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'build_year_min'])" name="build_year_min" value="{{ old('build_year_min', $record->build_year_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'build_year_min'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="build_year_max" class="col-form-label">@lang('messages.client_requirements_datapage_build_year_max_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'build_year_max'])" name="build_year_max" value="{{ old('build_year_max', $record->build_year_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'build_year_max'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="score_min" class="col-form-label">@lang('messages.client_requirements_datapage_score_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'score_min'])" name="score_min" value="{{ old('score_min', $record->score_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'score_min'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="gross_base_area_min" class="col-form-label">@lang('messages.client_requirements_datapage_gross_base_area_min_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'gross_base_area_min'])" name="gross_base_area_min"
                                   value="{{ old('gross_base_area_min', $record->gross_base_area_min) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'gross_base_area_min'])
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="gross_base_area_max" class="col-form-label">@lang('messages.client_requirements_datapage_gross_base_area_max_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'gross_base_area_max'])" name="gross_base_area_max"
                                   value="{{ old('gross_base_area_max', $record->gross_base_area_max) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'gross_base_area_max'])
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="livingroom_size_min" class="col-form-label">@lang('messages.client_requirements_datapage_livingroom_size_min_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'livingroom_size_min'])" name="livingroom_size_min"
                                   value="{{ old('livingroom_size_min', $record->livingroom_size_min) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'livingroom_size_min'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="floor_min" class="col-form-label">@lang('messages.client_requirements_datapage_floor_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'floor_min'])" name="floor_min"
                               value="{{ old('floor_min', $record->floor_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'floor_min'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="floor_max" class="col-form-label">@lang('messages.client_requirements_datapage_floor_max_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'floor_max'])" name="floor_max"
                               value="{{ old('floor_max', $record->floor_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'floor_max'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_garage_plus_parking" class="col-form-label">@lang('messages.client_requirements_datapage_number_garage_plus_parking_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_garage_plus_parking'])" name="number_garage_plus_parking"
                               value="{{ old('number_garage_plus_parking', $record->number_garage_plus_parking) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_garage_plus_parking'])
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_bedroom_min" class="col-form-label">@lang('messages.client_requirements_datapage_number_bedroom_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom_min'])" name="number_bedroom_min"
                               value="{{ old('number_bedroom_min', $record->number_bedroom_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom_min'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_bedroom_max" class="col-form-label">@lang('messages.client_requirements_datapage_number_bedroom_max_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom_max'])" name="number_bedroom_max"
                               value="{{ old('number_bedroom_max', $record->number_bedroom_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom_max'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_bath_min" class="col-form-label">@lang('messages.client_requirements_datapage_number_bath_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bath_min'])" name="number_bath_min"
                               value="{{ old('number_bath_min', $record->number_bath_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bath_min'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="kitchen_type_enums" class="col-form-label">@lang('messages.real_estates_datapage_kitchen_type_label')</label>
                        <select class="form-control selectpicker @include('inc.field-invalid-class', ['fieldName' => 'kitchen_type_enums'])" name="kitchen_type_enums[]" data-live-search="true" multiple>
                            @foreach($kitchenTypes as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'kitchen_type_enums'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4" style="margin-top: 44px;">
                    <div class="form-group">
                        <div class="form-check">
                            <input class= "form-check-input three-states @include('inc.field-invalid-class', ['fieldName' => 'furniture'])" type="checkbox"
                                   value="{{(old('furniture', $record->furniture) == null) ? '' : $record->furniture}}" id="furniture" name="furniture">
                            <label class="form-check-label" for="furniture">@lang('messages.client_requirements_datapage_furniture_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'furniture'])
                        </div>
                    </div>
                </div>
                <div class="col-4" style="margin-top: 44px;">
                    <div class="form-group">
                        <div class="form-check">
                            <input class= "form-check-input three-states @include('inc.field-invalid-class', ['fieldName' => 'garden'])" type="checkbox"
                                   value="{{(old('garden', $record->garden) == null) ? '' : $record->garden}}" id="garden" name="garden">
                            <label class="form-check-label" for="garden">@lang('messages.client_requirements_datapage_garden_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'garden'])
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
