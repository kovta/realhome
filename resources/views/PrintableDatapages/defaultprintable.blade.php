@section('head')
<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8" />
{{--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
    {{--
        CSS wkhtml2pdf HACK infó:
        1) csak bootstrap 4.0 ! (a css3 flex -et nem ismeri a wkhtml2pdf csak float-tal megy) ÉS
        2) külső css fáljból nem működik sehogy az alábbi bootstrap behúzás, full url-el sem, kizárólag csak inline!
    --}}
    <style>@include('PrintableDatapages.inc.bootstrap4-0');</style>
    {{-- Bootstrap-en kívül, minden más css fájl, font, stb. import és külső behúzás működik --}}
    {{-- nyomtatásin ézethez, pdf-hez az alapértelmezett css --}}
    <link href="{{ asset(mix('css/global/printable/default-print.css')) }}" rel="stylesheet">
    {{-- előző alap css kiterjesztése a kiterjesztett/child template-ekben az alábbi blokkba behúzott css-ekből mehet. --}}
    @yield('css-links')
    <title>Realhome - @yield('title')</title>
</head>
@show
<body>
@yield('header')
@yield('content')
@yield('footer')
@yield('javascript')
</body>
</html>
