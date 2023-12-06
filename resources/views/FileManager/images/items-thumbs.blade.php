@php
    /**
    * @var \App\Http\FileManager $fileManager
    * @var \Spatie\MediaLibrary\Models\Media[] $files
    */


    // layout based on: https://bootsnipp.com/snippets/67z63
@endphp

@foreach ($files as $key => $file)
    <div class="col-sm-6 col-md-4 col-lg-2 mt-4">
        <div class="card">
            <div class="order-setting" data-key="{{ $key }}" data-order="0"></div>
            <img class="card-img-top" src="{{ $file->getUrl('admin-thumb') }}">
            <div class="card-block">
                <h4 class="card-title">{{ $file->name }}</h4>
                <div class="meta">
                    size: {{ \App\Http\FileManager::formatFileSize($file->size) }} <br>
                    featured: {{ ($file->getCustomProperty('featured') == 1) ? 'yes' : 'no' }}
                </div>

                <div class="card-text">
                    Tawshif is a web designer living in Bangladesh.
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-secondary btn-sm" onclick="fm.setFeatured({{ $key }})" >Feature it</button>
                <button class="btn btn-secondary btn-sm" onclick="if (confirm('@lang('messages.crud_delete_confirm_text')')) fm.deleteItem({{ $key }})" >Delete</button>
            </div>
        </div>
    </div>
@endforeach
