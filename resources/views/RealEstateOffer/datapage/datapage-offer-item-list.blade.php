@php
    /**
    * @var \App\Models\RealEstateOffer $record
    */
@endphp

@if ($record->realEstates->count() > 0)
    @foreach ($record->realEstates as $item)
        <div class="list-group-item list-group-item-action" data-id="{{ $item->id }}" style="padding: 0;">
            <input type="hidden" id="h_tableFilterChanged" value="0">
                <div class="row image-row-with-data">
                    {{-- Kep --}}
                    <div class="col-1 image-row-with-data-image text-center">
                        <img
                                onclick="OpenGallery(this)"
                                src="{{ !empty($item->getMedia('images')->first()) ? $item->getMedia('images')->first()->getUrl('admin-thumb') : ''}}"
                                srcset="{{ !empty($item->getMedia('images')->first()) ? $item->getMedia('images')->first()->getUrl('admin-gallery-main-image') : ''}}"
                                alt=""
                                width="60"
                                height="60">
                    </div>
                    <a href="#" onclick="showLightboxGallery(this); return false;"><img src="{{ !empty($item->getMedia('images')->first()) ? $item->getMedia('images')->first()->getUrl('admin-thumb') : ''}}" alt="" width="120" height="120" /></a>
                    <div class="list-group-item-header col-11" data-id="{{ $item->id }}" style="padding: 0">
                        <div class="row" >
                            {{-- id --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                <a href="{{ route('realEstates.edit', [$item->id]) }}">{{ $item->code }}</a>
                            </div>
                            {{-- megbizas ? --}}
                            <div class="col-1 image-row-with-data-div-a">
                                @if(!empty($item->commission) && isset($item->commission) && $item->commission == 1)
                                    <a>@lang('messages.something_exists')</a>
                                @else
                                    <a>@lang('messages.something_not_exists')</a>
                                @endif
                            </div>
                            {{-- kerulet --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->location_town_district_id }}</a>
                            </div>
                            {{-- utca --}}
                            <div class="col-1 image-row-with-data-div-a">
                                @if(!empty($item->street_address_1))
                                    <a>{{ $item->street_address_1 }}</a>
                                @elseif (!empty($item->street_address_2))
                                    <a>{{ $item->street_address_2 }}</a>
                                @else
                                    <a>{{ $item->street_address_3 }}</a>
                                @endif
                            </div>
                            {{-- emelet --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                @if(!empty($item->number_levels) || isset($item->number_levels))
                                    <a>{{ $item->number_levels }}</a>
                                @else
                                    <a> - </a>
                                @endif
                            </div>
                            {{-- negyzetmeter --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                <a>{{ $item->base_area_gross }}</a>
                            </div>
                            {{-- brutto --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->priceFormatterToDataTables($item->offer_price) ." ". ( ($item->currency != null) ? $item->currency->iso_code : 'HUF') }}</a>
                            </div>
                            {{-- minar --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->priceFormatterToDataTables($item->limit_price) ." ". ( ($item->currency != null) ? $item->currency->iso_code : 'HUF') }}</a>
                            </div>
                            {{-- pont --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                <a>{{ $item->score }}</a>
                            </div>
                            {{-- epitve --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->build_year }}</a>
                            </div>
                            {{-- felujutva --}}
                            <div class="col-1 image-row-with-data-div-a">
                                @if(!empty($item->renovation_year) && isset($item->renovation_year))
                                    <a>{{ $item->renovation_year }}</a>
                                @else
                                    <a>?</a>
                                @endif

                            </div>
                            {{-- sor vegi vezerlo --}}
                            <div class="col-1 image-row-with-data-div-a-last">
                                <span onclick="routeItemCollapseClick(event)" class="list-group-item-header-icon fa fa-angle-right" style="float: right;"></span>
                            </div>
                        </div>
                    </div>
                <input type="hidden" name="componentId[]" value="{{ $item->id }}">
                </div>
            <div class="list-group-item-body" style="display: none;">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="real_estate_code" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_real_estate_code_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="real_estate_code" value="{{ $item->code }}">
                        </div>
                        <div class="form-group row">
                            <label for="commission" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_commission_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="commission" value="{{ ($item->commission == 1) ? __('messages.something_exists') : __('messages.something_not_exists') }}">
                        </div>
                        <div class="form-group row">
                            <label for="townDistrict" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_locationTownDistrictName_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="townDistrict" value="{{ ($item->locationTownDistrict) ? $item->locationTownDistrict->name : '' }}">
                        </div>
                        <div class="form-group row">
                            <label for="locationStreet-1" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_locationStreet-1_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="locationStreet-1" value="{{ $item->street_address_1." ".$item->street_address_2 }}">
                        </div>
                        <div class="form-group row">
                            <label for="locationStreet-3" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_locationStreet-3_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="locationStreet-3" value="{{ $item->street_address_3 }}">
                        </div>
                        <div class="form-group row">
                            <label for="baseAreaGross" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_baseAreaGross_label')</label>
                            <input class="col-1 form-control-plaintext form-control-sm"
                                   name="baseAreaGross" value="{{ $item->base_area_gross }}">  m<sup style='top: 0.5em'>2</sup>
                        </div>
                        <div class="form-group row">
                            <label for="offerPrice" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_offerPrice_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-plaintext-sm"
                                   name="offerPrice" value="{{ number_format($item->offer_price, 0, '.', ' ') ." ". ( ($item->currency != null) ? $item->currency->iso_code : 'HUF') }}">
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_comment_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="comment" value="{{ $item->comment }}">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row">
                            <label for="ownerName" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerName_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="ownerName" value="{{ $item->owner_name }}">
                        </div>
                        <div class="form-group row">
                            <label for="owner-phone-1" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerPhone-1_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->owner_phone_1 }}">
                        </div>
                        <div class="form-group row">
                            <label for="owner-phone-2" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerPhone-2_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->owner_phone_2 }}">
                        </div>
                        <div class="form-group row">
                            <label for="ownerContactName" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerContactName_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->owner_contact_name }}">
                        </div>
                        <div class="form-group row">
                            <label for="ownerContactPhone" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerContactPhone_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->owner_contact_phone }}">
                            @include('inc.field-error-message', ['fieldName' => 'ownerContactPhone'])
                        </div>
                        <div class="form-group row">
                            <label for="ownerKeys" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerKeys_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="ownerKeys" value="{{ ($item->owner_keys == 1) ? __('messages.something_exists') : __('messages.something_not_exists') }}">
                        </div>
                        <div class="form-group row">
                            <label for="score" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_score_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="score" value="{{ $item->score }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@else
    @lang('messages.list_is_empty')
@endif
