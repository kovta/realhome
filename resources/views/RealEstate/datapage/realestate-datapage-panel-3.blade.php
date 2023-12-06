@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-3">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                @lang('messages.real_estates_datapage_left_col_panel_3_caption')
            </button>
        </h5>
    </div>
    <div id="collapse-3" class="collapse show" aria-labelledby="heading-3" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
{{--
                <div class="col-4">
                    <div class="form-group">
                        <label></label>
                        <div class="form-check" style="margin-top: 17px;">
                            <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'utilities'])" type="checkbox"
                                   {{ (old('utilities', $record->utilities) == 1) ? 'checked' : '' }} value="1" id="utilities" name="utilities">
                            <label class="form-check-label" for="utilities">@lang('messages.real_estates_datapage_utilities_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'utilities'])
                        </div>
                    </div>
                </div>
--}}
                <div class="col-4">
                    <div class="form-group">
                        <label for="real_estate_heating_type_enum" class="col-form-label">@lang('messages.real_estates_datapage_heating_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_heating_type_enum'])" name="real_estate_heating_type_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($heatingTypes as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_heating_type_enum'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="base_area_gross" class="col-form-label">@lang('messages.real_estates_datapage_base_area_gross_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'base_area_gross'])" name="base_area_gross" value="{{ old('base_area_gross', $record->base_area_gross) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'base_area_gross'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_levels" class="col-form-label">@lang('messages.real_estates_datapage_number_levels_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_levels'])" name="number_levels" value="{{ old('number_levels', $record->number_levels) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_levels'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="living_room_size" class="col-form-label">@lang('messages.real_estates_datapage_living_room_size_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'living_room_size'])" name="living_room_size" value="{{ old('living_room_size', $record->living_room_size) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'living_room_size'])
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="base_area_net" class="col-form-label">@lang('messages.real_estates_datapage_base_area_net_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'base_area_net'])" name="base_area_net" value="{{ old('base_area_net', $record->base_area_net) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'base_area_net'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_bedroom" class="col-form-label">@lang('messages.real_estates_datapage_number_bedroom_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom'])" name="number_bedroom" value="{{old('number_bedroom', $record->number_bedroom) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="real_estate_kitchen_type_enum" class="col-form-label">@lang('messages.real_estates_datapage_kitchen_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_kitchen_type_enum'])" name="real_estate_kitchen_type_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($kitchenTypes as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_kitchen_type_enum'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="real_estate_furniture_enum" class="col-form-label">@lang('messages.real_estates_datapage_furniture_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_furniture_enum'])" name="real_estate_furniture_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($furnitures as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_furniture_enum'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_bath" class="col-form-label">@lang('messages.real_estates_datapage_number_bath_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bath'])" name="number_bath" value="{{ old('number_bath', $record->number_bath) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bath'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_shower" class="col-form-label">@lang('messages.real_estates_datapage_number_shower_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_shower'])" name="number_shower" value="{{ old('number_shower', $record->number_shower) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_shower'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_wc" class="col-form-label">@lang('messages.real_estates_datapage_number_wc_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_wc'])" name="number_wc" value="{{ old('number_wc', $record->number_wc) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_wc'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_garage" class="col-form-label">@lang('messages.real_estates_datapage_number_garage_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_garage'])" name="number_garage" value="{{ old('number_garage', $record->number_garage) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_garage'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="number_parking" class="col-form-label">@lang('messages.real_estates_datapage_number_parking_label')</label>
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_parking'])" name="number_parking" value="{{ old('number_parking', $record->number_parking) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_parking'])
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-4">
                    <div class="form-check" style="margin: 7px;">
                        <input class="form-check-input" type="checkbox"{{ (old('balcony', $record->balcony) == 1) ? 'checked' : '' }} value="1" id="balcony" name="balcony">
                        <label class="form-check-label" for="balcony">@lang('messages.real_estates_datapage_balcony_label')</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'balcony_size'])" name="balcony_size"
                               value="{{ old('balcony_size', $record->balcony_size) }}" placeholder="@lang('messages.real_estates_datapage_balcony_size_label')">
                        <div class="input-group-append">
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                        @include('inc.field-error-message', ['fieldName' => 'balcony_size'])
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-check" style="margin: 7px;">
                        <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'terrace'])" type="checkbox" value="1"
                               {{ (old('terrace', $record->terrace) == 1) ? 'checked' : '' }} id="terrace" name="terrace">
                        <label class="form-check-label" for="terrace">@lang('messages.real_estates_datapage_terrace_label')</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'terrace_size'])" name="terrace_size"
                               value="{{ old('terrace_size', $record->terrace_size) }}" placeholder="@lang('messages.real_estates_datapage_terrace_size_label')">
                        <div class="input-group-append">
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                        @include('inc.field-error-message', ['fieldName' => 'terrace_size'])
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-check" style="margin: 7px;">
                        <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'roof_terrace'])" type="checkbox"
                               {{ (old('roof_terrace', $record->roof_terrace) == 1) ? 'checked' : '' }} value="1" id="roof_terrace" name="roof_terrace">
                        <label class="form-check-label" for="roof_terrace">@lang('messages.real_estates_datapage_roof_terrace_label')</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'roof_terrace_size'])" name="roof_terrace_size"
                               value="{{ old('roof_terrace_size', $record->roof_terrace_size) }}" placeholder="@lang('messages.real_estates_datapage_roof_terrace_size_label')">
                        <div class="input-group-append">
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                        @include('inc.field-error-message', ['fieldName' => 'roof_terrace_size'])
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
