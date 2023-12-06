@php
    /**
    * @var array $data
    */
@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Kapcsolatfelvételi kérés e-mail')

@section('content')

    <div class="row">
        <div class="col-12" style="border: 1px dotted grey; height: 100px;">
            fejléc
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2>Kapcsolatfelvételi kérés érkezett</h2>

            <p>Azért kaptad ezt az e-mailt, mert Kapcsolatfelvételi kérés érkezett a weboldalon keresztül.<br>
            Ez egy automatikus üzenet, ne válaszolj rá. Az üzenet a következő:</p>
            <p></p>
            <p>Küldő: {{ $data['nev'] }}</p>
            <p>Email: {{ $data['email'] }}</p>
            <p>Telefon: {{ $data['telefon'] }}</p>
            <p>Tárgy: {{ $data['targy'] }}</p>
            <p>Üzenet: {{ $data['uzenet'] }}</p>
        </div>
    </div>

@endsection
