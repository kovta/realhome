@php
    /**
    * @var \App\Models\SiteParameter $record
    */
@endphp

<div class="form-group row">
    <label for="code_name" class="col-xl-2 col-lg-2 col-form-label">@lang('messages.siteparameters_datapage_name_label')</label>
    <div class="col-xl-6 col-lg-10">
        <input readonly class="form-control-plaintext" name="code_name" value="{{ old('code_name', $record->code_name) }}">
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-xl-2 col-lg-2 col-form-label">@lang('messages.siteparameters_datapage_description_label')</label>
    <div class="col-xl-6 col-lg-10">
        <textarea class="form-control @include('inc.field-invalid-class', ['fieldName' => 'description'])" name="description">{{ old('description', $record->description) }}</textarea>
        @include('inc.field-error-message', ['fieldName' => 'description'])
    </div>
</div>
<div class="form-group row">
    <label for="value" class="col-xl-2 col-lg-2 col-form-label">@lang('messages.siteparameters_datapage_value_label')</label>
    <div class="col-2">
        @if (strpos($record->code_name, 'Color') !== false)
            <div id="colorPicker" class="input-group">
                <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'value'])" name="value" value="{{ old('value', $record->value) }}">
                <div class="input-group-append">
                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </div>
            </div>
        @else
            <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'value'])" name="value" value="{{ old('value', $record->value) }}">
            @include('inc.field-error-message', ['fieldName' => 'value'])
        @endif
    </div>
</div>
