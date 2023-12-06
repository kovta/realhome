@php
    /**
    * @var \App\Models\Route $route
    */
@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Útvonal e-mail')

@section('content')

{{--    <div class="row">--}}
{{--        <div class="col-12" style="border: 1px dotted grey; height: 100px;">--}}
{{--            fejléc--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="col-12">
            <h2>Tisztelt {{ $route->client->name }}!</h2>

            <p>{{ $comment }}</p>

            <p>Az összeállított útvonalat tekintse meg <a target="_blank" href="{{ $pdflink }}">itt</a>.</p>

            <p>Üdvözlettel,<br>
            {{ $route->createdBy->name }}
            </p>
        </div>
    </div>

@endsection
