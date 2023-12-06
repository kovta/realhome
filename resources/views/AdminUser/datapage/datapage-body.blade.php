<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">@lang('messages.adminusers_datapage_name_label')</label>
    <div class="col-sm-10">
        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{ old('name', $record->name) }}" required>
        @include('inc.field-error-message', ['fieldName' => 'name'])
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">@lang('messages.adminusers_datapage_email_label')</label>
    <div class="col-sm-10">
        <input type="email" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'email'])" name="email" value="{{ old('email', $record->email) }}" required>
    </div>
    @include('inc.field-error-message', ['fieldName' => 'email'])
</div>

<div class="row" style="height: 20px;"></div>

<div class="row">
    <div class="col-12">

        <div class="form-group">
            <label for="role" class="col-form-label">@lang('messages.adminusers_datapage_role_label')</label>
            <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'role'])" name="role" required>
                <option value="">@lang('messages.combobox_empty_caption')</option>
                @foreach ($roles as $item)
                    {{-- clients-en kívül mehet minden role --}}
                    @if($item->name !=='clients' )
                    <option value="{{$item->id}}" @if ($record->user->hasRole($item->id)) selected @endif>{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
            @include('inc.field-error-message', ['fieldName' => 'role'])
        </div>

    </div>
</div>
