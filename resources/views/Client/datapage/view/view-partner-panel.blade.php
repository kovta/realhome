@php
    use App\Models\Partner;
    use App\Models\Client;
    /**
    * @var Partner[] $clientPartner
    * @var Client $record
    */

@endphp

<div class="card">
    <div class="card-header" id="heading-2">
        <h5 class="mb-0 float-left" style="padding: .75rem  1.25rem">
            @lang('messages.clients_datapage_view_partner_panel_title')
        </h5>
        {{-- Partner Buttons --}}
        @if(is_null($clientPartner))
            <a href="{{ route('partnerSelector',[$record->id]) }}"
               style="padding: .75rem  1.25rem;"
               class="btn btn-primary float-right">@lang('messages.clients_datapage_view_partner_panel_relationship_create_button')</a>
        @else
            <a href="{{ route('partners.relationship.delete', [$record->id]) }}"
               style="padding: .75rem  1.25rem;"
               class="btn btn-primary float-right">@lang('messages.clients_datapage_view_partner_panel_relationship_delete_button')</a>
        @endif
    </div>
    @if(!is_null($clientPartner))
        <div id="collapse-2" class="collapse show" aria-labelledby="heading-2" data-parent="#leftSections">
            <div class="card-body">
                {{-- Partner --}}
                @if(!is_null($clientPartner->partner_name))
                    <div class="row">
                        <label for="partner" class="col-sm-4">@lang('messages.clients_datapage_partner_label')</label>
                        <div class="col-sm-8">
                            <span>{{ old('partner', $clientPartner->partner_name) }}</span>
                        </div>
                    </div>
                @endif
                {{--Partner prefer kapcsolat--}}
                @if(!is_null($preferredPartnerContacts))
                    <div class="row">
                        <label for="preferred_contact_enum"
                               class="col-sm-4">@lang('messages.clients_datapage_preferred_contact_label')</label>
                        <div class="col-sm-8">
                            <span>{{ $preferredPartnerContacts }}</span>
                        </div>
                    </div>
                @endif
                {{-- Kapcsolattarto neve --}}
                @if(!is_null($clientPartner->contact_name))
                    <div class="row">
                        <label for="contact_name"
                               class="col-sm-4">@lang('messages.clients_datapage_contact_name_label')</label>
                        <div class="col-sm-8">
                            <span>{{ old('contact_name', $clientPartner->contact_name) }}</span>
                        </div>
                    </div>
                @endif
                {{-- Kapcsolattarto email --}}
                @if(!is_null($clientPartner->contact_email))
                    <div class="row">
                        <label for="contact_email"
                               class="col-sm-4">@lang('messages.clients_datapage_contact_email_label')</label>
                        <div class="col-sm-8">
                            <span>{{ old('contact_email', $clientPartner->contact_email) }}</span>
                        </div>
                    </div>
                @endif
                {{-- Telefonszamok --}}
                @if(!is_null($clientPartner->contact_phone_1))
                    <div class="row">
                        <label for="contact_phone_1"
                               class="col-sm-4">@lang('messages.clients_datapage_phones_label')</label>
                        <div class="col-sm-8">
                            <span>{{ old('contact_phone_1', $clientPartner->contact_phone_1) }}, {{ old('contact_phone_2', $clientPartner->contact_phone_2) }}</span>
                        </div>
                    </div>
                @endif
                {{-- Valami --}}
                @if(!is_null($sources))
                    <div class="row">
                        <label for="source_enum"
                               class="col-sm-4">@lang('messages.clients_datapage_source_label')</label>
                        <div class="col-sm-8">
                            <span>{{ $sources }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
