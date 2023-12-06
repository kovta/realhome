@php
    use App\Models\Client;
    use App\Models\ClientRequirement;
    /**
    * @var ClientRequirement $clientRequirement
    * @var Client $record
    */
@endphp

    <div class="card">
        <div class="card-header" id="heading-1">
            <h5 class="mb-0 float-left" style="padding: .75rem  1.25rem">
                @lang('messages.clients_datapage_view_client_requirement_panel_title')
            </h5>
            <a href="{{ route('clientRequirements.index', ['client' => $record->id]) }}" style="padding: .75rem  1.25rem;"
               class="btn btn-primary float-right ">@lang('messages.clients_datapage_view_client_requirement_panel_change_button')</a>
        </div>
        @if(!is_null($clientRequirement))
        <div id="collapse-3" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- Állapot --}}
                        @if(!is_null($realStatuses))
                            <div class="row">
                                <label for="status_enum"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_status_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ $realStatuses }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Szerződés típus --}}
                        @if(!is_null($contract_types))
                            <div class="row">
                                <label for="contract_type_enum"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_contract_type_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ $contract_types }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Ingatlan típus --}}
                        @if(!is_null($real_estate_types))
                            <div class="row">
                                <label for="real_estate_type_id"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_real_estate_type_label')</label>
                                <div class="col-sm-8">
                                    @foreach ($real_estate_types as $item)
                                        @if (old('real_estate_type_id', $clientRequirement->real_estate_type_id) == $item->id)
                                            <span>{{ $item->translateOrDefault()->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($realEstateLocationArea))
                            <div class="row">
                                <label for="locationSelectorApp"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_location_label')</label>
                                <div class="col-sm-8">
                                    {{--                                    @php dd($realEstateLocationArea->name) @endphp--}}
                                    <span>{{ $realEstateLocationArea->name }}@if(!is_null($realEstateLocationDistrict))
                                            , {{ $realEstateLocationDistrict->name }}@if(!is_null($realEstateLocationNeighborhood))
                                                , {{ $realEstateLocationNeighborhood->name }}</span>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                        {{-- Ár min. --}}
                        @if(!is_null($clientRequirement->price_min))
                            <div class="row">
                                <label for="price_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_price_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('price_min', Helper::add_space_to_price($clientRequirement->price_min)) }}</span>
                                    <span>{{ ($clientRequirement->currency != null) ? $clientRequirement->currency->iso_code : 'HUF' }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Ár max. --}}
                        @if(!is_null($clientRequirement->price_max))
                            <div class="row">
                                <label for="price_max"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_price_max_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('price_min', Helper::add_space_to_price($clientRequirement->price_max)) }}</span>
                                    <span>{{ ($clientRequirement->currency != null) ? $clientRequirement->currency->iso_code : 'HUF' }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Pénznem --}}
                        @if(!is_null($currencies))
                            <div class="row">
                                <label for="price_currency_id"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_price_currency_label')</label>
                                <div class="col-sm-8">
                                    @foreach ($currencies as $item)
                                        @if (old('price_currency_id', $clientRequirement->price_currency_id) == $item->id)
                                            <span>{{ $item->iso_code }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{-- Építés éve min. --}}
                        @if(!is_null($clientRequirement->build_year_min))
                            <div class="row">
                                <label for="build_year_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_build_year_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('build_year_min', $clientRequirement->build_year_min) }}</span>

                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->build_year_max))
                            <div class="row">
                                <label for="build_year_max"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_build_year_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('build_year_max', $clientRequirement->build_year_max) }}</span>

                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->score_min))
                            <div class="row">
                                <label for="build_year_max"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_build_year_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('score_min', $clientRequirement->score_min) }}</span>

                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->gross_base_area_min))
                            <div class="row">
                                <label for="build_year_max"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_gross_base_area_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('gross_base_area_min', $clientRequirement->gross_base_area_min) }}</span>
                                    <span>m<sup>2</sup></span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->gross_base_area_max))
                            <div class="row">
                                <label for="build_year_max"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_gross_base_area_max_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('gross_base_area_max', $clientRequirement->gross_base_area_max) }}</span>
                                    <span>m<sup>2</sup></span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->livingroom_size_min))
                            <div class="row">
                                <label for="livingroom_size_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_livingroom_size_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('livingroom_size_min', $clientRequirement->livingroom_size_min) }}</span>
                                    <span>m<sup>2</sup></span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->floor_min))
                            <div class="row">
                                <label for="floor_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_floor_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('floor_min', $clientRequirement->floor_min) }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->floor_max))
                            <div class="row">
                                <label for="floor_max"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_floor_max_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('floor_max', $clientRequirement->floor_max) }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->number_garage_plus_parking))
                            <div class="row">
                                <label for="number_garage_plus_parking"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_number_garage_plus_parking_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('number_garage_plus_parking', $clientRequirement->number_garage_plus_parking) }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->number_bedroom_min))
                            <div class="row">
                                <label for="number_bedroom_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_number_bedroom_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('number_bedroom_min', $clientRequirement->number_bedroom_min) }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->number_bedroom_max))
                            <div class="row">
                                <label for="number_bedroom_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_number_bedroom_max_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('number_bedroom_max', $clientRequirement->number_bedroom_max) }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Partner --}}
                        @if(!is_null($clientRequirement->number_bath_min))
                            <div class="row">
                                <label for="number_bath_min"
                                       class="col-sm-4">@lang('messages.client_requirements_datapage_number_bath_min_label')</label>
                                <div class="col-sm-8">
                                    <span>{{ old('number_bath_min', $clientRequirement->number_bath_min) }}</span>
                                </div>
                            </div>
                        @endif
                        {{-- Konyha típusa --}}
                        @if(!is_null($kitchenTypes))
                            <div class="row">
                                <label for="kitchen_type_enums"
                                       class="col-sm-4">@lang('messages.real_estates_datapage_kitchen_type_label')</label>
                                <div class="col-sm-8">
                                    @foreach ($kitchenTypes as $item)
                                        @if (old('price_currency_id', $clientRequirement->price_currency_id) == $item->id)
                                            <span>{{ $item->caption }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @include('Client.datapage.view.client-requirement-feature-panel')
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
