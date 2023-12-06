@php
    /**
    * @var \App\Models\Route $record
    * @var \App\Models\RouteComponent[]  $record->routeComponents
    * @var \App\Models\RouteComponent  $item
    * @var \App\Models\RealEstate  $item->realEstate
    */
@endphp

@if ($record->routeComponents->count() > 0)
    @foreach ($record->routeComponents as $item)
        <div class="list-group-item list-group-item-action" data-id="{{ $item->id }}" style="padding: 0;">
            <input type="hidden" id="h_tableFilterChanged" value="0">
                <div class="row image-row-with-data">
                    {{-- Kep --}}
                    <div class="col-1 image-row-with-data-image text-center">
                    <img
                            onclick="OpenGallery(this)"
                            src="{{ !empty($item->realEstate->getMedia('images')->first()) ? $item->realEstate->getMedia('images')->first()->getUrl('admin-thumb') : ''}}"
                            srcset="{{ !empty($item->realEstate->getMedia('images')->first()) ? $item->realEstate->getMedia('images')->first()->getUrl('admin-gallery-main-image') : ''}}"
                            alt=""
                            width="60"
                            height="60">
                    </div>
                    <div class="list-group-item-header col-11" data-id="{{ $item->id }}" style="padding: 0">
                        <div class="row" >
                            {{-- id --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                <a href="{{ route('realEstates.edit', [$item->realEstate->id]) }}">{{ $item->realEstate->id }}</a>
                            </div>
                            {{-- megbizas ? --}}
                            <div class="col-1 image-row-with-data-div-a">
                                @if(!empty($item->realEstate->commission) && isset($item->realEstate->commission) && $item->realEstate->commission == 1)
                                    <a>@lang('messages.something_exists')</a>
                                @else
                                    <a>@lang('messages.something_not_exists')</a>
                                @endif
                            </div>
                            {{-- kerulet --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->realEstate->locationTownDistrict->name }}</a>
                            </div>
                            {{-- utca --}}
                            <div class="col-1 image-row-with-data-div-a">
                                @if(!empty($item->realEstate->street_address_1))
                                    <a>{{ $item->realEstate->street_address_1 }}</a>
                                @elseif (!empty($item->realEstate->street_address_2))
                                    <a>{{ $item->realEstate->street_address_2 }}</a>
                                @else
                                    <a>{{ $item->realEstate->street_address_3 }}</a>
                                @endif
                            </div>
                            {{-- emelet --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                @if(!empty($item->realEstate->number_levels) || isset($item->realEstate->number_levels))
                                    <a>{{ $item->realEstate->number_levels }}</a>
                                @else
                                    <a> - </a>
                                @endif
                            </div>
                            {{-- negyzetmeter --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                <a>{{ $item->realEstate->base_area_gross }}</a>
                            </div>
                            {{-- brutto --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->realEstate->priceFormatterToDataTables($item->realEstate->offer_price) ." ". ( ($item->realEstate->currency != null) ? $item->realEstate->currency->iso_code : 'HUF') }}</a>
                            </div>
                            {{-- minar --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->realEstate->priceFormatterToDataTables($item->realEstate->limit_price) ." ". ( ($item->realEstate->currency != null) ? $item->realEstate->currency->iso_code : 'HUF') }}</a>
                            </div>
                            {{-- pont --}}
                            <div class="col-1 image-row-with-data-div-a text-center">
                                <a>{{ $item->realEstate->score }}</a>
                            </div>
                            {{-- epitve --}}
                            <div class="col-1 image-row-with-data-div-a">
                                <a>{{ $item->realEstate->build_year }}</a>
                            </div>
                            {{-- felujutva --}}
                            <div class="col-1 image-row-with-data-div-a">
                                @if(!empty($item->realEstate->renovation_year) && isset($item->realEstate->renovation_year))
                                    <a>{{ $item->realEstate->renovation_year }}</a>
                                @else
                                    <a>?</a>
                                @endif

                            </div>
                            {{-- sor vegi vezerlo --}}
                            <div class="col-1 image-row-with-data-div-a-last">
                                <div class="row">
                                    <div class="col-6">
                                        <span onclick="routeItemCollapseClick(event)" class="list-group-item-header-icon fa fa-angle-right" style="float: right;"></span>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge badge-secondary" style="float: right;">{{ $item->position }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <input type="hidden" name="componentId[]" value="{{ $item->id }}">
                </div>
            <div class="list-group-item-body" style="display: none;">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="component_visit_time" class="col-form-label-sm">@lang('messages.routes_datapage_item_component_visit_time_label')</label>
                            <textarea class="form-control form-control-sm @include('inc.field-invalid-class', ['fieldName' => 'component_visit_time'])" name="component_visit_time[{{ $item->id }}]"
                                      placeholder="@lang('messages.routes_datapage_item_component_visit_time_placeholder')">{{$item->visit_time}}</textarea>
                            @include('inc.field-error-message', ['fieldName' => 'component_visit_time'])
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="component_comment" class="col-form-label-sm">@lang('messages.routes_datapage_item_component_comment_label')</label>
                            <textarea class="form-control form-control-sm @include('inc.field-invalid-class', ['fieldName' => 'component_comment'])" name="component_comment[{{ $item->id }}]"
                                      placeholder="@lang('messages.routes_datapage_item_component_comment_placeholder')">{{$item->comment}}</textarea>
                            @include('inc.field-error-message', ['fieldName' => 'component_comment'])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="real_estate_code" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_real_estate_code_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="real_estate_code" value="{{ $item->realEstate->code }}">
                        </div>
                        <div class="form-group row">
                            <label for="commission" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_commission_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="commission" value="{{ ($item->realEstate->commission == 1) ? __('messages.something_exists') : __('messages.something_not_exists') }}">
                        </div>
                        <div class="form-group row">
                            <label for="townDistrict" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_locationTownDistrictName_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="townDistrict" value="{{ ($item->realEstate->locationTownDistrict) ? $item->realEstate->locationTownDistrict->name : '' }}">
                        </div>
                        <div class="form-group row">
                            <label for="locationStreet-1" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_locationStreet-1_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="locationStreet-1" value="{{ $item->realEstate->street_address_1." ".$item->realEstate->street_address_2 }}">
                        </div>
                        <div class="form-group row">
                            <label for="locationStreet-3" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_locationStreet-3_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="locationStreet-3" value="{{ $item->realEstate->street_address_3 }}">
                        </div>
                        <div class="form-group row">
                            <label for="baseAreaGross" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_baseAreaGross_label')</label>
                            <input class="col-1 form-control-plaintext form-control-sm"
                                   name="baseAreaGross" value="{{ $item->realEstate->base_area_gross }}">  m<sup style='top: 0.5em'>2</sup>
                        </div>
                        <div class="form-group row">
                            <label for="offerPrice" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_offerPrice_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-plaintext-sm"
                                   name="offerPrice" value="{{ number_format($item->realEstate->offer_price, 0, '.', ' ') ." ". ( ($item->realEstate->currency != null) ? $item->realEstate->currency->iso_code : 'HUF') }}">
                        </div>
                        <!-- INGATLAN-hoz tartozó megjegyzés mező!! Nem a route-hoz és nem a route-ban szereplő állomáshoz! -->
                        <div class="form-group row">
                            <label for="comment" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_comment_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="realEstateComment" value="{{ $item->realEstate->comment }}">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row">
                            <label for="ownerName" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerName_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="ownerName" value="{{ $item->realEstate->owner_name }}">
                        </div>
                        <div class="form-group row">
                            <label for="owner-phone-1" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerPhone-1_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->realEstate->owner_phone_1 }}">
                        </div>
                        <div class="form-group row">
                            <label for="owner-phone-2" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerPhone-2_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->realEstate->owner_phone_2 }}">
                        </div>
                        <div class="form-group row">
                            <label for="ownerContactName" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerContactName_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->realEstate->owner_contact_name }}">
                        </div>
                        <div class="form-group row">
                            <label for="ownerContactPhone" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerContactPhone_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="owner-phone-1" value="{{ $item->realEstate->owner_contact_phone }}">
                            @include('inc.field-error-message', ['fieldName' => 'ownerContactPhone'])
                        </div>
                        <div class="form-group row">
                            <label for="ownerKeys" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_ownerKeys_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="ownerKeys" value="{{ ($item->realEstate->owner_keys == 1) ? __('messages.something_exists') : __('messages.something_not_exists') }}">
                        </div>
                        <div class="form-group row">
                            <label for="score" class="col-xl-4 col-lg-6 col-form-label-sm">@lang('messages.routes_datapage_item_score_label')</label>
                            <input class="col-xl-4 col-lg-6 form-control-plaintext form-control-sm"
                                   name="score" value="{{ $item->realEstate->score }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@else
    @lang('messages.list_is_empty')
@endif
