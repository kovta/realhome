@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                @lang('messages.real_estates_datapage_left_col_panel_1_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">

            @if ($record->id > 0)
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="code" class="col-form-label">@lang('messages.real_estates_datapage_code_label')</label>
                        <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'code'])" name="code" value="{{$record->code}}" readonly>
                        @include('inc.field-error-message', ['fieldName' => 'code'])
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                    @foreach(config('translatable.locales') as $locale)
                    <div class="col-6">
                        <div class="form-group translatable" data-locale="{{$locale}}">
                            <label for="{{$locale}}_marketing_name" class="col-form-label">@lang('messages.real_estates_datapage_marketing_name_label')</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{$locale}}</span>
                                </div>
                                <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => $locale.'.marketing_name'])"
                                       name="{{$locale}}[marketing_name]" value="{{ old($locale.'.marketing_name', $record->{'marketing_name:'.$locale}) }}">
                                @include('inc.field-error-message', ['fieldName' => $locale.'.marketing_name'])
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="status_enum" class="col-form-label">@lang('messages.real_estates_datapage_status_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'status_enum'])" name="status_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($statuses as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'status_enum'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="web_status_enum" class="col-form-label">@lang('messages.real_estates_datapage_web_status_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'web_status_enum'])" name="web_status_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($web_statuses as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'web_status_enum'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="contract_type_enum" class="col-form-label">@lang('messages.real_estates_datapage_contract_type_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'contract_type_enum'])" name="contract_type_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($contract_types as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'contract_type_enum'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <div class="form-check" style="margin: 7px;">
                            <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'commission'])" type="checkbox"
                                   {{ (old('commission', $record->commission) == 1) ? 'checked' : '' }} value="1" id="commission" name="commission">
                            <label class="form-check-label" for="commission">@lang('messages.real_estates_datapage_commission_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'commission'])
                        </div>
                        {{--<label for="commission_contract_id" class="col-form-label">@lang('messages.real_estates_datapage_commission_contract_id_label')</label>--}}
                        <div class="input-group">
                            <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'commission_contract_name'])" id="commission_contract_name" name="commission_contract_name"
                                   value="{{ (!empty($record->commission_contract_id)) ? $record->getMedia('files')->firstWhere('id', '=', $record->commission_contract_id)->name : '' }}" placeholder="select">
                            <input type="hidden" id="commission_contract_id" name="commission_contract_id" value="{{$record->commission_contract_id}}">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" onclick="clearContractClick({{ $record->id }});return false;">Clear</button>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-secondary {{ ($record->id > 0) ? '' : 'disabled' }}"
                                   href="{{ route('filemanagerIndex') }}?lib=files&entityId={{ $record->id }}&entityType={{ urlencode($className = get_class($record)) }}">Files...</a>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'commission_contract_id'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-6">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input @include('inc.field-invalid-class', ['fieldName' => 'presentable'])" type="checkbox"
                                   {{ (old('presentable', $record->presentable) == 1) ? 'checked' : '' }} value="1" id="presentable" name="presentable">
                            <label class="form-check-label" for="presentable">@lang('messages.real_estates_datapage_presentable_label')</label>
                            @include('inc.field-error-message', ['fieldName' => 'presentable'])
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    {{--<a class="btn btn-primary {{ ($record->id > 0) ? '' : 'disabled' }}" href="{{ route('filemanagerIndex') }}?lib=images&entityId={{ $record->id }}&entityType={{ urlencode($className = get_class($record)) }}">Images</a>--}}
                    {{--<a class="btn btn-primary {{ ($record->id > 0) ? '' : 'disabled' }}" href="{{ route('filemanagerIndex') }}?lib=files&entityId={{ $record->id }}&entityType={{ urlencode($className = get_class($record)) }}">Files</a>--}}
                </div>
            </div>

            <div class="form-group row">
                <label for="advertised" class="col-sm-4 col-form-label">@lang('messages.real_estates_datapage_advertised_label')</label>
                <div class="col-sm-8">
                    <select class="form-control selectpicker @include('inc.field-invalid-class', ['fieldName' => 'advertisingPartners'])" name="advertising_partners[]" data-live-search="true" multiple>
                        @foreach($availableAdvertisingPartners as $advertisingPartner)
                            <option value="{{$advertisingPartner->id}}" @if($assignedAdvertisingPartners->first(function($item) use ($advertisingPartner){return $item->id == $advertisingPartner->id;}) ) selected @endif>{{$advertisingPartner->name}}</option>
                        @endforeach
                    </select>
                    @include('inc.field-error-message', ['fieldName' => 'advertisingPartners'])
                </div>
            </div>


        </div>
    </div>
</div>
