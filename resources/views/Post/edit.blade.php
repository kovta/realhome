@php
    /**
    * @var \App\Models\Post $record
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.posts_datapage_title_caption'))

@section('message-area')
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="row">
            <div class="admin-form-title"><i class="fas fa-edit"></i> @lang('messages.post_datapage_title_caption')</div>
        </div>
        <div class="row">
            {{-- Szovegtartalmi mezok--}}
            <div class="col-6">
                <form method="POST" action="{{route('posts.update', [$record->id])}}">
                    @csrf
                    @method('PUT')

                    @include('Post.datapage-body')

                    <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
                </form>
            </div>
            {{-- kepfeltolto reszek --}}
            <div class="col-6">

                <form id="postImageUploadForm" method="POST" action="{{ route('posts.uploadimage') }}" enctype="multipart/form-data">
                    <input name="postId" type="hidden" value="{{ $record->id }}"/>
                    @csrf
                    @method('POST')
                    <div class="form-group row col-12">
                        <!-- my file upload -->
                        <label for="dokumentumNev" class="col-lg-12 col-form-label" style="justify-content: left;">@lang('messages.post_datapage_image_label')</label>
                        <div class="input-group col-12 fileupload">
                            <input id="dokumentumNev" name="dokumentumNev" type="file" onchange="$('#dokumentumNevInput').val($(this).val().replace('C:\\fakepath\\', ''));"/>
                            <input id="dokumentumNevInput" type="text" class="form-control" placeholder="filename">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" onclick="$('#dokumentumNev').click();return false;">@lang('messages.filemanager_upload_browse_caption')</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-12" style="padding-left: 20px;">
                        @if(!$hasImage)
                            <button class="btn btn-secondary" style="margin: 0 10px;" type="submit">@lang('messages.filemanager_upload_caption')</button>
                        @else
                            <button class="btn btn-secondary" style="margin: 0 10px;" onclick="if (confirm('@lang('messages.crud_delete_confirm_text')')) erasePostImage({{ $record->id }})" >@lang('messages.filemanager_item_delete_caption')</button>
                            <i class="fas fa-2x fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Új kép feltöltése abban az esetben, ha már létezik a bloghoz kép, a megvalósítása akkor lehetséges, ha a korábbi lép törlése, majd pedig az új fájlt feltöltése. 1: Töltsük fel az új képet. 2: Kattintsuk a törlés gombra."></i>
                        @endif
                    </div>
                    <div class="form-group row col-12">
                        <img id="featuredImage" src="{{ $record->getPublicListThumbImage() }}" style="display: block; border: 1px solid silver; border-radius: 3px; padding: 15px;  margin: 15px;">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('javascript')
    <script type="text/javascript">
        $("#postImageUploadForm").on('submit', function(e) {
            e.preventDefault();
            console.log('uploadPostImage');

            $.ajax({
                url:"{{ route('posts.uploadimage') }}",
                method:"POST",
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(result)
                {
                    console.log(result.status);
                    $('#featuredImage').attr('src', result.imagePath);
                },
                error: function(e) {
                    if (e.responseJSON.errors != null) {
                        console.log(e.responseJSON.errors.dokumentumNev);
                        alert(e.responseJSON.errors.dokumentumNev[0]);
                    }
                }
            });
        });

        function erasePostImage(id) {
            console.log('erasePostImage');

            $.post('{{ route('posts.eraseimage') }}', {'id': id})
                .done(function (result) {
                    console.log(result);
                    $('#featuredImage').attr('src', result.imagePath);
                })
                .fail(function () {
                })
                .always(function () {
                });
        }

    </script>
@endsection
