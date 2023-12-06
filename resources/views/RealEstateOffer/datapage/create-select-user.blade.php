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
            @lang('messages.offers_datapage_panel_client_title_caption')
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="client_id" class="col-form-label">@lang('messages.offers_datapage_client_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'client_id'])" name="client_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($clients as $item)
                                <option value="{{$item->id}}" @if (old('client_id', $record->client_id) == $item->id) selected @endif>{{$item->user->name}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'client_id'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
