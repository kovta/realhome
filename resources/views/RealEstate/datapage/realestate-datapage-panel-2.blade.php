@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-2">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                @lang('messages.real_estates_datapage_left_col_panel_2_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-2" class="collapse show" aria-labelledby="heading-2" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="real_estate_state_enum" class="col-form-label">@lang('messages.real_estates_datapage_state_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_state_enum'])" name="real_estate_state_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($states as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_state_enum'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="real_estate_type_id" class="col-form-label">@lang('messages.real_estates_datapage_real_estate_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_type_id'])" name="real_estate_type_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($real_estate_types as $item)
                                <option value="{{$item->id}}" @if (old('real_estate_type_id', $record->real_estate_type_id) == $item->id) selected @endif>{{$item->translateOrDefault()->name}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_type_id'])
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_garden_type_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_garden_type_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_garden_type_enum'])" name="real_estate_garden_type_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($gardenTypes as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_garden_type_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="garden_size" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_garden_size_label')</label>
                <div class="input-group col-sm-4">
                    <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'garden_size'])" name="garden_size" value="{{ old('garden_size', $record->garden_size) }}">
                    <div class="input-group-append">
                        <span class="input-group-text">m<sup>2</sup></span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'garden_size'])
                </div>
            </div>

            <div class="form-group row">
                <label for="lot_size" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_lot_size_label')</label>
                <div class="input-group col-sm-4">
                    <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'lot_size'])" name="lot_size" value="{{$record->lot_size}}">
                    <div class="input-group-append">
                        <span class="input-group-text">m<sup>2</sup></span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'lot_size'])
                </div>
            </div>

            {{-- sok-sok enum... --}}

            <div class="form-group row">
                <label for="real_estate_house_sub_type_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_house_sub_type_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_house_sub_type_enum'])" name="real_estate_house_sub_type_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($houseSubtypes as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_house_sub_type_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_retail_unit_location_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_retail_unit_location_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_retail_unit_location_enum'])" name="real_estate_retail_unit_location_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($unitLocations as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_retail_unit_location_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_office_location_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_office_location_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_office_location_enum'])" name="real_estate_office_location_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($officeLocations as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_office_location_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_warehouse_sub_type_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_warehouse_sub_type_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_warehouse_sub_type_enum'])" name="real_estate_warehouse_sub_type_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($wareHouseSubtypes as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_warehouse_sub_type_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_catering_sub_type_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_catering_sub_type_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_catering_sub_type_enum'])" name="real_estate_catering_sub_type_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($cateringSubtypes as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_catering_sub_type_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_industrial_sub_type_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_industrial_sub_type_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_industrial_enum'])" name="real_estate_industrial_sub_type_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($industrialSubtypes as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_industrial_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_agricultural_sub_type_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_agricultural_sub_type_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_agricultural_sub_type_enum'])" name="real_estate_agricultural_sub_type_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($agriculturalSubtypes as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_agricultural_sub_type_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_development_site_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_development_site_label')</label>
                <div class="col-sm-8">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_development_site_enum'])" name="real_estate_development_site_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($developmentSites as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_development_site_enum'])
                </div>
            </div>
            <div class="form-group row" id="locationSelectorApp" >
                <label for="real_estate_location" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_location_label')</label>
                <div class="col-sm-8">
{{--                    @dd($record)--}}
                    <location-selector
                            data-empty-caption="@lang('messages.combobox_empty_caption')"
                            :data-selected-area="{{ json_encode($selectedAreas, JSON_THROW_ON_ERROR) }}"
                            :data-selected-town-district="{{ json_encode($selectedTownDistrict, JSON_THROW_ON_ERROR) }}"
                            :data-selected-neighborhood="{{ json_encode($selectedNeighborhood, JSON_THROW_ON_ERROR) }}"
                            data-selected-area-is-invalid="{{$errors->has('location_area_id')}}"
                            data-selected-town-district-is-invalid="{{$errors->has('location_town_district_id')}}"
                            data-selected-neighborhood-is-invalid="{{$errors->has('location_neighborhood_id')}}"
                    >
                    </location-selector>
                </div>
            </div>

            <div class="form-group row">
                <label for="street_address_1" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_street_address_1_label')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'street_address_1'])" name="street_address_1" value="{{ old('street_address_1', $record->street_address_1) }}">
                    @include('inc.field-error-message', ['fieldName' => 'street_address_1'])
                </div>
            </div>

            <div class="form-group row">
                <label for="street_address_2" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_street_address_2_label')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'street_address_2'])" name="street_address_2" value="{{ old('street_address_2', $record->street_address_2) }}">
                    @include('inc.field-error-message', ['fieldName' => 'street_address_2'])
                </div>
            </div>

            <div class="form-group row">
                <label for="street_address_3" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_street_address_3_label')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'street_address_3'])" name="street_address_3" value="{{ old('street_address_3', $record->street_address_3) }}">
                    @include('inc.field-error-message', ['fieldName' => 'street_address_3'])
                </div>
            </div>

            <div class="form-group row">
                <label for="floor" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_floor_label')</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'floor'])" name="floor" value="{{ old('floor', $record->floor) }}">
                    @include('inc.field-error-message', ['fieldName' => 'floor'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_orientation_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_orientation_label')</label>
                <div class="col-sm-4">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_orientation_enum'])" name="real_estate_orientation_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($orientations as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_orientation_enum'])
                </div>
            </div>

            <div class="form-group row">
                <label for="real_estate_vista_enum" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_vista_label')</label>
                <div class="col-sm-4">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_vista_enum'])" name="real_estate_vista_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($vistas as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'real_estate_vista_enum'])
                </div>
            </div>

        </div>
    </div>
</div>
