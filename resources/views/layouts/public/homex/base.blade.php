<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Estates that make a difference">
    <meta name="keywords" content="">
    <meta name="author" content="Unicoder">

    <!-- og -->
    @if(!empty($ogTitle))
        <meta property="og:title" content="{{ $ogTitle }}" />
    @endif
    @if(!empty($ogDescription))
        <meta property="og:description" content="{{ $ogDescription }}" />
    @endif
    @if(!empty($ogUrl))
        <meta property="og:url" content="{{ $ogUrl }}" />
    @endif
    @if(!empty($ogType))
        <meta property="og:type" content="{{ $ogType }}" />
    @endif
    @if(!empty($fbAppId))
        <meta property="fb:app_id" content="{{ $fbAppId }}" />
    @endif
    @if(!empty($ogSiteName))
        <meta property="og:site_name" content="{{ $ogSiteName }}" />
    @endif
    @if(!empty($ogImage))
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    @if(!empty($ogImageSecureUrl))
        <meta property="og:image:secure_url" content="{{ $ogImageSecureUrl }}">
    @endif
    @if(!empty($ogImageType))
        <meta property="og:image:type" content="{{ $ogImageType }}">
    @endif
    @if(!empty($ogImageWidth))
        <meta property="og:image:width" content="{{ $ogImageWidth }}" />
    @endif
    @if(!empty($ogImageHeight))
        <meta property="og:image:height" content="{{ $ogImageHeight }}" />
    @endif
    @if(!empty($ogImageAlt))
        <meta property="og:image:alt" content="{{ $ogImageAlt }}" />
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('vendor/homex/images/favicon.ico') }}">

    {{-- webpack mix css --}}
    <link href="{{ asset('css/frontoffice/frontoffice.css') }}" rel="stylesheet">

    <!--	Fonts
    ========================================================-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!--	Css Link
    ========================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/bootstrap-slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/layerslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/color.css') }}" id="color-change">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/homex/fonts/flaticon/flaticon.css') }}">
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('{{ env("RECAPTCHA_SITE_KEY") }}', {action: 'submit'}).then(function (token) {
                // add token value to form
                document.getElementById('g_recaptcha_response').value = token;
                console.log('Captcha token: ' + document.getElementById('g_recaptcha_response').value);
            })
        })
    </script>

    @yield('htmlheader')

    <!--	Title
    =========================================================-->
    <title>{{ config('app.name', 'Real Home Demo Site') }}</title>
</head>
<body>

<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>
-->

@yield('descendant-site')

<!-- Scroll to top -->
<a href="#" class="bg-default color-white" id="scroll"><i class="fas fa-angle-up"></i></a>
<!-- End Scroll To top -->

@yield('htmlfooter')

@section('javascript')
    <script src="{{ asset('js/frontoffice/manifest.js') }}"></script>
    <script src="{{ asset('js/frontoffice/vendor.js') }}"></script>
    <script src="{{ asset('js/frontoffice/frontoffice.js') }}"></script>

    <script src="{{ asset('vendor/homex/js/greensock.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/layerslider.transitions.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/layerslider.kreaturamedia.jquery.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/homex/js/bootstrap.min.js') }}"></script> már be van húzva! --}}
    <script src="{{ asset('vendor/homex/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/tmpl.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/jquery.dependClass-0.1.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/draggable-0.1.js') }}"></script>
    <script src="{{ asset('vendor/homex/source/egorkhmelev-jslider-696822f/js/jshashtable-2.1_src.js') }}"></script>
    <script src="{{ asset('vendor/homex/source/egorkhmelev-jslider-696822f/js/jquery.numberformatter-1.2.3.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/jquery.slider.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/wow.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/YouTubePopUp.jquery.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/validate.js') }}"></script>
    <script src="{{ asset('vendor/homex/js/custom.js') }}"></script>
    <script type="text/javascript">

        var applicationLocale = '{{App::getLocale()}}';

        function favoriteRealEstateClick(id, starElement){
            $.post('{{ route('realEstatePublicMarkasfavorite') }}', { _token: '{{ csrf_token() }}', id: id } )
                .done(function (result) {
                    if (result.status === 'set') {
                        $(starElement).css('color', $(starElement).attr('data-activecolor') );
                        $(starElement).find('i').attr('class', 'fas fa-star');
                    }
                    if (result.status === 'del') {
                        $(starElement).css('color', $(starElement).attr('data-inactivecolor') );
                        $(starElement).find('i').attr('class', 'far fa-star');
                    }
                })
                .fail(function () {
                })
                .always(function () {
                });
        }


        $('.selectpicker').selectpicker({
            // style: '',
            styleBase: 'btn selectpicker-fix',
            noneSelectedText: '@lang('messages.combobox_multiple_empty_caption')'
        });

    </script>
@show

</body>
</html>
