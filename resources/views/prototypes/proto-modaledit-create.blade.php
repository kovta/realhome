@php
    /**
    * @var int $showInIframe
    * @var string $ancestorTemplate
    * @var \App\Models\AdvertisingPartner $record
    */

    $showInIframe = app('request')->input('showInIframe');

@endphp


@extends(($showInIframe == 1) ? 'main' : 'defaultpage')


@section('title', __('messages.advertisingpartners_list_title_caption'))


@section('content')

    @if ($showInIframe != 1)
    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.advertisingpartners_datapage_title_caption')</div>
    @endif

        <form method="POST" action="{{route('modalEditPrototypes.store', [$record->id])}}">
            @csrf
            @method('POST')
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">@lang('messages.advertisingpartners_datapage_name_label')</label>
                    <div class="col-sm-10">
                        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{$record->name}}">
                        @include('inc.field-error-message', ['fieldName' => 'name'])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang('messages.button_save_caption')</button>
    @if ($showInIframe == 1)
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="parent.jQuery('#crudModal').modal('hide');">@lang('messages.button_close_caption')</button>
    @endif
            </div>
        </form>

    @if ($showInIframe != 1)
    </div>
    @endif

@endsection
