@php
    /**
    * @var \App\Models\RealEstate $record
    */

    use \App\User;
@endphp

<div class="card">
    <div class="card-header" id="meta-heading-2">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#meta-collapse-2" aria-expanded="true" aria-controls="meta-collapse-2">
                @lang('messages.real_estates_datapage_right_col_panel_2_caption')
            </button>
        </h5>
    </div>

    <div id="meta-collapse-2" class="collapse show" aria-labelledby="meta-heading-2" data-parent="#rightSections">
        <div class="card-body">

            <div class="form-group row">
                <label for="moveindate" class="col-6 col-form-label">@lang('messages.real_estates_datapage_moveindate_label')</label>
                <div class="input-group col-6">
                    <input type="text" class="form-control date @include('inc.field-invalid-class', ['fieldName' => 'moveindate'])" name="moveindate" data-provide="datepicker" value="{{ old('moveindate', $record->moveindate) }}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'moveindate'])
                </div>
            </div>

            <div class="form-group row">
                <label for="last_owner_contact_noify_sent" class="col-6 col-form-label">@lang('messages.real_estates_datapage_last_owner_contact_noify_sent_label')</label>
                <div class="input-group col-6">
                    <input type="text" class="form-control date @include('inc.field-invalid-class', ['fieldName' => 'last_owner_contact_noify_sent'])" name="last_owner_contact_noify_sent" data-provide="datepicker" value="{{ old('last_owner_contact_noify_sent', $record->last_owner_contact_noify_sent) }}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'last_owner_contact_noify_sent'])
                </div>
            </div>

            <div class="form-group row">
                <label for="place_number" class="col-6 col-form-label">@lang('messages.real_estates_datapage_place_number_label')</label>
                <div class="col-6">
                    <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'place_number'])" name="place_number" value="{{ old('place_number', $record->place_number) }}">
                    @include('inc.field-error-message', ['fieldName' => 'place_number'])
                </div>
            </div>

            <div class="form-group row">
                <label for="build_year" class="col-6 col-form-label">@lang('messages.real_estates_datapage_build_year_label')</label>
                <div class="col-6">
                    <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'build_year'])" name="build_year" value="{{ old('build_year', $record->build_year) }}">
                    @include('inc.field-error-message', ['fieldName' => 'build_year'])
                </div>
            </div>

            <div class="form-group row">
                <label for="renovation_year" class="col-6 col-form-label">@lang('messages.real_estates_datapage_renovation_year_label')</label>
                <div class="col-6">
                    <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'renovation_year'])" name="renovation_year" value="{{ old('renovation_year', $record->renovation_year) }}">
                    @include('inc.field-error-message', ['fieldName' => 'renovation_year'])
                </div>
            </div>


            <div class="form-group row">
                <label for="price_currency_id" class="col-6 col-form-label">@lang('messages.real_estates_datapage_price_currency_label')</label>
                <div class="input-group col-6">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'price_currency_id'])" name="price_currency_id" id="price_currency_id" autocomplete="off">
                        {{-- ne legyen más, csak a default --}}
                        {{--<option value="">@lang('messages.combobox_empty_caption')</option>--}}
                        @foreach ($currencies as $item)
                        <option value="{{ $item->id }}" @if (old('price_currency_id', $record->price_currency_id) == $item->id || (empty($record->price_currency_id) and $item->iso_code == 'HUF')) selected @endif>{{$item->iso_code}}</option>
                        @endforeach
                    </select>
                </div>
                @include('inc.field-error-message', ['fieldName' => 'price_currency_id'])
            </div>

            <div class="form-group row">
                <label for="offer_price" class="col-6 col-form-label">@lang('messages.real_estates_datapage_offer_price_label')</label>
                <div class="input-group col-6">
                    <input type="text" class= "form-control currency @include('inc.field-invalid-class', ['fieldName' => 'offer_price'])" name="offer_price" value="{{ old('offer_price', $record->offer_price) }}">
                    <div class="input-group-append">
                        <span class="input-group-text devisa devisaupdater">{{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}</span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'offer_price'])
                </div>
            </div>

            <div class="form-group row">
                <label for="limit_price" class="col-6 col-form-label">@lang('messages.real_estates_datapage_limit_price_label')</label>
                <div class="input-group col-6">
                    <input type="text" class= "form-control currency @include('inc.field-invalid-class', ['fieldName' => 'limit_price'])" name="limit_price" value="{{ old('limit_price', $record->limit_price) }}">
                    <div class="input-group-append">
                        <span class="input-group-text devisa devisaupdater">{{ ($record->currency != null) ? $record->currency->iso_code : 'HUF' }}</span>
                    </div>
                    @include('inc.field-error-message', ['fieldName' => 'limit_price'])
                </div>
            </div>

        </div>
    </div>
</div>
