@php
    /**
    * @var \App\Models\RealEstate $record
    * @var \App\User $record->user
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-3">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="true" aria-controls="collapse-3">
                @lang('messages.clients_datapage_panel_3_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-3" class="collapse show" aria-labelledby="heading-3" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    <label for="nationality" class="col-form-label">@lang('messages.clients_datapage_nationality_label')</label>
                    <div class="form-group">
                        <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'nationality'])" name="nationality" value="{{ old('nationality', $record->nationality) }}">
                        @include('inc.field-error-message', ['fieldName' => 'nationality'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="number_tenants" class="col-form-label">@lang('messages.clients_datapage_number_tenants_label')</label>
                        <div class="input-group">
                            <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'number_tenants'])" name="number_tenants" value="{{ old('number_tenants', $record->number_tenants) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">fő</span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'number_tenants'])
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="number_children" class="col-form-label">@lang('messages.clients_datapage_number_children_label')</label>
                        <div class="input-group">
                            <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'number_children'])" name="number_children" value="{{ old('number_children', $record->number_children) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">fő</span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'number_children'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="children_age" class="col-form-label">@lang('messages.clients_datapage_children_age_label')</label>
                    <div class="form-group">
                        <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'children_age'])" name="children_age" value="{{ old('children_age', $record->children_age) }}">
                        @include('inc.field-error-message', ['fieldName' => 'children_age'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="required_school_enum" class="col-form-label">@lang('messages.clients_datapage_required_school_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'required_school_enum'])" name="required_school_enum">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($requiredSchools as $item)
                                <option value="{{$item->id}}" {{$item->gui_selected}}>{{$item->caption}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'required_school_enum'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="pet" class="col-form-label">@lang('messages.clients_datapage_pet_label')</label>
                    <div class="form-group">
                        <input type="text" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'pet'])" name="pet" value="{{ old('pet', $record->pet) }}">
                        @include('inc.field-error-message', ['fieldName' => 'pet'])
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="moveindate" class="col-form-label">@lang('messages.clients_datapage_moveindate_label')</label>
                        <div class="input-group">
                            <input type="text" class="form-control date @include('inc.field-invalid-class', ['fieldName' => 'moveindate'])" name="moveindate" data-provide="datepicker"
                                   value="{{ old('moveindate', $record->moveindate) }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'moveindate'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <label for="comment" class="col-form-label">@lang('messages.clients_datapage_comment_label')</label>
                    <textarea class="form-control @include('inc.field-invalid-class', ['fieldName' => 'comment'])" name="comment">{{ old('comment', $record->comment) }}</textarea>
                    @include('inc.field-error-message', ['fieldName' => 'comment'])
                </div>
            </div>

        </div>
    </div>
</div>
