@php
    use App\Models\Client;
    use App\User;
    /**
    * @var Client $record
    * @var User $record->user
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0 float-left" style="padding: .75rem  1.25rem">
            @lang('messages.clients_datapage_view_client_panel_title')
        </h5>
        <a href="{{ route('clients.edit', $record->id) }}" style="padding: .75rem  1.25rem"
           class="btn btn-primary float-right">@lang('messages.clients_datapage_view_client_panel_change_button')</a>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">
                <div class="alert alert-primary" style="text-align: center" role="alert">
                    @if(!is_null($hasUser))
                        @lang('messages.clients_datapage_view_client_panel_info_box')
                    @else
                        @lang('messages.clients_datapage_view_client_panel_info_box_disabled')
                    @endif
                    <a href="{{ route('clientRole.index', ['id' => $record]) }}" class="alert-link">@lang('messages.clients_datapage_view_client_panel_info_box_button')</a>
                </div>
            {{--Ugyfel nev--}}
            <div class=" row">
                <label for="name"
                       class="col-sm-3">@lang('messages.clients_datapage_view_client_panel_name_label')</label>
                <div class="col-sm-9">
                    <span>{{ old('name', $record->name) }}</span>
                </div>
            </div>
            {{--Ugyfel email--}}
            <div class="row">
                <label for="email"
                       class="col-sm-3 ">@lang('messages.clients_datapage_view_client_panel_email_label')</label>
                <div class="col-sm-9">
                    <span>{{ old('email', $record->email) }}</span>
                </div>
            </div>
            {{--Ugyfel status--}}
            <div class="row">
                <label for="status_enum"
                       class="col-sm-3">@lang('messages.clients_datapage_view_client_panel_status_label')</label>
                <div class="col-sm-9">
                    <span>{{ $statuses }}</span>
                </div>
            </div>
            {{--Ugyfel telefon--}}
            <div class="row">
                <label for="phone_1"
                       class="col-sm-3 ">@lang('messages.clients_datapage_phones_label')</label>
                <div class="col-sm-9">
                    <span>{{ old('phone_1', $record->phone_1) }}, {{ old('phone_2', $record->phone_2) }}</span>
                </div>
            </div>
            {{--Ugyfel utolsokapcsolat--}}
            @if(!is_null($record->last_contacted))
                <div class="row">
                    <label for="last_contacted"
                           class="col-sm-3">@lang('messages.clients_datapage_last_contacted_label')</label>
                    <div class="col-sm-9">
                        <span>{{ old('last_contacted', $record->last_contacted) }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel nemzetiseg--}}
            @if(!is_null($record->nationality))
                <div class="row">
                    <label for="nationality"
                           class="col-sm-3">@lang('messages.clients_datapage_nationality_label')</label>
                    <div class="col-sm-9">
                        <span>{{ old('nationality', $record->nationality) }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel haztartas merete--}}
            @if(!is_null($record->number_tenants))
                <div class="row">
                    <label for="number_tenants"
                           class="col-sm-6">@lang('messages.clients_datapage_number_tenants_label')</label>
                    <div class="col-sm-6">
                        <span>{{ old('number_tenants', $record->number_tenants) }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel gyerekek szama--}}
            @if(!is_null($record->number_children))
                <div class="row">
                    <label for="number_children"
                           class="col-sm-6">@lang('messages.clients_datapage_number_children_label')</label>
                    <div class="col-sm-6">
                        <span>{{ old('number_children', $record->number_children) }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel gyerekek kora--}}
            @if(!is_null($record->children_age))
                <div class="row">
                    <label for="children_age"
                           class="col-sm-3">@lang('messages.clients_datapage_children_age_label')</label>
                    <div class="col-sm-9">
                        <span>{{ old('children_age', $record->children_age) }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel iskola--}}
            @if(!is_null($requiredSchools))
                <div class="row">
                    <label for="required_school_enum"
                           class="col-sm-3">@lang('messages.clients_datapage_required_school_label')</label>
                    <div class="col-sm-9">
                        <span>{{ $requiredSchools }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel kisallat--}}
            @if(!is_null($record->pet))
                <div class="row">
                    <label for="pet" class="col-sm-5">@lang('messages.clients_datapage_pet_label')</label>
                    <div class="col-sm-7">
                        <span>{{ old('pet', $record->pet) }}</span>
                    </div>
                </div>
            @endif
            {{--Ugyfel tervezett kotlozes--}}
            @if(!is_null($record->moveindate))
                <div class="row">
                    <label for="moveindate"
                           class="col-sm-3">@lang('messages.clients_datapage_moveindate_label')</label>
                    <div class="col-sm-9">
                        <span>{{ old('moveindate', $record->moveindate) }}</span>
                    </div>
                </div>
            @endif
            {{--Megjegyzes--}}
            @if(!is_null($record->comment))
                <div class="row">
                    <label for="comment"
                           class="col-sm-12">@lang('messages.clients_datapage_comment_label')</label>
                    <div class="col-sm-7">
                        <span>{{ old('comment', $record->nationality) }}</span>
                    </div>
                </div>
            @endif
            {{-- Preferalt kapcsolat --}}
            @if(!is_null($preferredContacts))
                <div class="row">
                    <label for="preferred_contact_enum"
                           class="col-sm-3">@lang('messages.clients_datapage_preferred_contact_label')</label>
                    <div class="col-sm-9">
                        <span>{{ $preferredContacts }}</span>
                    </div>
                </div>
            @endif
            {{-- Ugyintezo --}}
            @if(!is_null($coWorkers))
                <div class="row">
                    <label for="broker_id"
                           class="col-sm-3">@lang('messages.clients_datapage_broker_label')</label>
                    <div class="col-sm-9">
                        <span>{{ $coWorkers->name }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
