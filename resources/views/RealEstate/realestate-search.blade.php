@php
    use App\Models\Enum\RealEstateContractTypeEnum;
    use App\Models\RealEstateType;
    /**
    * @var RealEstateContractTypeEnum[] $contractTypeEnums
    * @var RealEstateType[] $realEstateTypes
    */
@endphp

@extends('layouts.public.homex.base')

@section('descendant-site')

    @include('layouts.public.homex.header-one')
    <!-- Slider HTML markup -->
    <div class="full-row overflow-hidden">
        <div style="width:100%; height:180px; margin:0 auto; margin-bottom: 0px; top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none;">
                <img width="1920" height="800" src="{{ asset('images/slider/02.jpg') }}" class="ls-bg" alt=""/>
                {{-- Sotetetes a kepen/ filter --}}
                <div style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; width:100%; height:100%;"
                     class="ls-l slider-layer-1" data-ls="showinfo:1; position:fixed; durationout:400;"></div>
            </div>
        </div>
    </div>

    <!-- Property Search Form One
    =============================================================-->
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
                    <div class="col-md-8 col-lg-7">
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
                    <div class="col-md-4 col-lg-2">
                        <div class="form-group">
                            <select class="form-control" name="type">
                                <option value="0">@lang('public.any_type_label')</option>
                                @foreach ($realEstateTypes as $key => $item)
                                    <option value="{{$item->id}}">{{ $item->translateOrDefault(App::getLocale())->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="minarea" placeholder="@lang('public.min_area_placeholder')">
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
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
                            <input type="text" class="form-control" name="real_estate_id" placeholder="@lang('public.first_input_placeholder')">
                        </div>
                    </div>
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
            </form>
        </div>
    </div>

    @include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
