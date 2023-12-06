<div class="card">
    <div class="card-header" id="meta-heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#meta-collapse-1" aria-expanded="true" aria-controls="meta-collapse-1">
                @lang('messages.real_estates_datapage_right_col_panel_1_caption')
            </button>
        </h5>
    </div>

    <div id="meta-collapse-1" class="collapse show" aria-labelledby="meta-heading-1" data-parent="#rightSections">
        <div class="card-body">

            <div class="form-group row">
                {{--<label for="comment" class="col-12 col-form-label">@lang('messages.real_estates_datapage_comment_label')</label>--}}
                <div class="col-12">
                    <textarea class= "form-control @include('inc.field-invalid-class', ['fieldName' => 'comment'])" name="comment"
                              placeholder="@lang('messages.real_estates_datapage_comment_placeholder')"
                              style="min-height: 300px;">{{ old('comment', $record->comment) }}</textarea>
                    @include('inc.field-error-message', ['fieldName' => 'comment'])
                </div>
            </div>

        </div>
    </div>
</div>
