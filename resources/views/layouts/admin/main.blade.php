
{{--
  Minden oldal alap sablonja Ha a navbar es sidebar reszek nincsenek tartalommal toltve, akkor
  a sablon alkalmas modal ablak tartalom (majdani iframe tartalom) megjelenitesere is.
--}}

@php
    //  TODO: ezt innen kiszedni és a keretrendszernek megfelelően megvalósítani:
    if (isset($_GET['refreshMainFrame'])){
        echo('<!doctype html><html><head><script type="text/javascript">window.top.location.reload(true);</script></head></html>');
        die();
    }
@endphp

@section('header')
<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/backoffice/backoffice.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Realhome - @yield('title')</title>
</head>
<body>
@show

@yield('navbar')

<div class="container-fluid" style="@yield('container-style')">
    <div class="row">
        @yield('sidebar')
        <div class="col">
            @yield('message-area')
            @yield('content')
        </div>
    </div>
</div>

@section('footer')

    <script src="{{ asset('js/backoffice/manifest.js') }}"></script>
    <script src="{{ asset('js/backoffice/vendor.js') }}"></script>
    <script src="{{ asset('js/backoffice/backoffice.js') }}"></script>

    <script type="text/javascript">

        var applicationLocale = '{{App::getLocale()}}';

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $(document).keydown(function(e) {
            if(e.altKey && e.keyCode === 83){
                e.preventDefault();
                $('.save').click();
            }
        });
    </script>

    @include('inc.tinymce')

@show

@yield('javascript')

<div id="crudModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <iframe id="crudModalContent" frameborder="0" style="width: 100%;"></iframe>
        </div>
    </div>
</div>
</body>
</html>
