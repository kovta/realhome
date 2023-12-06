@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    */
@endphp

@extends('layouts.public.homex.base')

@section('htmlheader')
@endsection


@section('descendant-site')

@include('layouts.public.homex.header-four')

<!--	Banner
===============================================================-->
<div class="page-banner bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumbs color-secondery">
                    <ul>
                        <li class="hover_gray"><a href="#">Home</a></li>
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">@lang('public.mainmenu_user_requirements_label')</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">@lang('public.mainmenu_user_requirements_label')</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--	Content
===============================================================-->
<section class="full-row">
    <div class="container">


        <form action="{{ route('updateMyRequirements') }}" method="post">
            @csrf
            @method('PUT')

            <div class="main-title-two pb_60">
                <h3 class="title color-primary">@lang('public.mainmenu_user_requirements_label')</h3>
            </div>

            @if(Session::has('message'))
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    </div>
                </div>
            @endif

            <h5 class="color-primary" style="margin-top: 30px;">@lang('public.client_requirements_datapage_props_group_title_caption')</h5>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="contract_type_enum">@lang('messages.client_requirements_datapage_contract_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'contract_type_enum'])" name="contract_type_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($contract_types as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'contract_type_enum'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="real_estate_type_id">@lang('messages.client_requirements_datapage_real_estate_type_label')</label>
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

            <div id="locationSelectorApp" >
                <label for="locationSelectorApp">@lang('messages.client_requirements_datapage_location_label')</label>
                <location-selector
                    data-show-empty-value-in-select-ptions="true"
                    data-empty-caption="@lang('messages.combobox_empty_caption')"
                    data-selected-area="{{ old('location_area_id', $record->location_area_id) }}"
                    data-selected-town-district="{{ old('location_town_district_id', $record->location_town_district_id) }}"
                    data-selected-neighborhood="{{ old('location_neighborhood_id', $record->location_neighborhood_id) }}"
                    data-selected-area-is-invalid="{{$errors->has('location_area_id')}}"
                    data-selected-town-district-is-invalid="{{$errors->has('location_town_district_id')}}"
                    data-selected-neighborhood-is-invalid="{{$errors->has('location_neighborhood_id')}}"
                    data-column-class="col-md-4 col-lg-4"
                >
                </location-selector>
            </div>


            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="price_min">@lang('messages.client_requirements_datapage_price_min_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'price_min'])" name="price_min" value="{{ old('price_min', $record->price_min) }}">
                            <div class="input-group-append">
                                <span class="input-group-text devisaupdater">{{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}</span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'price_min'])
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="price_max">@lang('messages.client_requirements_datapage_price_max_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'price_max'])" name="price_max" value="{{ old('price_max', $record->price_max) }}">
                            <div class="input-group-append">
                                <span class="input-group-text devisaupdater">{{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}</span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'price_max'])
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="price_currency_id">@lang('messages.client_requirements_datapage_price_currency_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'price_currency_id'])" name="price_currency_id" id="price_currency_id">
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
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="build_year_min">@lang('messages.client_requirements_datapage_build_year_min_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'build_year_min'])" name="build_year_min" value="{{ old('build_year_min', $record->build_year_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'build_year_min'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="build_year_max">@lang('messages.client_requirements_datapage_build_year_max_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'build_year_max'])" name="build_year_max" value="{{ old('build_year_max', $record->build_year_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'build_year_max'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="score_min">@lang('messages.client_requirements_datapage_score_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'score_min'])" name="score_min" value="{{ old('score_min', $record->score_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'score_min'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="gross_base_area_min">@lang('messages.client_requirements_datapage_gross_base_area_min_label')</label>
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
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="gross_base_area_max">@lang('messages.client_requirements_datapage_gross_base_area_max_label')</label>
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
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="livingroom_size_min">@lang('messages.client_requirements_datapage_livingroom_size_min_label')</label>
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
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="floor_min">@lang('messages.client_requirements_datapage_floor_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'floor_min'])" name="floor_min"
                               value="{{ old('floor_min', $record->floor_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'floor_min'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="floor_max">@lang('messages.client_requirements_datapage_floor_max_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'floor_max'])" name="floor_max"
                               value="{{ old('floor_max', $record->floor_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'floor_max'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="number_garage_plus_parking">@lang('messages.client_requirements_datapage_number_garage_plus_parking_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_garage_plus_parking'])" name="number_garage_plus_parking"
                               value="{{ old('number_garage_plus_parking', $record->number_garage_plus_parking) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_garage_plus_parking'])
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="number_bedroom_min">@lang('messages.client_requirements_datapage_number_bedroom_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom_min'])" name="number_bedroom_min"
                               value="{{ old('number_bedroom_min', $record->number_bedroom_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom_min'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="number_bedroom_max">@lang('messages.client_requirements_datapage_number_bedroom_max_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bedroom_max'])" name="number_bedroom_max"
                               value="{{ old('number_bedroom_max', $record->number_bedroom_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bedroom_max'])
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="number_bath_min">@lang('messages.client_requirements_datapage_number_bath_min_label')</label>
                        <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'number_bath_min'])" name="number_bath_min"
                               value="{{ old('number_bath_min', $record->number_bath_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'number_bath_min'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="kitchen_type_enums">@lang('messages.real_estates_datapage_kitchen_type_label')</label>
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
                <div class="col-lg-4 col-md-4" style="margin-top: 44px;">
                    <div class="form-group">
                        <div class="form-check">
                            <input class= "form-check-input three-states @include('inc.field-invalid-class', ['fieldName' => 'furniture'])" type="checkbox"
                                   value="{{(old('furniture', $record->furniture) == null) ? '' : $record->furniture}}" id="furniture" name="furniture">
                            <label class="form-check-label" for="furniture">@lang('messages.client_requirements_datapage_furniture_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'furniture'])
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4" style="margin-top: 44px;">
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


            <h5 class="color-primary" style="margin-top: 30px;">@lang('public.client_requirements_datapage_features_group_title_caption')</h5>
            <hr>
            <div class="row" style="margin-bottom: 30px;">
                @php $counter = 0; @endphp
                @foreach(\App\Models\ClientRequirement::$features as $item)
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group" style="margin-bottom: 0;">
                            <div class="form-check">
                                <input class= "form-check-input three-states @include('inc.field-invalid-class', ['fieldName' => $item])" type="checkbox"
                                       value="{{(old($item, $record->$item) == null) ? '' : $record->$item }}" id="{{$item}}" name="{{$item}}">
                                <label class="form-check-label" for="{{$item}}">@lang('messages.real_estates_datapage_'.$item.'_label')</label>
                                @include('inc.field-error-message', ['fieldName' => $item])
                            </div>
                        </div>
                    </div>
                    @php $counter++; @endphp
                @endforeach
            </div>

            <button class="btn btn-default1 mb-3">@lang('public.button_save_caption')</button>

        </form>
    </div>

</section>


@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
