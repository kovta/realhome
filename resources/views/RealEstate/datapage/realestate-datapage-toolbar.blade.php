<div class="admin-toolbar">
    <button class="btn btn-secondary btn-sm" id="formPanelExpanderButton"><i class="fas fa-angle-double-down"></i> @lang('messages.button_expand_panels_caption')</button>
    <button class="btn btn-secondary btn-sm" id="formPanelCollapserButton"><i class="fas fa-angle-double-up"></i> @lang('messages.button_collapse_panels_caption')</button>

    <div class="admin-toolbar-separator"></div>

    <a class="btn btn-secondary btn-sm {{ ($record->id > 0) ? '' : 'disabled' }}"
       href="{{ route('filemanagerIndex') }}?lib=images&entityId={{ $record->id }}&entityType={{ urlencode(get_class($record)) }}">
        <i class="fas fa-images"></i> @lang('messages.real_estates_datapage_gallery_button_caption')
    </a>
    <a class="btn btn-secondary btn-sm {{ ($record->id > 0) ? '' : 'disabled' }}"
       onclick="if ( !confirm('@lang('messages.crud_sure_confirm_text')') ) return false;"
       href="{{ route('realEstates.clone', ['id' => $record->id]) }}">
        <i class="fas fa-clone"></i> @lang('messages.real_estates_datapage_clone_button_caption')
    </a>
</div>
