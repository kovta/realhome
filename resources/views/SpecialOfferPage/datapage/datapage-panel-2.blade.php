@php
    /**
    * @var SpecialOfferPage $record
    * @var Client $client
    * @var RealEstateType[] $realEstateTypes
    */
    use App\Models\Client;
    use App\Models\RealEstateType;
    use App\Models\SpecialOfferPage;
@endphp

<div class="card">
    <div class="card-header" id="heading-2">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-2"
                    aria-expanded="true" aria-controls="collapse-2">
                @lang('messages.special_offer_pages_datapage_panel_2_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-2" class="collapse show" aria-labelledby="heading-2" data-parent="#leftSections">
        <div class="card-body">
            <div class="row">
                @if(!empty($realEstateTypes))
                    <div class="col-3">
                        <div class="form-group">
                            <label for="real_estate_type_id" class="col-form-label">Ingatle tipusa</label>
                            <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'real_estate_type_id'])"
                                    name="real_estate_type_id">
                                <option value="">@lang('messages.combobox_empty_caption')</option>
                                @foreach ($realEstateTypes  as $key => $item)
                                    @if($record->real_estate_type_id == $item->id)
                                        <option selected
                                                value="{{$item->id}}">{{ $item->translateOrDefault(App::getLocale())->name }}</option>
                                    @else
                                        <option value="{{$item->id}}">{{ $item->translateOrDefault(App::getLocale())->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @include('inc.field-error-message', ['fieldName' => 'real_estate_type_id'])
                        </div>
                    </div>
                @endif
                <div class="col-3">
                    <div class="form-group">
                        <label for="contract_type_enum"
                               class="col-form-label">@lang('messages.special_offer_pages_datapage_contract_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'contract_type_enum'])"
                                name="contract_type_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($contract_types as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'contract_type_enum'])
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="price_min"
                               class="col-form-label">@lang('messages.special_offer_pages_datapage_price_min_label')</label>
                        <input type="text"
                               class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'price_min'])"
                               name="price_min" value="{{ old('price_min', $record->price_min) }}">
                        @include('inc.field-error-message', ['fieldName' => 'price_min'])
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="price_max"
                               class="col-form-label">@lang('messages.special_offer_pages_datapage_price_max_label')</label>
                        <input type="text"
                               class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'price_max'])"
                               name="price_max" value="{{ old('price_max', $record->price_max) }}">
                        @include('inc.field-error-message', ['fieldName' => 'price_max'])
                    </div>
                </div>
            </div>
            <div class="" id="locationSelectorApp">
                <label for="locationSelectorApp"
                       class="col-form-label">@lang('messages.special_offer_pages_datapage_location_label')</label>
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
