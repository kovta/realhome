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
        <h3>Tisztelt Ügyfelünk!</h3>

        <p>Ajánlatát az alábbi linkre kattintva tekintheti meg:<br/>
            <a target="_blank" href="{{ $pdflink }}">AJÁNLAT</a>.
        </p>

        <p>Felhívjuk szíves figyelmét, hogy a link 10 napig érvényes.<br/>
        Kérdéseivel vagy az ingatlanok megtekintésével kapcsolatban keressen a +36 70 335 8000-es telefonszámon.</p>

        <p>Üdvözlettel,<br/>
        {{ $offer->createdBy->name }}
        </p>

        <hr/>

        <h3>Dear Client,</h3>

        <p>You can view our real estate offer at the link below:<br/>
            <a target="_blank" href="{{ $pdflink }}">OFFER LINK</a>.
        </p>

        <p>Please note that the link is valid only for 10 days.<br/>
        Please call us at +36 70 335 8000 with your questions or if you would like us to organize a viewing.</p>

        <p>Kind regards,<br/>
        {{ $offer->createdBy->name }}
        </p>
    </div>
</div>

@endsection
