@php
    /**
    * @var \App\Models\SpecialOfferPage $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                @lang('messages.special_offer_pages_datapage_panel_1_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">

        {{--
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="position" class="col-form-label">@lang('messages.special_offer_pages_datapage_position_label')</label>
                    <input type="text" class="form-control currency @include('inc.field-invalid-class', ['fieldName' => 'position'])"
                           name="position" value="{{ old('position', $record->position) }}" readonly>
                    @include('inc.field-error-message', ['fieldName' => 'position'])
                </div>
            </div>
        </div>
        --}}

        @foreach(config('translatable.locales') as $locale)

            <div class="form-group row translatable" data-locale="{{$locale}}">
                <label for="{{$locale}}_title" class="col-lg-12 col-form-label">@lang('messages.special_offer_pages_datapage_menu_label')</label>
                <div class="input-group col-lg-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$locale}}</span>
                    </div>
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => $locale.'.menu_name'])" name="{{$locale}}[menu_name]"
                           value="{{ old($locale.'.menu_name', $record->{'menu_name:'.$locale}) }}">
                    @include('inc.field-error-message', ['fieldName' => $locale.'.menu_name'])
                </div>
            </div>

            <div class="form-group row translatable" data-locale="{{$locale}}">
                <label for="{{$locale}}_content" class="col-lg-12 col-form-label">@lang('messages.special_offer_pages_datapage_page_text_label')</label>
                <div class="input-group col-lg-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text">{{$locale}}</span>
                    </div>
                    <textarea class="form-control wysiwyg @include('inc.field-invalid-class', ['fieldName' => $locale.'.page_text'])" name="{{$locale}}[page_text]">{{ old($locale.'.page_text', $record->{'page_text:'.$locale}) }}</textarea>
                    @include('inc.field-error-message', ['fieldName' => $locale.'.page_text'])
                </div>
            </div>
        @endforeach


        </div>
    </div>
</div>
