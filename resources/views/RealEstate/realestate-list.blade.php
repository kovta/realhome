@php
    /**
    * @var integer $selectableItems
    * @var string nextRouteName
    * @var integer entityId

    * @var array $filters
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.real_estates_list_title_caption'))

@section('content')

<div class="admin-list-title">
@if ($selectableItems == 1)
    @lang('messages.list_title_caption_selection_prefix')
@endif
    @lang('messages.real_estates_list_title_caption')
</div>

<div class="admin-toolbar">
    <form id="sendSelectionForm" style="display: inline; margin: 0; padding: 0;" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="ids" name="ids">
    </form>
@if ($selectableItems == 1)
    <button class="btn btn-primary" id="selectionReadyButton">@lang('messages.crud_list_selection_is_ready_button_caption')</button>
@else
    <a class="btn btn-primary" href="{{route('realEstates.create')}}">@lang('messages.crud_new_real_estate_button_caption')</a>
@endif
</div>

{{--Filter--}}
<div class="card admin-list-filterbox">
{{--    Filter header--}}
    <div class="card-header" id="filter-heading">
        <h5 class="mb-0">
            <button class="btn btn-link" style="float: left;" type="button" data-toggle="collapse" data-target="#filter-collapse" aria-expanded="true" aria-controls="filter-collapse">
                @lang('messages.list_filterbox_title_caption'){{--{{ $numberOfFilters > 0 ? '('.$numberOfFilters.')' : '' }}--}}
            </button>
            <div class="admin-list-filterbox-summary">summary</div>
        </h5>
    </div>

    <div id="filter-collapse" class="collapse show" aria-labelledby="filter-heading">
        <div class="card-body">
            {{-- 1 sor --}}
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="kapcsolattartotulajdonosfilter" class="col-form-label col-form-label-sm">@lang('messages.real_estates_list_filter_kapcsolattarto_tulajdonos_label')</label>
                        <input type="text" class="form-control form-control-sm table-filter" name="kapcsolattartotulajdonosfilter" value="{{ $filters['kapcsolattartotulajdonosfilter'] }}">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="utcanevfilter" class="col-form-label col-form-label-sm">@lang('messages.real_estates_list_filter_locationStreet')</label>
                        <input type="text" class="form-control form-control-sm table-filter" name="utcanevfilter" value="{{ $filters['utcanevfilter'] }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="contract_type_enum" class="col-form-label col-form-label-sm">@lang('messages.real_estates_datapage_contract_type_label')</label>
                        <select class="form-control form-control-sm table-filter" name="contract_type_enum">
                            <option value="">@lang('public.any_status_label')</option>
                            @foreach ($contractTypeEnums as $key => $item)
                                <option value="{{ $item->id }}" {{$item->gui_selected}}>{{ $item->caption }}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'contract_type_enum'])
                        {{--
                        <label for="real_estate_type_id" class="col-form-label">@lang('messages.real_estates_datapage_real_estate_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_type_id'])" name="real_estate_type_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($real_estate_types as $item)
                                <option value="{{$item->id}}" @if (old('real_estate_type_id', $record->real_estate_type_id) == $item->id) selected @endif>{{$item->translateOrDefault()->name}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_type_id'])
                        --}}
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="real_estate_type_id" class="col-form-label col-form-label-sm">@lang('messages.real_estates_datapage_real_estate_type_label')</label>
                        <select class="form-control form-control-sm table-filter selectpicker" name="real_estate_type_id" data-live-search="true" multiple>
                            @foreach($realEstateTypes as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{ $item->translateOrDefault(App::getLocale())->name }}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'real_estate_type_id'])
                    </div>
                </div>
            </div>
            {{-- 2 sor --}}
            <div class="row" id="locationSelectorApp">
                <div class="col-2">
                <div class="form-group">
                    <label for="code" class="col-form-label col-form-label-sm">@lang('messages.real_estates_datapage_code_label')</label>
                    <input type="text" class="form-control form-control-sm table-filter" name="code" value="{{ $filters['code'] }}">
                </div>
            </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="status_enum" class="col-form-label col-form-label-sm">@lang('messages.real_estates_datapage_status_label')</label>
                        <select class="form-control form-control-sm table-filter" name="status_enum">
                            <option value="">@lang('public.any_status_label')</option>
                            @foreach ($statuses as $key => $item)
{{--                                @dd($key,$item)--}}
                                <option value="{{ $item->id }}" {{$item->gui_selected}}>{{ $item->caption }}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'status'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="kitchen_type_enums" class="col-form-label col-form-label-sm">@lang('messages.real_estates_datapage_kitchen_type_label')</label>
                        <select class="form-control form-control-sm table-filter selectpicker @include('inc.field-invalid-class', ['fieldName' => 'kitchen_type_enums'])" name="kitchen_type_enums" data-live-search="true" multiple>
                            @foreach($kitchenTypes as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'kitchen_type_enums'])
                    </div>
                </div>
                <div class="col-6">
                    <label for="locationSelectorApp" class="col-form-label col-form-label-sm">@lang('messages.real_estates_datapage_location_label')</label>
                    <location-selector
                            :data-selected-area="{{ json_encode($requestAreaNameArray) }}"
                            :data-selected-town-district="{{ json_encode($requestTownDistrictNameArray) }}"
                            :data-selected-neighborhood="{{ json_encode($requestNeighborhoodNameArray) }}"
                            data-column-class="col-sm-4"
                            data-area-class="form-control form-control-sm"
                            data-town-district-class="form-control form-control-sm"
                            data-town-neighborhood-class="form-control form-control-sm"
                            data-table-class="table-filter"
                    >
                    </location-selector>
                </div>
            </div>
            {{-- 3 sor --}}
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="price_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_price_min_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter currency @include('inc.field-invalid-class', ['fieldName' => 'price_min'])" name="price_min" value="{{$filters['price_min']}}">
                        @include('inc.field-error-message', ['fieldName' => 'price_min'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="price_max" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_price_max_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter currency @include('inc.field-invalid-class', ['fieldName' => 'price_max'])" name="price_max" value="{{$filters['price_max']}}">
                        @include('inc.field-error-message', ['fieldName' => 'price_max'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="price_currency_id" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_price_currency_label')</label>
                        <select class="form-control form-control-sm table-filter @include('inc.field-invalid-class', ['fieldName' => 'price_currency_id'])" name="price_currency_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($currencies as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $filters['price_currency_id']) ? 'selected' : '' }}>{{$item->iso_code}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'price_currency_id'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="build_year_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_build_year_min_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter @include('inc.field-invalid-class', ['fieldName' => 'build_year_min'])" name="build_year_min" value="{{$filters['build_year_min']}}">
                        @include('inc.field-error-message', ['fieldName' => 'build_year_min'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="build_year_max" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_build_year_max_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter @include('inc.field-invalid-class', ['fieldName' => 'build_year_max'])" name="build_year_max" value="{{$filters['build_year_max']}}">
                        @include('inc.field-error-message', ['fieldName' => 'build_year_max'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="score_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_score_min_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'score_min'])" name="score_min" value="{{$filters['score_min']}}">
                        @include('inc.field-error-message', ['fieldName' => 'score_min'])
                    </div>
                </div>
            </div>
            {{-- 4 sor --}}
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="gross_base_area_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_gross_base_area_min_label')</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'gross_base_area_min'])" name="gross_base_area_min" value="{{$filters['gross_base_area_min']}}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'gross_base_area_min'])
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="gross_base_area_max" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_gross_base_area_max_label')</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'gross_base_area_max'])" name="gross_base_area_max" value="{{$filters['gross_base_area_max']}}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'gross_base_area_max'])
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="livingroom_size_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_livingroom_size_min_label')</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'livingroom_size_min'])" name="livingroom_size_min" value="{{$filters['livingroom_size_min']}}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'livingroom_size_min'])
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="floor_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_floor_min_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'floor_min'])" name="floor_min" value="{{$filters['floor_min']}}">
                        @include('inc.field-error-message', ['fieldName' => 'floor_min'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="floor_max" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_floor_max_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'floor_max'])" name="floor_max" value="{{$filters['floor_max']}}">
                        @include('inc.field-error-message', ['fieldName' => 'floor_max'])
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'alarm_system'])" type="checkbox" value="{{($filters['alarm_system'] == null) ? '' : $filters['alarm_system']}}" id="alarm_system" name="alarm_system">
                            <label class="form-check-label" for="alarm_system">@lang('messages.real_estates_datapage_alarm_system_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'alarm_system'])
                        </div>
                    </div>
                </div>
            </div>
            {{-- 5 sor --}}
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="number_bedroom_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_number_bedroom_min_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom_min'])" name="number_bedroom_min" value="{{$filters['number_bedroom_min']}}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom_min'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="number_bedroom_max" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_number_bedroom_max_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom_max'])" name="number_bedroom_max" value="{{$filters['number_bedroom_max']}}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom_max'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="number_bath_min" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_number_bath_min_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bath_min'])" name="number_bath_min" value="{{$filters['number_bath_min']}}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bath_min'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="number_garage_plus_parking" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_number_garage_plus_parking_label')</label>
                        <input type="text" class= "form-control form-control-sm table-filter decimal @include('inc.field-invalid-class', ['fieldName' => 'number_garage_plus_parking'])" name="number_garage_plus_parking" value="{{$filters['number_garage_plus_parking']}}">
                        @include('inc.field-error-message', ['fieldName' => 'number_garage_plus_parking'])
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <label for="furniture_enums" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_furniture_label')</label>
                            <select class="form-control form-control-sm table-filter selectpicker @include('inc.field-invalid-class', ['fieldName' => 'furniture_enums'])" name="furniture_enums" data-live-search="true" multiple>
                                @foreach($furnitureTypes as $item)
                                    <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                                @endforeach
                            </select>
                            @include('inc.field-error-message', ['fieldName' => 'furniture_enums'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'garden'])" type="checkbox" value="{{($filters['garden'] == null) ? '' : $filters['garden']}}" id="garden" name="garden">
                            <label class="form-check-label" for="garden">@lang('messages.client_requirements_datapage_garden_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'garden'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'accessibility'])" type="checkbox" value="{{($filters['accessibility'] == null) ? '' : $filters['accessibility']}}" id="accessibility" name="accessibility">
                            <label class="form-check-label" for="accessibility">@lang('messages.real_estates_datapage_accessibility_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'accessibility'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'pet_allowed'])" type="checkbox" value="{{($filters['pet_allowed'] == null) ? '' : $filters['pet_allowed']}}" id="pet_allowed" name="pet_allowed">
                            <label class="form-check-label" for="pet_allowed">@lang('messages.real_estates_datapage_pet_allowed_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'pet_allowed'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'small_pet_allowed'])" type="checkbox" value="{{($filters['small_pet_allowed'] == null) ? '' : $filters['small_pet_allowed']}}" id="small_pet_allowed" name="small_pet_allowed">
                            <label class="form-check-label" for="small_pet_allowed">@lang('messages.real_estates_datapage_small_pet_allowed_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'small_pet_allowed'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'airconditioning'])" type="checkbox" value="{{($filters['airconditioning'] == null) ? '' : $filters['airconditioning']}}" id="airconditioning" name="airconditioning">
                            <label class="form-check-label" for="airconditioning">@lang('messages.real_estates_datapage_airconditioning_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'airconditioning'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'fireplace'])" type="checkbox" value="{{($filters['fireplace'] == null) ? '' : $filters['fireplace']}}" id="fireplace" name="fireplace">
                            <label class="form-check-label" for="fireplace">@lang('messages.real_estates_datapage_fireplace_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'fireplace'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'cabeltv'])" type="checkbox" value="{{($filters['cabeltv'] == null) ? '' : $filters['cabeltv']}}" id="cabeltv" name="cabeltv">
                            <label class="form-check-label" for="cabeltv">@lang('messages.real_estates_datapage_cabletv_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'cabeltv'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'satellite_system'])" type="checkbox"  value="{{($filters['satellite_system'] == null) ? '' : $filters['satellite_system']}}" id="satellite_system" name="satellite_system">
                            <label class="form-check-label" for="satellite_system">@lang('messages.real_estates_datapage_satellite_system_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'satellite_system'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'internet'])" type="checkbox" value="{{($filters['internet'] == null) ? '' : $filters['internet']}}" id="internet" name="internet">
                            <label class="form-check-label" for="internet">@lang('messages.client_requirements_datapage_internet_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'internet'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'security_service_24h'])" type="checkbox" value="{{($filters['security_service_24h'] == null) ? '' : $filters['security_service_24h']}}" id="security_service_24h" name="security_service_24h">
                            <label class="form-check-label" for="security_service_24h">@lang('messages.real_estates_datapage_security_service_24h_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'security_service_24h'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'indoor_pool'])" type="checkbox" value="{{($filters['indoor_pool'] == null) ? '' : $filters['indoor_pool']}}" id="indoor_pool" name="indoor_pool">
                            <label class="form-check-label" for="indoor_pool">@lang('messages.real_estates_datapage_indoor_pool_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'indoor_pool'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'outdoor_pool'])" type="checkbox" value="{{($filters['outdoor_pool'] == null) ? '' : $filters['outdoor_pool']}}" id="outdoor_pool" name="outdoor_pool">
                            <label class="form-check-label" for="outdoor_pool">@lang('messages.real_estates_datapage_outdoor_pool_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'outdoor_pool'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'jacuzzi'])" type="checkbox" value="{{($filters['jacuzzi'] == null) ? '' : $filters['jacuzzi']}}" id="jacuzzi" name="jacuzzi">
                            <label class="form-check-label" for="jacuzzi">@lang('messages.real_estates_datapage_jacuzzi_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'jacuzzi'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'sauna'])" type="checkbox"  value="{{($filters['sauna'] == null) ? '' : $filters['sauna']}}" id="sauna" name="sauna">
                            <label class="form-check-label" for="sauna">@lang('messages.real_estates_datapage_sauna_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'sauna'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'hobby_room_gim'])" type="checkbox" value="{{($filters['hobby_room_gim'] == null) ? '' : $filters['hobby_room_gim']}}" id="hobby_room_gim" name="hobby_room_gim">
                            <label class="form-check-label" for="hobby_room_gim">@lang('messages.real_estates_datapage_hobby_room_gim_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'hobby_room_gim'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'guest_apartment'])" type="checkbox" value="{{($filters['guest_apartment'] == null) ? '' : $filters['guest_apartment']}}" id="guest_apartment" name="guest_apartment">
                            <label class="form-check-label" for="guest_apartment">@lang('messages.real_estates_datapage_guest_apartment_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'guest_apartment'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'panoramic_view'])" type="checkbox" value="{{($filters['panoramic_view'] == null) ? '' : $filters['panoramic_view']}}" id="panoramic_view" name="panoramic_view">
                            <label class="form-check-label" for="panoramic_view">@lang('messages.real_estates_datapage_panoramic_view_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'panoramic_view'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'danube_view'])" type="checkbox" value="{{($filters['danube_view'] == null) ? '' : $filters['danube_view']}}" id="danube_view" name="danube_view">
                            <label class="form-check-label" for="danube_view">@lang('messages.real_estates_datapage_danube_view_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'danube_view'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'balcony'])" type="checkbox" value="{{($filters['balcony'] == null) ? '' : $filters['balcony']}}" id="balcony" name="balcony">
                            <label class="form-check-label" for="balcony">@lang('messages.real_estates_datapage_balcony_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'balcony'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'terrace'])" type="checkbox"  value="{{($filters['terrace'] == null) ? '' : $filters['terrace']}}" id="terrace" name="terrace">
                            <label class="form-check-label" for="terrace">@lang('messages.real_estates_datapage_terrace_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'terrace'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'roof_terrace'])" type="checkbox" value="{{($filters['roof_terrace'] == null) ? '' : $filters['roof_terrace']}}" id="roof_terrace" name="roof_terrace">
                            <label class="form-check-label" for="roof_terrace">@lang('messages.real_estates_datapage_roof_terrace_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'roof_terrace'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'winter_garden'])" type="checkbox" value="{{($filters['winter_garden'] == null) ? '' : $filters['winter_garden']}}" id="winter_garden" name="winter_garden">
                            <label class="form-check-label" for="winter_garden">@lang('messages.real_estates_datapage_winter_garden_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'winter_garden'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'irrigation'])" type="checkbox" value="{{($filters['irrigation'] == null) ? '' : $filters['irrigation']}}" id="irrigation" name="irrigation">
                            <label class="form-check-label" for="irrigation">@lang('messages.real_estates_datapage_irrigation_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'irrigation'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'en_suit_bathroom'])" type="checkbox" value="{{($filters['en_suit_bathroom'] == null) ? '' : $filters['en_suit_bathroom']}}" id="en_suit_bathroom" name="en_suit_bathroom">
                            <label class="form-check-label" for="en_suit_bathroom">@lang('messages.real_estates_datapage_en_suit_bathroom_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'en_suit_bathroom'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'laurdy'])" type="checkbox" value="{{($filters['laurdy'] == null) ? '' : $filters['laurdy']}}" id="laurdy" name="laurdy">
                            <label class="form-check-label" for="laurdy">@lang('messages.real_estates_datapage_laundry_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'laurdy'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'cellar'])" type="checkbox"  value="{{($filters['cellar'] == null) ? '' : $filters['cellar']}}" id="cellar" name="cellar">
                            <label class="form-check-label" for="cellar">@lang('messages.real_estates_datapage_cellar_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'cellar'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'hard_wood_flooring'])" type="checkbox" value="{{($filters['hard_wood_flooring'] == null) ? '' : $filters['hard_wood_flooring']}}" id="hard_wood_flooring" name="hard_wood_flooring">
                            <label class="form-check-label" for="hard_wood_flooring">@lang('messages.real_estates_datapage_hard_wood_flooring_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'hard_wood_flooring'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'floor_heating'])" type="checkbox" value="{{($filters['floor_heating'] == null) ? '' : $filters['floor_heating']}}" id="floor_heating" name="floor_heating">
                            <label class="form-check-label" for="floor_heating">@lang('messages.real_estates_datapage_floor_heating_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'floor_heating'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'high_ceiling'])" type="checkbox" value="{{($filters['high_ceiling'] == null) ? '' : $filters['high_ceiling']}}" id="high_ceiling" name="high_ceiling">
                            <label class="form-check-label" for="high_ceiling">@lang('messages.real_estates_datapage_high_ceiling_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'high_ceiling'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'central_vacuum_cleaner'])" type="checkbox" value="{{($filters['central_vacuum_cleaner'] == null) ? '' : $filters['central_vacuum_cleaner']}}" id="central_vacuum_cleaner" name="central_vacuum_cleaner">
                            <label class="form-check-label" for="central_vacuum_cleaner">@lang('messages.real_estates_datapage_central_vacuum_cleaner_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'central_vacuum_cleaner'])
                        </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 30px;">
                    <div class="form-group">
                        <div class="form-check form-control-sm">
                            <input class= "form-check-input three-states table-filter @include('inc.field-invalid-class', ['fieldName' => 'elevator'])" type="checkbox" value="{{($filters['elevator'] == null) ? '' : $filters['elevator']}}" id="elevator" name="elevator">
                            <label class="form-check-label" for="elevator">@lang('messages.real_estates_datapage_elevator_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'elevator'])
                        </div>
                    </div>
                </div>
            </div>
            {{-- Szuro gombok --}}
            <div class="admin-filter-button-wrapper">
                <button class="btn btn-secondary btn-sm" id="filterUpdateButton">@lang('messages.list_filterbox_filter_update_button_caption')</button>
                <a class="btn btn-secondary btn-sm" href="{{ route('realEstates.clearFilters') }}">@lang('messages.list_filterbox_filter_clear_button_caption') {{ $numberOfFilters > 0 ? '(!)' : '' }}</a>
            </div>
        </div>
    </div>
</div>

{{-- Szűrőkre való figyelmeztetés --}}
@if ($numberOfFilters > 0 )
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">Az alábbi listára szűrési feltételek vannak alkalmazva. (<a class="" href="{{ route('realEstates.clearFilters') }}">@lang('messages.list_filterbox_filter_clear_button_caption')</a>)</div>
        </div>
    </div>
@endif

<div class="admin-toolbar">
@if ($selectableItems != 1)
    <button style="margin-right: 30px;" id="createOfferFromSelectedItemsButton" class="btn btn-secondary btn-sm">@lang('messages.real_estates_list_create_offer_from_selection_button_caption')</button>
@endif
    <button class="btn btn-secondary btn-sm dt-button buttons-select-all" id="tableSelectAllButton">@lang('messages.list_select_all_caption')</button>
    <button class="btn btn-secondary btn-sm dt-button buttons-select-none" id="tableSelectNoneButton">@lang('messages.list_select_none_caption')</button>
</div>

<div id="imageGalleryApp">
    <lightbox :images="images" ref="lightbox" :show-caption="false" :show-light-box="false"></lightbox>
</div>

<table id="table" class="display" style="width:100%">
    <thead>
    <th></th>
    <th>@lang('messages.real_estates_list_image_column_caption')</th>
    <th class="admin-list-manage-colhead">@lang('messages.real_estates_list_id_column_caption')</th>
    <th>@lang('messages.locationneighborhoods_datapage_district_label')</th>
    <th>@lang('messages.routes_datapage_item_locationStreet-1_label')</th>
    <th>@lang('messages.routes_datapage_item_locationStreet-2_label')</th>
    <th>@lang('messages.real_estates_datapage_floor_label')</th>
    <th>  m<sup style='top: -0.5em'>2</sup></th>
    <th>@lang('messages.real_estates_list_offer_price_column_caption')</th>
    </thead>
    <tbody></tbody>
    <tfoot></tfoot>
</table>
<input type="hidden" id="h_tableFilterChanged" value="0">
@endsection

@section('javascript')
<script type="text/javascript">

    let table = null;

    function deleteRecordClick(id) {
        if ( !confirm('@lang('messages.crud_delete_confirm_text')') ) return;
        $.post('{{ route('realEstates.destroy') }}', { id: id } )
            .done(function (result) {
                console.log(result.message);
            })
            .fail(function () {
            })
            .always(function () {
                table.ajax.reload();
            });
    }

    function collectSelectedItemIds(event) {
        let ids = [];
        table.rows('.selected').data().each(function(item){
            ids.push(item.id);
        });
        console.log(ids);
        if (ids.length == 0) { alert('@lang('messages.crud_no_selection_warning_text')'); return false; }
        let idStr = ids.join(',');
        $('#ids').val(idStr);
        return idStr;
    }

    function createOfferFromSelectedItems() {
        if ( !confirm('@lang('messages.crud_sure_confirm_text')') ) return;
        $('#sendSelectionForm').attr('action', '{{ route('realEstateOffers.createWithItems') }}');
        $('#sendSelectionForm').submit();
    }

    $('#filterUpdateButton').on('click', function () {
        table.ajax.reload();
        $('#h_tableFilterChanged').val(0);
        $(this).blur();
    });

    let selectableItems = '{{ $selectableItems }}';

    $('#table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    });

    $('#sendSelectionForm').on( 'submit', function (event) {
        return collectSelectedItemIds(event);
    });

    $('#selectionReadyButton').on( 'click', function () {
        $('#sendSelectionForm').attr('action', '@if ($nextRouteName) {{ route($nextRouteName, [$entityId]) }} @endif');
        $('#sendSelectionForm').submit();
    });

    $('#createOfferFromSelectedItemsButton').on( 'click', function () {
        createOfferFromSelectedItems();
    });

    function initPopovers(){
        //console.log('table data done.');
        $('a[rel=popover]').popover({
            html: true,
            trigger: 'hover',
            placement: 'bottom',
            // a tartalmat a data-content adja
            //content: function(){return '<img src="..." />';}
        });
    }

    //  képnézegető:
    function showLightboxGallery(id) {
        //  NE írd át az egyenlőségjelet === -re, mert nem fog működni!
        filteredImageListById = table.data().toArray().filter(obj=>{ return Number(obj.id) === Number(id) });
        //  console.log(filteredImageListById);
        window.imageGalleryApp.images = filteredImageListById[0].gallery;
        //  megjeleníti a lightbox nagyméretű képlapozót:
        imageGalleryApp.$refs.lightbox.showImage(0);
        return false;
    }

    $(document).ready(function () {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            buttons: [
                'selectAll',
                'selectNone',
            ],
            select: {
                style: 'multi'
            },
            "language": {
                'url': '/lang/datatables/{{App::getLocale()}}.json',
                select: {
                    rows: {
                        _: ", ebből kijelölve %d sor."
                    }
                }
            },
            ajax: {
                url: '{{ route('realEstates.tabledata') }}',
                type: 'POST',
                data: function (data){
                    data['filter'] = {};
                    $('.table-filter').each(function(){
                        let $this = $(this);
                        let name = $this.attr('name');
                        let value = $this.val();
                        data['filter'][name] = value;
                    });
                    data['nextRouteName'] = '{{ $nextRouteName }}';
                    data['entityId'] = '{{ $entityId }}';
                    console.log('table query sent');
                }
            },
            drawCallback: function (settings){
              //console.log('aaaaaaaaaaa');
            },
            order: [[ 1, 'asc']],
            // lengthMenu: [1,10,20,100,1000],
            pageLength: 25,
            dom: "<'row'<'col-sm-12 col-md-6'l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            columns: [
                {
                    data: null,
                    name: null,
                    orderable: false,
                    searchable: false,
                    className: 'admin-list-manage-colcell',
                    'render': function(data,type,row){
                        let popoverInfo = (data['first_image'] != '') ? ' rel="popover" data-content="<img src=\''+data['first_image']+'\'>"'  :  'title="@lang('messages.crud_gallery_item_button_tooltip')"';
                        //  let galleryIcon = '<a class="btn btn-link" href="{{ route('filemanagerIndex') }}?lib=images&entityId='+data['id']+'&entityType={{ urlencode('\App\Models\RealEstate') }}" '+popoverInfo+'><i class="fas fa-images"></i></a>';
                        let cloneIcon = '<a class="btn btn-link" href="{{ route('realEstates.clone') }}?id='+data['id']+'" onclick="if ( !confirm(\'@lang('messages.crud_sure_confirm_text')\') ) return false;" title="@lang('messages.crud_clone_item_button_tooltip')"><i class="fas fa-clone"></i></a>';
                        let deleteIcon = '<a class="btn btn-link" href="#" onclick="deleteRecordClick('+data['id']+');return false;" title="@lang('messages.crud_delete_item_button_tooltip')"><i class="fas fa-trash"></i></a>';
                        //  return galleryIcon + cloneIcon + deleteIcon;
                        return cloneIcon + deleteIcon;
                    }
                },
                {   data: null,
                    name: 'gallery',
                    orderable: false,
                    'render': function(data,type,row) {
                        window.imageGalleryApp.images = [];
                        if (data !== null && typeof Object.values(data.gallery)[0] !== 'undefined') {
                            return '<a href="#" onclick="showLightboxGallery('+data.id+'); return false;"><img src="' + data.gallery[0]['thumb'] + '" alt="" width="120" height="120" /></a>';
                            //  ez a megoldás azért nem jó, mert a paramétert itt - a létrehozás miatt - string-re konvertálja, holott a paraméter obj lenne:
                            //  return '<img src="' + data.gallery[0]['thumb'] + '" alt="" width="120" height="120" onclick="showLightboxGallery('+data.gallery+');" />';
                        }
                        return '';
                    }
                },
                {
                    data: null,
                    name: 'code',
                    'render': function(data,type,row){
                        return '<a href="'+data['code_url']+'">'+data['code']+'</a>';
                    }
                },
                // Kerulet
                {
                    data: 'location_town_district_id',
                    name: 'location_town_district_id',
                    orderable: true,
                    searchable: false,
                },
                // Utca
                {
                    data: 'street_address',
                    name: 'street_address',
                    orderable: false,
                    searchable: false,
                },
                // hazszam
                {
                    data: 'street_address_2',
                    name: 'street_address_2',
                    orderable: false,
                    searchable: false,
                },
                // Emelet
                {
                    data: 'floor',
                    name: 'floor',
                    orderable: false,
                    searchable: false,
                },
                // negyzetmeter
                {
                    data: 'base_area_gross',
                    name: 'base_area_gross',
                    orderable: false,
                    searchable: false,
                },
                // Iranyar
                {   data: null,
                    name: 'offer_price',
                    'render': function(data,type,row){
                        const formatter = new Intl.NumberFormat('hu-HU', {
                            style: 'currency',
                            currency: data['price_currency_code'],
                            currencyDisplay: 'code',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        });
                        return formatter.format(data['offer_price']);
                    }
                },

            ]
        });

        /*
        table.on( 'user-select', function ( e, dt, type, cell, originalEvent ) {
            console.log('ok');
            //if ( $(originalEvent.target).index() === 0 ) {
                e.preventDefault();
            //}
        });
        */
        /*
        table.on('click', 'td', function(e){
            //  e.preventDefault();
            console.log('cccc');
        });
        */
        table.on('draw.dt', function(){
           //console.log('bbbbbbbb');
           initPopovers();
        });

        $('#tableSelectAllButton').on( 'click', function () {
            //  console.log('rows select called');
            table.rows().select();
            $(this).blur();
        });

        $('#tableSelectNoneButton').on( 'click', function () {
            //  console.log('rows deselect called');
            table.rows().deselect();
            $(this).blur();
        });


    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
@endsection
