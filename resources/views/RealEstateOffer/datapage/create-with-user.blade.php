<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
                @lang('messages.offers_datapage_panel_new_client_title_caption')
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">
            <div class="form-group row">
                <label for="client_name"
                       class="col-sm-2 col-form-label">@lang('messages.clientusers_datapage_name_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'client_name'])" name="client_name">
                    @include('inc.field-error-message', ['fieldName' => 'client_name'])
                </div>
            </div>

            <div class="form-group row">
                <label for="client_email"
                       class="col-sm-2 col-form-label">@lang('messages.clientusers_datapage_email_label')</label>
                <div class="col-sm-10">
                    <input type="email"
                           class="form-control @include('inc.field-invalid-class', ['fieldName' => 'client_email'])"
                           name="client_email">
                </div>
                @include('inc.field-error-message', ['fieldName' => 'client_email'])
            </div>

            <div class="row">
                <label for="client_phone_1"
                       class="col-12 col-form-label">@lang('messages.clientusers_datapage_phones_label')</label>
                <div class="col-6">
                    <div class="form-group">
                        <input type="tel"
                               class="form-control @include('inc.field-invalid-class', ['fieldName' => 'client_phone_1'])"
                               name="client_phone_1"
                               placeholder="@lang('messages.clientusers_datapage_phone-1_placeholder')">
                        @include('inc.field-error-message', ['fieldName' => 'client_phone_1'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="tel"
                               class="form-control @include('inc.field-invalid-class', ['fieldName' => 'client_phone_2'])"
                               name="client_phone_2"
                               placeholder="@lang('messages.clientusers_datapage_phone-2_placeholder')">
                        @include('inc.field-error-message', ['fieldName' => 'client_phone_2'])
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-check">
                        {{--            <label for="role" class="col-form-label">@lang('messages.clientusers_datapage_role_label')</label>--}}
                        <input class="form-check-input" type="checkbox" name="user_create" id="user_create" value="true">
                        <label class="form-check-label" for="user_create">
                            @lang('messages.offers_datapage_panel_new_client_checkbox_caption')
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


