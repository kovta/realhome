@php
    use App\Models\Enum\RealEstateContractTypeEnum;
    use App\Models\Enum\RealEstateKitchenTypeEnum;
    use App\Models\Enum\RealEstateOrientationEnum;
    /**
    * @var \App\Models\Route $route
    * @var string $locale
    */

    $alphas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
@endphp
<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400&display=swap" rel="stylesheet">
    {{--    <link href="{{ asset(mix('css/global/printable/datapage-real-estates.css')) }}" rel="stylesheet">--}}
    {{--    <link href="https://realhome.hu/css/global/printable/datapage-real-estates.css" rel="stylesheet">--}}
    {{-- előző alap css kiterjesztése a kiterjesztett/child template-ekben az alábbi blokkba behúzott css-ekből mehet. --}}
    @yield('css-links')
    <title>Realhome - Ajánlat út adatlap</title>
    <style>
        html {
            margin: 0;
            padding: 0;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            color: #2c2e35;
        }
        div,p,h1,h2,h3,td,tr {
            padding:0;
            margin:0;
        }
        .page {
            width: 90vw;
            min-height: 100vh;
            margin:0 auto;
            padding:0;
            /*background-color:red;*/
        }
        .new-page {
            page-break-before: always;
        }
        table.greentable {
            width:100%;
            margin:0;
            padding:0;
            border:0;
            border-spacing: 0;
        }
        table.greentable td {
            padding: 5px 0px;
            font-size:13px;
            font-weight:400;
        }
        table.greentable td b {
            font-weight:bold;
        }
        table.greentable td:first-child {
            width: 32%;
            padding-left: 30px;
        }
    </style>
</head>
@foreach($realestateoffer->realEstates as $item)
@if(!$loop->first)
<div class="new-page"></div>
@endif
<div class="page">
    {{-- pdf fejléc --}}
    @include('PrintableDatapages.inc.pdfheader')
    {{-- cím és ID --}}
    @include('PrintableDatapages.inc.pdfnameandcode')
    {{-- CONTENT --}}
    <div class="content">
        {{-- főkép --}}
        @include('PrintableDatapages.inc.pdfmainimage')
        {{-- zöld doboz: kulcs-érték felsorolások --}}
        @include('PrintableDatapages.inc.pdfgreenfield')
        {{-- pipák doboz: kulcs-érték felsorolások --}}
        @include('PrintableDatapages.inc.pdfpipes')
        {{-- bal oldali szöveg doboz, jobb oldali kisméretű kép --}}
        @include('PrintableDatapages.inc.pdfdetailsandsmallimage')
    </div>
    {{-- pdf lábléc --}}
    @include('PrintableDatapages.inc.pdffooter')
</div>
<div class="new-page"></div>
{{-- ha nem egyoldalas pdf-et kértek, kellenek a képek is --}}
@if($realestateoffer->one_page_limit !== 1)
<div class="page">
    {{-- pdf fejléc --}}
    @include('PrintableDatapages.inc.pdfheader')
    {{-- cím és ID --}}
    @include('PrintableDatapages.inc.pdfnameandcode')
    {{-- CONTENT --}}
    <div class="content" >
        {{-- második olali nagy kép --}}
        @include('PrintableDatapages.inc.pdfsecondpage')
        {{-- második olali nagy kép --}}
    </div>
    {{-- pdf lábléc --}}
    @include('PrintableDatapages.inc.pdffooter')
</div>
@endif
@endforeach
