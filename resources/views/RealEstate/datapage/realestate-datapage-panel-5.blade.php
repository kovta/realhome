@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-5">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-5" aria-expanded="true" aria-controls="collapse-5">
                @lang('messages.real_estates_datapage_left_col_panel_5_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-5" class="collapse show" aria-labelledby="heading-5" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_name" class="col-form-label">@lang('messages.real_estates_datapage_owner_name_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_name'])" name="owner_name" value="{{ old('owner_name', $record->owner_name) }}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_name'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_email" class="col-form-label">@lang('messages.real_estates_datapage_owner_email_label')</label>
                        <input type="email" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_email'])" name="owner_email" value="{{ old('owner_email', $record->owner_email)}}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_email'])
                    </div>
                </div>
            </div>

            <div class="row">
                <label for="owner_phone_2" class="col-12 col-form-label">@lang('messages.real_estates_datapage_owner_phones_label')</label>
                <div class="col-6">
                    <div class="form-group">
                        <input type="tel" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_phone_1'])" name="owner_phone_1" value="{{ old('owner_phone_1', $record->owner_phone_1) }}" placeholder="@lang('messages.real_estates_datapage_owner_phone_1_label')">
                        @include('inc.field-error-message', ['fieldName' => 'owner_phone_1'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                         <input type="tel" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_phone_2'])" name="owner_phone_2" value="{{ old('owner_phone_2', $record->owner_phone_2) }}" placeholder="@lang('messages.real_estates_datapage_owner_phone_2_label')">
                        @include('inc.field-error-message', ['fieldName' => 'owner_phone_2'])
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_contact_name" class="col-form-label">@lang('messages.real_estates_datapage_owner_contact_name_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_contact_name'])" name="owner_contact_name" value="{{ old('owner_contact_name', $record->owner_contact_name) }}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_contact_name'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_contact_phone" class="col-form-label">@lang('messages.real_estates_datapage_owner_contact_phone_label')</label>
                        <input type="tel" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_contact_phone'])" name="owner_contact_phone" value="{{ old('owner_contact_phone', $record->owner_contact_phone) }}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_contact_phone'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_contact_email" class="col-form-label">@lang('messages.real_estates_datapage_owner_contact_email_label')</label>
                        <input type="email" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_contact_email'])" name="owner_contact_email" value="{{ old('owner_contact_email', $record->owner_contact_email) }}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_contact_email'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_bell" class="col-form-label">@lang('messages.real_estates_datapage_owner_bell_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_bell'])" name="owner_bell" value="{{ old('owner_bell', $record->owner_bell) }}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_bell'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="owner_alarm" class="col-form-label">@lang('messages.real_estates_datapage_owner_alarm_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'owner_alarm'])" name="owner_alarm" value="{{ old('owner_alarm', $record->owner_alarm) }}">
                        @include('inc.field-error-message', ['fieldName' => 'owner_alarm'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group" style="margin-top: 44px;">
                        <div class="form-check">
                            <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'owner_keys'])" type="checkbox" value="1"
                                   {{ (old('owner_keys', $record->owner_keys) == 1) ? 'checked' : '' }} id="owner_keys" name="owner_keys">
                            <label class="form-check-label" for="owner_keys">@lang('messages.real_estates_datapage_owner_keys_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'owner_keys'])
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
