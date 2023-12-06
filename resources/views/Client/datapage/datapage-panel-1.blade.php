@php
    /**
    * @var \App\Models\Client $record
    * @var \App\User $record->user
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-1"
                    aria-expanded="true" aria-controls="collapse-1">
                @lang('messages.clients_datapage_panel_1_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">
            {{-- Nev --}}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">@lang('messages.clients_datapage_name_label')</label>
                <div class="col-sm-10">
                    <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name"
                           value="{{ old('name', $record->name) }}">
                    @include('inc.field-error-message', ['fieldName' => 'name'])
                </div>
            </div>
            {{-- Email --}}
            <div class="form-group row">
                <label for="email"
                       class="col-sm-2 col-form-label">@lang('messages.clients_datapage_email_label')</label>
                <div class="col-sm-10">
                    <input type="email"
                           class="form-control @include('inc.field-invalid-class', ['fieldName' => 'email'])"
                           name="email" value="{{ old('email', $record->email) }}">
                    @include('inc.field-error-message', ['fieldName' => 'email'])
                </div>
            </div>
            {{-- Status --}}
            <div class="form-group row">
                <label for="status_enum"
                       class="col-sm-2 col-form-label">@lang('messages.clients_datapage_status_label')</label>
                <div class="col-sm-10">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'status_enum'])"
                            name="status_enum">
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($statuses as $item)
                            <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'status_enum'])
                </div>
            </div>
            {{-- Telefonszamok --}}
            <div class="row">
                <label for="phone_1"
                       class="col-12 col-form-label">@lang('messages.clients_datapage_phones_label')</label>
                <div class="col-6">
                    <div class="form-group">
                        <input type="tel"
                               class="form-control @include('inc.field-invalid-class', ['fieldName' => 'phone_1'])"
                               name="phone_1"
                               value="{{ old('phone_1', $record->phone_1) }}"
                               placeholder="@lang('messages.clients_datapage_phone-1_placeholder')">
                        @include('inc.field-error-message', ['fieldName' => 'phone_1'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="tel"
                               class="form-control @include('inc.field-invalid-class', ['fieldName' => 'phone_2'])"
                               name="phone_2"
                               value="{{ old('phone_2', $record->phone_2) }}"
                               placeholder="@lang('messages.clients_datapage_phone-2_placeholder')">
                        @include('inc.field-error-message', ['fieldName' => 'phone_2'])
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Utolso ugyfelkapcsolat --}}
                <div class="col-6">
                    <div class="form-group">
                        <label for="last_contacted"
                               class="col-form-label">@lang('messages.clients_datapage_last_contacted_label')</label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control date @include('inc.field-invalid-class', ['fieldName' => 'last_contacted'])"
                                   name="last_contacted" data-provide="datepicker"
                                   value="{{ old('last_contacted', $record->last_contacted) }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'last_contacted'])
                        </div>
                    </div>
                </div>
                {{-- Preferalt kapcsolat --}}
                <div class="col-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="preferred_contact_enum"
                                   class="col-form-label">@lang('messages.clients_datapage_preferred_contact_label')</label>
                            <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'preferred_contact_enum'])"
                                    name="preferred_contact_enum">
                                <option value="">@lang('messages.combobox_empty_caption')</option>
                                @foreach ($preferredContacts as $item)
                                    <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                                @endforeach
                            </select>
                            @include('inc.field-error-message', ['fieldName' => 'preferred_contact_enum'])
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Forras --}}
                <div class="col-6">
                    <div class="form-group">
                        <label for="source_enum" class="col-form-label">@lang('messages.clients_datapage_source_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'source_enum'])" name="source_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($sources as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'source_enum'])
                    </div>
                </div>
                {{-- Ugyintezo --}}
                <div class="col-6">
                    <div class="form-group">
                        <label for="broker_id" class="col-form-label">@lang('messages.clients_datapage_broker_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'broker_id'])" name="broker_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($coWorkers as $item)
                                <option value="{{$item->id}}" @if ($item->id == old('broker_id', $record->broker_id)) {{ 'selected' }} @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'broker_id'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
