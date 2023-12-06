@php
    /**
    * @var \App\Models\Enum\RealEstateContractTypeEnum[] $contractTypeEnums
    * @var \App\Models\RealEstateType[] $realEstateTypes
    */
@endphp

@section('javascript')
    @parent
@endsection

<div class="full-row py-5 bg-gray">
    <div class="container">
        <form class="form1 formicon" method="get" action="{{ route('realEstatePublicList') }}">

            <div class="row">
                <div class="col-md-4 col-lg-2">
                    <div class="form-group">
                        <select class="form-control" name="contract_type">
                            <option value="0">@lang('public.any_status_label')</option>
                            @foreach ($contractTypeEnums as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->caption }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    {{--                    <div class="form-group">--}}
                    {{--                        <select class="form-control" name="type">--}}
                    {{--                            <option value="0">@lang('public.any_type_label')</option>--}}
                    {{--                            @foreach ($realEstateTypes as $key => $item)--}}
                    {{--                                <option value="{{$item->id}}">{{ $item->translateOrDefault(App::getLocale())->name }}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    <div class="form-group">
                        {{--                            <label for="furniture_enums" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_furniture_label')</label>--}}
                        <select class="form-control selectpicker" name="type[]" data-live-search="true" multiple>
                            @foreach($realEstateTypes as $item)
                                <option value="{{$item->id}}">{{ $item->translateOrDefault(App::getLocale())->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="form-group">
                        {{--<input type="text" class="form-control" id="validationDefault03" placeholder="Enter Address, Street and City or Enter State, Zip code" required>--}}
                        <input type="text" class="form-control" name="freetext" placeholder="@lang('public.free_text_search_placeholder')">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-default1 w-100">@lang('public.search_property_button_label')</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="minarea" placeholder="@lang('public.min_area_placeholder')">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="maxarea" placeholder="@lang('public.max_area_placeholder')">
                    </div>
                </div>
                <div class="col-md-8 col-lg-4">
                    <div class="form-group pb-5">
                        <div class="price_range">
                            <div class="price-filter">
							<span class="price-slider">
                                <input class="filter_price" type="text" name="price" data-from="{{$priceFilterMin}}" data-to="{{$priceFilterMax}}" value="{{ $priceFilterMin.';'.$priceFilterMax }}" />
							</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="number_bedroom_min" placeholder="@lang('public.min_number_bedroom_placeholder')">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="number_bedroom_max" placeholder="@lang('public.max_number_bedroom_placeholder')">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="form-group">
{{--                            <label for="furniture_enums" class="col-form-label col-form-label-sm">@lang('messages.client_requirements_datapage_furniture_label')</label>--}}
                            <select class="form-control selectpicker" name="furniture_enums[]" data-live-search="true" multiple>
                                @foreach($furnitureTypes as $item)
                                    <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
            </div>

            <div class="row" id="locationSelectorApp" style="padding: 0;">
                <label class="col-md-12">@lang('public.real_estate_list_location_label')</label>
                <div class="col-md-12">
                    <location-selector
                            data-empty-caption="@lang('messages.combobox_empty_caption')"
                    >
                    </location-selector>
                </div>

            </div>
{{--
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <p class="d-inline-block hover_gray formicon mt-4">
                        <a class="checkbox_collapse" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">More Option</a>
                    </p>
                    <div class="row">
                        <div class="col">
                            <div class="collapse" id="multiCollapseExample1">
                                <div class="card card-body color-secondery bg-gray px-0">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <ul class="check_submit">
                                                <li>
                                                    <input id="feature_1" class="hide" type="checkbox">
                                                    <label for="feature_1">Parking Garage</label>
                                                </li>
                                                <li>
                                                    <input id="feature_2" class="hide" type="checkbox">
                                                    <label for="feature_2">Security System</label>
                                                </li>
                                                <li>
                                                    <input id="feature_3" class="hide" type="checkbox">
                                                    <label for="feature_3">Window Covering</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <ul class="check_submit">
                                                <li>
                                                    <input id="feature_4" class="hide" type="checkbox">
                                                    <label for="feature_4">Swiming Pool</label>
                                                </li>
                                                <li>
                                                    <input id="feature_5" class="hide" type="checkbox">
                                                    <label for="feature_5">Air Condition</label>
                                                </li>
                                                <li>
                                                    <input id="feature_8" class="hide" type="checkbox">
                                                    <label for="feature_8">Fire Protection</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <ul class="check_submit">
                                                <li>
                                                    <input id="feature_9" class="hide" type="checkbox">
                                                    <label for="feature_9">Garden</label>
                                                </li>
                                                <li>
                                                    <input id="feature_10" class="hide" type="checkbox">
                                                    <label for="feature_10">Fire Place</label>
                                                </li>
                                                <li>
                                                    <input id="feature_11" class="hide" type="checkbox">
                                                    <label for="feature_11">Emeargency Exit</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <ul class="check_submit">
                                                <li>
                                                    <input id="feature_12" class="hide" type="checkbox">
                                                    <label for="feature_12">Home Theater</label>
                                                </li>
                                                <li>
                                                    <input id="feature_13" class="hide" type="checkbox">
                                                    <label for="feature_13">Gym & Sports</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
--}}


        </form>
    </div>
</div>
