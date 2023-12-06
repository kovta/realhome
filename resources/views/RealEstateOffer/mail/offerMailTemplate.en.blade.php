@php
    /**
    * @var \App\Models\RealEstateOffer $offer
    */
@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Ajánlat e-mail')

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Tisztelt Ügyfelünk!</h2>

        <p>Ajánlatát az alábbi linkre kattintva tekintheti meg:<br/>
            <a target="_blank" href="{{ $pdflink }}">AJÁNLAT</a>.
        </p>

        <p>Felhívjuk szíves figyelmét, hogy a link 10 napig érvényes.<br/>
        Kérdéseivel vagy az ingatlanok megtekintésével kapcsolatban keressen a +36 70 335 8000-es telefonszámon.</p>

        <p>Üdvözlettel,<br/>
        {{ $offer->createdBy->name }}
        </p>
    </div>
</div>

@endsection
