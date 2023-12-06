@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                @lang('messages.client_requirements_datapage_panel_1_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="status_enum" class="col-form-label">@lang('messages.client_requirements_datapage_status_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'status_enum'])" name="status_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($statuses as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'status_enum'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="contract_type_enum" class="col-form-label">@lang('messages.client_requirements_datapage_contract_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'contract_type_enum'])" name="contract_type_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($contract_types as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'contract_type_enum'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="real_estate_type_id" class="col-form-label">@lang('messages.client_requirements_datapage_real_estate_type_label')</label>
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
            <div class="" id="locationSelectorApp" >
                <label for="locationSelectorApp" class="col-form-label">@lang('messages.client_requirements_datapage_location_label')</label>
                <location-selector
                        data-empty-caption="@lang('messages.combobox_empty_caption')"
                        data-selected-area="{{ old('location_area_id', $record->location_area_id) }}"
                        data-selected-town-district="{{ old('location_town_district_id', $record->location_town_district_id) }}"
                        data-selected-neighborhood="{{ old('location_neighborhood_id', $record->location_neighborhood_id) }}"
                        data-selected-area-is-invalid="{{$errors->has('location_area_id')}}"
                        data-selected-town-district-is-invalid="{{$errors->has('location_town_district_id')}}"
                        data-selected-neighborhood-is-invalid="{{$errors->has('location_neighborhood_id')}}"
                >
                </location-selector>
            </div>

        </div>
    </div>
</div>
