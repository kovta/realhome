@php
    /**
    * @var \App\Http\FileManager $fileManager
    * @var \Spatie\MediaLibrary\Models\Media[] $files
    */


    // layout based on: https://bootsnipp.com/snippets/67z63
@endphp

<div class="col-12">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">@lang('messages.filemanager_item_list_col_thumb_caption')</th>
            <th scope="col">@lang('messages.filemanager_item_list_col_name_caption')</th>
            <th scope="col">@lang('messages.filemanager_item_list_col_meta_caption')</th>
            <th scope="col">@lang('messages.filemanager_item_list_col_manage_caption')</th>
        </tr>
        </thead>
        <tbody id="sortableRows">
        @foreach ($files as $key => $file)
            <tr data-id="{{ $file->id }}">
                <td>
                    <img src="{{ $file->getUrl('admin-list-thumb') }}">
                </td>
                <td>
                    {{ $file->name }}
                </td>
                <td>
                    @lang('messages.filemanager_item_size_caption'): {{ \App\Http\FileManager::formatFileSize($file->size) }}
                    <br>
                    <span style="{{ ($file->getCustomProperty('featured') == 1) ? 'font-weight:bold' : '' }}">
                        @lang('messages.filemanager_item_featured_caption'): {{ ($file->getCustomProperty('featured') == 1) ? __('messages.yes') : __('messages.no') }}
                    </span>
                    <br>{{ 'order_column='.$file->order_column }}
                    {{--<br>[{{ $key }}] : {{ 'id='.$file->id.'order_column='.$file->order_column }}--}}
                </td>
                <td>
                    <button class="btn btn-secondary btn-sm" onclick="fm.setFeatured({{ $key }})" >@lang('messages.filemanager_item_featureit_caption')</button>
                    <button class="btn btn-secondary btn-sm" onclick="if (confirm('@lang('messages.crud_delete_confirm_text')')) fm.deleteItem({{ $key }})" >@lang('messages.filemanager_item_delete_caption')</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
