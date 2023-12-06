@php
    /**
    * @var \App\Models\RealEstateOffer $record
    * @var \App\Models\enum\RealEstateOfferStatusEnum[] $statuses
    * @var \App\Models\Client[] $clients
    * @var \App\Models\Client[] $coWorkers
    * @var \App\Models\enum\LanguageEnum[] $languages
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
                @lang('messages.offers_datapage_panel_1_title_caption')
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label for="name" class="col-form-label">@lang('messages.offers_datapage_name_label')</label>
                            <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{old('name', $record->name) }}">
                            @include('inc.field-error-message', ['fieldName' => 'name'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="language_enum" class="col-form-label">@lang('messages.offers_datapage_language_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'language_enum'])" name="language_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($languages as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'language_enum'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-check">
                        <input class= "form-check-input @include('inc.field-invalid-class', ['fieldName' => 'maps_included'])" type="checkbox"
                               value="1" {{ (old('maps_included', $record->maps_included) == 1) ? 'checked' : '' }} id="maps_included" name="maps_included">
                        <label class="form-check-label" for="maps_included">@lang('messages.offers_datapage_maps_included_label')</label>
                        @include('inc.field-error-message', ['fieldName' => 'maps_included'])
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-check">
                        <input class= "form-check-input @include('inc.field-invalid-class', ['fieldName' => 'street_address_included'])" type="checkbox"
                               value="1" {{ (old('street_address_included', $record->street_address_included) == 1)  ? 'checked' : '' }} id="street_address_included" name="street_address_included">
                        <label class="form-check-label" for="street_address_included">@lang('messages.offers_datapage_street_address_included_label')</label>
                        @include('inc.field-error-message', ['fieldName' => 'street_address_included'])
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-check">
                        {{-- A checkbox legyen alapból bejelölve (létrehozáskor, szerkesztés esetén a visszaolvasott model értéke számít) --}}
                        {{-- Ha nincs kijelölve a checkbox, akkor 0 legyen az értéke (ne pedig egyáltalán ne létezzen a változó). Ezért van berakva a hidden input ugyanolyan néven. --}}
                        {{-- Fontos! Ez csak az új létrehozásnál számít, módosításnál az old() fgv null marad. --}}
                        {{-- Debug-hoz: {{ old('crop_logo_included') }}<br/>--}}
                        <input type="hidden" name="crop_logo_included" value="0">
                        <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'crop_logo_included'])"
                               type="checkbox"
                               value="1"
                               {{ (old('crop_logo_included', (!empty($record->crop_logo_included) ? $record->crop_logo_included : 0 )) == 1 || ($method === 'create' && is_null(old('crop_logo_included')))) ? 'checked' : '' }}
                               id="crop_logo_included"
                               name="crop_logo_included">
                        <label class="form-check-label" for="crop_logo_included">@lang('messages.offers_datapage_crop_logo_included_label')</label>
                        @include('inc.field-error-message', ['fieldName' => 'crop_logo_included'])
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-check">
                        <input class= "form-check-input @include('inc.field-invalid-class', ['fieldName' => 'one_page_limit'])"
                               type="checkbox"
                               value="1"
                               {{ (old('one_page_limit', (!empty($record->one_page_limit) ? $record->one_page_limit : 0 )) == 1 || ($method === 'create' && is_null(old('one_page_limit')))) ? 'checked' : '' }}
                               id="one_page_limit"
                               name="one_page_limit">
                        <label class="form-check-label" for="one_page_limit">@lang('messages.offers_datapage_one_page_limit_label')</label>
                        @include('inc.field-error-message', ['fieldName' => 'one_page_limit'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
