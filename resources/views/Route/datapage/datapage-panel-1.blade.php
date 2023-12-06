@php
    /**
    * @var \App\Models\Route $record
    * @var \App\Models\Client[] $clients
    * @var \App\Models\Client[] $coWorkers
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                @lang('messages.routes_datapage_panel_1_title_caption')
            </button>
        </h5>
    </div>

    <div id="collapse-1" class="collapse @if (!$record->id) {{ 'show' }} @endif" aria-labelledby="heading-1" data-parent="#leftSections">
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="name" class="col-form-label">@lang('messages.routes_datapage_offer_label')</label>
                        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'name'])" name="name" value="{{$record->offer->name}}" disabled>
                        @include('inc.field-error-message', ['fieldName' => 'name'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="client_id" class="col-form-label">@lang('messages.routes_datapage_client_label')</label>
{{--                        {{ dd($clients) }}--}}
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'client_id'])" name="client_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}" @if (old('client_id', $record->client_id) === $item->id) selected @endif>{{ $item->user->name }}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'client_id'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="date" class="col-form-label">@lang('messages.routes_datapage_date_label')</label>
                        <div class="input-group">
                            <input type="text" class= "form-control date @include('inc.field-invalid-class', ['fieldName' => 'date'])" name="date" value="{{ old('date', $record->date) }}" placeholder="datetime">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'date'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="meeting_location" class="col-form-label">@lang('messages.routes_datapage_meeting_location_label')</label>
                        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'meeting_location'])" name="meeting_location" value="{{ old('meeting_location', $record->meeting_location) }}">
                        @include('inc.field-error-message', ['fieldName' => 'meeting_location'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="presenter_id" class="col-form-label">@lang('messages.routes_datapage_presenter_id_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'presenter_id'])" name="presenter_id">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($coWorkers as $item)
                                <option value="{{$item->user->id}}" @if (old('presenter_id', $record->presenter_id) == $item->user->id) selected @endif>{{$item->user->name}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'presenter_id'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="created_by_id" class="col-form-label">@lang('messages.routes_datapage_created_by_label')</label>
                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'created_by_id'])" name="created_by_id" disabled>
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach ($coWorkers as $item)
                                <option value="{{$item->user->id}}" @if (old('created_by_id', $record->created_by_id) == $item->user->id) selected @endif>{{$item->user->name}}</option>
                            @endforeach
                        </select>
                        @include('inc.field-error-message', ['fieldName' => 'created_by_id'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="comment" class="col-form-label">@lang('messages.routes_datapage_comment_label')</label>
                        <input type="text" class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'comment'])" name="comment" value="{{ old('comment', $record->comment) }}" />
                        @include('inc.field-error-message', ['fieldName' => 'comment'])
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="created_at" class="col-form-label">@lang('messages.routes_datapage_created_at_label')</label>
                        <div class="input-group">
                            <input type="text" class= "form-control date @include('inc.field-invalid-class', ['fieldName' => 'created_at'])" disabled name="created_at"
                                   value="{{ old('created_at', $record->created_at) }}" placeholder="datetime">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            @include('inc.field-error-message', ['fieldName' => 'created_at'])
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
