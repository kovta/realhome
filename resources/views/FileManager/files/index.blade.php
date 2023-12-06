@php
    /**
    * @var \App\Http\FileManager $fileManager
    */


    // based on: https://bootsnipp.com/snippets/67z63
@endphp


@extends('layouts.admin.defaultpage')

@section('title', 'File manager')

@section('message-area')
@endsection

@section('javascript')
    <script type="text/javascript">

        class FileManager {

            constructor(sessionKey, viewType) {
                this.fmKey = sessionKey;
                this.orderCounter = 0;
                this.newOrder = '';
                this.reordering = 0;
                this.viewType = viewType;
                this.self = this;
            }

            loadItems() {
                var fileManager = this;
                console.log('loading width key: ' + fileManager.fmKey);
                $('#itemContainer').load('{{ route('filemanagerItems')  }}?fmKey=' + fileManager.fmKey);
            }

            deleteItem(id) {
                var fileManager = this;
                $.post('{{ route('filemanagerDelete') }}', {'_token': '{{ @csrf_token() }}', 'fmKey': fileManager.fmKey, 'id': id})
                    .done(function (result) {
                        console.log(result);
                    })
                    .fail(function () {
                    })
                    .always(function () {
                        fileManager.loadItems();
                    });
            }

            setFeatured(id) {
                var fileManager = this;
                $.post('{{ route('filemanagerSetFeatured') }}', {
                    '_token': '{{ @csrf_token() }}',
                    'fmKey': fileManager.fmKey,
                    'id': id
                })
                    .done(function (result) {
                        console.log(result);
                    })
                    .fail(function () {
                    })
                    .always(function () {
                        fileManager.loadItems();
                    });
            }

            setItemOrder(event, fileManager) {
                event.preventDefault();
                if ($(event.target).attr('data-order') == 0) {
                    fileManager.orderCounter++;
                    $(event.target).attr('data-order', fileManager.orderCounter);
                    $(event.target).text(fileManager.orderCounter);
                    fileManager.newOrder += ' ' + $(event.target).attr('data-key');
                    console.log(fileManager.newOrder);
                }
            }

            beginReorder(e) {
                e.preventDefault();
                var fileManager = this;
                alert('Click on each item number in the desired order, then click Finish reorder!');
                $('#reorderButton').text('Finish reorder');
                $('#reorderButton').toggleClass('btn-secondary');
                $('#reorderButton').toggleClass('btn-info');
                $('.order-setting').text('?');
                $('.order-setting').show();

                fileManager.reordering = 1;
                fileManager.orderCounter = 0;
                fileManager.newOrder = '';
                $('.order-setting').on('click', function (event) {
                    fileManager.setItemOrder(event, fileManager)
                });
                $('#reorderButton').off('click');
                $('#reorderButton').on('click', function (event) {
                    fileManager.finishReorder(event, fileManager)
                } );
            }

            finishReorder(event, fileManager) {
                console.log('finishReorder');
                event.preventDefault();

                $('#reorderButton').off('click');
                $('#reorderButton').text('Reorder');
                $('#reorderButton').toggleClass('btn-secondary');
                $('#reorderButton').toggleClass('btn-info');

                console.log(fileManager.newOrder);
                $('#reorderButton').on('click', function (e) {
                    fileManager.beginReorder(e);
                });
                fileManager.reordering = 0;

                $.post('{{ route('filemanagerReorder') }}', {
                    '_token': '{{ @csrf_token() }}',
                    'fmKey': fileManager.fmKey,
                    'newOrder': fileManager.newOrder
                })
                    .done(function (result) {
                        console.log(result);
                    })
                    .fail(function () {
                    })
                    .always(function () {
                        fileManager.loadItems();
                    });
            }

            changeView(newView) {
                var fileManager = this;
                fileManager.reordering = 0;
                $.post('{{ route('filemanagerChangeView') }}', {
                    '_token': '{{ @csrf_token() }}',
                    'fmKey': fileManager.fmKey,
                    'newView': newView
                })
                    .done(function (result) {
                        console.log(result);
                        fileManager.viewType = newView;
                    })
                    .fail(function () {
                    })
                    .always(function () {
                        fileManager.loadItems();
                    });
                return false;
            }
        }




        let fm = null;


        function changeView(newView){
            console.log('do changeView to '+newView);
            fm.changeView(newView);
            if (newView == '{{\App\Http\FileManager::$THUMBS_VIEW}}'){
                $('#reorderButton').show();
            } else {
                $('#reorderButton').hide();
            }
        }


        $(document).ready(function () {

            fm = new FileManager('{{ $fileManager->sessionKey }}', '{{ $fileManager->viewType }}');
            console.log(fm.fmKey);
            console.log(fm.viewType);
            fm.loadItems();
            if (fm.viewType == '{{\App\Http\FileManager::$THUMBS_VIEW}}'){
                $('#reorderButton').show();
            } else {
                $('#reorderButton').hide();
            }


            $("#FileManagerUploadForm").on('submit', function(e) {
                e.preventDefault();
                fm.reordering = 0;
                $.ajax({
                    url: '{{ route('filemanagerUpload') }}',
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend : function(){},
                    success: function(result) {
                        console.log(result);
                        fm.loadItems();
                    },
                    error: function(e) {
                        if (e.responseJSON.errors != null) {
                            console.log(e.responseJSON.errors);
                            alert(e.responseJSON.errors);
                        }
                        fm.loadItems();    // az upload "chmod(): Operation not permitted" hibat dob, de lefut
                    }
                });
                console.log('upload');
            });

            $('#reorderButton').on('click', function (e) {
                fm.beginReorder(e);
            });

        });

    </script>
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">{{ $fileManager->ownerName }}'s files</div>

        @php //var_dump($files) @endphp

        <div class="container-fluid">

            <div class="row" style="background-color: #f8f9fa; border: 1px solid #dddddd; margin-bottom: 20px; padding: 5px;">
                <div class="col-lg-6">
                    <form id="FileManagerUploadForm" class="form-inline" method="POST" action="{{ route('filemanagerUpload') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="fmKey" value="{{$fileManager->sessionKey}}">
                        <div class="form-group">
                            <label for="dokumentumNev"></label>
                            <div class="input-group fileupload">
                                <input id="dokumentumNev" name="dokumentumNev" type="file" onchange="$('#dokumentumNevInput').val($(this).val().replace('C:\\fakepath\\', ''));" />
                                <input id="dokumentumNevInput" type="text" class="form-control" placeholder="filename">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" onclick="$('#dokumentumNev').click();return false;">Browse...</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="submit" style="margin: 0 10px;">Upload</button>
                        {{--<button class="btn btn-secondary" style="margin: 0 10px;" onclick="changeView('{{ \App\Http\FileManager::$THUMBS_VIEW }}'); return false;"><i class="fas fa-th"></i></button>--}}
                        {{--<button class="btn btn-secondary" onclick="changeView('{{ \App\Http\FileManager::$LIST_VIEW }}'); return false;"><i class="fas fa-th-list"></i></button>--}}
                        {{--<button id="reorderButton" class="btn btn-secondary" style="margin: 0 10px;">Reorder</button>--}}
                    </form>
                </div>
            </div>

            <div id="itemContainer" class="row" style="border-radius: .28571429rem; box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5; overflow-y: scroll; min-height: 400px; max-height: 700px;">
            </div>
<!--
            <div class="row" style=" border-radius: .28571429rem; box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5; margin-top: 50px; padding: 15px;">
                <div class="col-lg-12">
                    <div class="card-title">Selected file name</div>
                </div>
            </div>
-->
        </div>
    </div>

@endsection
