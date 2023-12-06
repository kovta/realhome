@php
    /**
    * @var \App\Http\FileManager $fileManager
    * @var \Spatie\MediaLibrary\Models\Media[] $files
    * @uses \App\Http\FileManager
    */


    // layout based on: https://bootsnipp.com/snippets/67z63
@endphp

<div class="col-12">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Meta</th>
            <th scope="col">Manage</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($files as $key => $file)
            <tr>
                <td>
                    {{ $file->name }}
                </td>
                <td>
                    size: {{ \App\Http\FileManager::formatFileSize($file->size) }}
                </td>
                <td>
                    <a class="btn btn-secondary btn-sm"  href="{{ route('realEstates.selectContract') }}?fmkey={{ $fileManager->sessionKey }}&key={{ $key }}">Select it</a>
                    <a class="btn btn-secondary btn-sm" href="{{ route('filemanagerDownload') }}?fmkey={{ $fileManager->sessionKey }}&key={{ $key }}">Download</a>
                    <button class="btn btn-secondary btn-sm" onclick="if (confirm('@lang('messages.crud_delete_confirm_text')')) fm.deleteItem({{ $key }})" >Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
