@php
    use App\Models\Partner;
    use App\Models\Enum\ClientPreferredContactEnum;
    /**
    * @var Partner $partner
    * @var ClientPreferredContactEnum[] $preferredContacts
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
            @lang('messages.clients_datapage_panel_1_title_caption')
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">


            <div class="row">
                <div class="col-sm-6">
                    <label for="partner_name" class="col-form-label">@lang('messages.partners_list_td_head_name')</label>
                    <div class="form-group">
                        <input class="form-control" name="partner_name" value="{{ old('partner_name', $partner->partner_name) }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="preferred_contact_enum"
                           class="col-form-label">@lang('messages.clients_datapage_preferred_contact_label')</label>
                    <div class="form-group">
                        <select class="form-control" name="preferred_contact_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($preferredContacts as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="contact_name"
                           class="col-form-label">@lang('messages.clients_datapage_contact_name_label')</label>
                    <div class="form-group">
                        <input type="text" class="form-control " name="contact_name" value="{{ old('contact_name', $partner->contact_name) }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="contact_email"
                               class="col-form-label">@lang('messages.clients_datapage_contact_email_label')</label>
                        <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $partner->contact_email) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <label for="contact_phone_1"
                       class="col-12 col-form-label">@lang('messages.clients_datapage_phones_label')</label>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="tel" class="form-control " name="contact_phone_1"
                               placeholder="@lang('messages.clients_datapage_phone-1_placeholder')" value="{{ old('contact_phone_1', $partner->contact_phone_1) }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="tel" class="form-control " name="contact_phone_2"
                               placeholder="@lang('messages.clients_datapage_phone-2_placeholder')" value="{{ old('contact_phone_2', $partner->contact_phone_2) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
