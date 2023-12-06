@php
    /**
    * @var \App\Models\Route $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.routes_datapage_title_caption'))

@section('message-area')
    @if(session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.routes_datapage_title_caption')</div>
        @if(is_null($noClient))
            <div class="alert alert-warning" role="alert">
                @lang('messages.routes_sending_not_available')
            </div>
        @endif
        <div class="admin-toolbar">
            {{-- ha nincs felvéve ingatlan az útitervbe, akkor ne engedjen nyomtatni/pdf-et generálni (inaktív linkek) --}}
            @if ( !empty($record->routeComponents) && $record->routeComponents->count() )
                <a class="btn btn-secondary btn-sm" href="{{ route('realEstateRoutes.printableDatapage', [$record->id]) }}" target="_blank"><i class="fas fa-map-marked-alt"></i> Útiterv nyomtatás</a>
{{--                ez miért volt disabled-re rakva? mert jelenleg nincs ilyen funkció --}}
{{--                <a class="btn btn-secondary btn-sm" href="#"><i class="fas fa-paper-plane"></i> Útiterv küldés</a>--}}
                <a class="btn btn-secondary btn-sm @if(is_null($noClient)) disabled @endif" href="{{ route('realEstateRoutes.sendmailPage', [$record->id]) }}"><i class="fas fa-paper-plane"></i> Útiterv küldés</a>
{{--                 Ezek nem működnek: valamiért csak egyetlen pdf-et tesz be az ajánlat pdf-be:   --}}
{{--                <a class="btn btn-secondary btn-sm" href="{{ route('realEstateOffers.printableDatapageForPdfConversion', [$record->offer->id, 1]) }}" target="_blank"><i class="fas fa-folder"></i> Ajánlatként nyomtatás</a>--}}
{{--                <a class="btn btn-secondary btn-sm @if(is_null($noClient)) disabled @endif" href="{{ route('realEstateOffers.sendmailPage', [$record->offer->id]) }}"><i class="fas fa-paper-plane"></i> Ajánlatként küldés</a>--}}
            @else
                <a class="btn btn-secondary btn-sm disabled" href="#"><i class="fas fa-map-marked-alt"></i> Útiterv nyomtatás</a>
                <a class="btn btn-secondary btn-sm disabled" href="#"><i class="fas fa-paper-plane"></i> Útiterv küldés</a>
                <a class="btn btn-secondary btn-sm disabled" href="#"><i class="fas fa-map-marked-alt"></i> Ajánlatként nyomtatás</a>
                <a class="btn btn-secondary btn-sm disabled" href="#"><i class="fas fa-paper-plane"></i> Ajánlatként küldés</a>
            @endif

        </div>

        <form method="POST" action="{{route('realEstateRoutes.update', [$record->id])}}">
            @csrf
            @method('PUT')

            <div class="row" style="margin-bottom: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>

            @include('Route.datapage.datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>


    </div>
@endsection
