<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">@lang('messages.clientusers_datapage_name_label')</label>
    <div class="col-sm-10">
        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{ old('name', $record->user->name) }}" required>
        @include('inc.field-error-message', ['fieldName' => 'name'])
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">@lang('messages.clientusers_datapage_email_label')</label>
    <div class="col-sm-10">
        <input type="email" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'email'])" name="email" value="{{ old('email', $record->user->email) }}" required>
    </div>
    @include('inc.field-error-message', ['fieldName' => 'email'])
</div>

<div class="row">
    <label for="phone_1" class="col-12 col-form-label">@lang('messages.clientusers_datapage_phones_label')</label>
    <div class="col-6">
        <div class="form-group">
            <input type="tel" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'phone_1'])" name="phone_1"
                   value="{{ old('phone_1', $record->phone_1)}}" placeholder="@lang('messages.clientusers_datapage_phone-1_placeholder')">
            @include('inc.field-error-message', ['fieldName' => 'phone_1'])
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <input type="tel" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'phone_2'])" name="phone_2"
                   value="{{ old('phone_2', $record->phone_2) }}" placeholder="@lang('messages.clientusers_datapage_phone-2_placeholder')">
            @include('inc.field-error-message', ['fieldName' => 'phone_2'])
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-check">
{{--            <label for="role" class="col-form-label">@lang('messages.clientusers_datapage_role_label')</label>--}}
            <input class="form-check-input" type="checkbox" name="user_create" id="user_create" value="true">
            <label class="form-check-label" for="user_create">
                @lang('messages.clientusers_datapage_create_user_checkbox')
            </label>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12">

        <div class="form-group">
                @foreach ($roles as $item)
                    @if($item->name === 'clients')
                        <input type="hidden" value="{{$item->name}}" name="roles">
                    @endif
                @endforeach
        </div>

    </div>
</div>
