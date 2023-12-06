@php
    /**
    * @var \App\Models\ClientRequirement $record
    */
@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Kliens elképzelés e-mail')

@section('content')

    <div class="row">
        <div class="col-12" style="border: 1px dotted grey; height: 100px;">
            fejléc
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2>Kliens elképzelés érkezett / változott!</h2>

            <>Azért kaptad ezt az e-mailt, mert '{{ $record->client->name }}' ügyfelünk megváltoztatta ingatlanos elképzeléseit.<br>
            Ez egy automatikus üzenet, ne válaszolj rá. Minden admin megkapta. Az új elképzelés adatai a következők:</p>
            <pre>
            {{ (string) $record }}
            </pre>
        </div>
    </div>

@endsection
