@php
    /**
    * @var \App\Models\RealEstate $record
    */

    use \App\User;
@endphp

<div class="card">
    <div class="card-header" id="meta-heading-3">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#meta-collapse-3" aria-expanded="true" aria-controls="meta-collapse-3">
                @lang('messages.real_estates_datapage_right_col_panel_3_caption')
            </button>
        </h5>
    </div>

    <div id="meta-collapse-3" class="collapse show" aria-labelledby="meta-heading-3" data-parent="#rightSections">
        <div class="card-body">

            <div class="form-group row">
                <label for="created_by" class="col-6 col-form-label">@lang('messages.real_estates_datapage_created_by_label')</label>
                <div class="col-6">
                    <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'created_by_id'])" name="created_by_id" value="{{$record->created_by_id}}" disabled>
                        <option value="">@lang('messages.combobox_empty_caption')</option>
                        @foreach ($coWorkers as $item)
                            <option value="{{$item->user->id}}" @if ($record->created_by_id == $item->user->id) selected @endif>{{$item->user->name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="created_by_id" value="{{ $record->created_by_id }}">
                </div>
            </div>
            {{--
                        <div class="form-group row">
                            <label for="created_by_id" class="col-6 col-form-label">@lang('messages.real_estates_datapage_created_by_label')</label>
                            <div class="col-6">
                                <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'created_by_id'])" readonly name="created_by_id" value="{{$record->created_by_id}}">
                                    <option value="">@lang('messages.combobox_empty_caption')</option>
                                    @foreach ($users as $item)
                                        <option value="{{$item->id}}" @if ($record->created_by_id == $item->id) selected @endif>{{$item->email}}</option>
                                    @endforeach
                                </select>
                                @include('inc.field-error-message', ['fieldName' => 'created_by_id'])
                            </div>
                        </div>
            --}}

            <div class="form-group row">
                <label for="updated_at" class="col-6 col-form-label">@lang('messages.real_estates_datapage_updated_at_label')</label>
                <div class="col-6">
                    <div class="input-group">
                        <input type="text" class= "form-control date @include('inc.field-invalid-class', ['fieldName' => 'updated_at'])" readonly name="updated_at" data-provide="datepicker" value="{{$record->getLastModified()}}" placeholder="datetime">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                        </div>
                        @include('inc.field-error-message', ['fieldName' => 'updated_at'])
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="score" class="col-6 col-form-label">@lang('messages.real_estates_datapage_score_label')</label>
                <div class="col-6">
                    <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'score'])" name="score" value="{{ old('score', $record->score) }}" placeholder="datetime">
                    @include('inc.field-error-message', ['fieldName' => 'score'])
                </div>
            </div>

            <div class="form-group row">
                <label for="web_appearances" class="col-6 col-form-label">@lang('messages.real_estates_datapage_web_appearances_label')</label>
                <div class="col-6">
                    <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'web_appearances'])" readonly name="web_appearances" value="{{$record->web_appearances}}" placeholder="">
                    @include('inc.field-error-message', ['fieldName' => 'web_appearances'])
                </div>
            </div>

            <div class="form-group row">
                <label for="web_interestes" class="col-6 col-form-label">@lang('messages.real_estates_datapage_web_interestes_label')</label>
                <div class="col-6">
                    <input type="text" class= "form-control decimal @include('inc.field-invalid-class', ['fieldName' => 'web_interestes'])" readonly name="web_interestes" value="{{$record->web_interestes}}" placeholder="">
                    @include('inc.field-error-message', ['fieldName' => 'web_interestes'])
                </div>
            </div>


        </div>
    </div>
</div>
