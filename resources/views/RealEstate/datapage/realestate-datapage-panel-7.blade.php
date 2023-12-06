@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-7">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-7" aria-expanded="true" aria-controls="collapse-7">
                @lang('messages.real_estates_datapage_left_col_panel_7_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-7" class="collapse show" aria-labelledby="heading-7" data-parent="#leftSections">
        <div class="card-body">

            @foreach(config('translatable.locales') as $locale)
            <div class="form-group translatable" data-locale="{{$locale}}">
                <div class="col-12">
                    <label for="{{$locale}}_description" class="col-form-label">@lang('messages.real_estates_datapage_description_label')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{$locale}}</span>
                        </div>
                        <textarea class="form-control wysiwyg @include('inc.field-invalid-class', ['fieldName' => $locale.'.description'])" name="{{$locale}}[description]">{{ old($locale.'.description', $record->{'description:'.$locale}) }}</textarea>
                        @include('inc.field-error-message', ['fieldName' => $locale.'.description'])
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
