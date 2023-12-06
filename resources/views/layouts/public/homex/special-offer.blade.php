@php
    /**
    * @var \App\Models\ClientRequirement $record
    * @var \App\Models\Client $client
    */
@endphp

@extends('layouts.public.homex.base')

@section('htmlheader')
@endsection


@section('descendant-site')

@include('layouts.public.homex.header-four')

<!--	Banner
===============================================================-->
<div class="page-banner bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumbs color-secondery">
                    <ul>
                        <li class="hover_gray"><a href="#">Home</a></li>
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">@lang('public.mainmenu_offer_pages_label')</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">@lang('public.mainmenu_offer_pages_label')</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--	Content
===============================================================-->
<section class="full-row">
    <div class="container">
        {{-- TODO: 1) normális megjelenítés, 2) végleges felirat fordítása --}}
        <a href="{{ route('realEstatePublicList', $searchParameters) }}">Elképzeléseimnek megfelelő ingatlanok listája</a>
    </div>

</section>


@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
