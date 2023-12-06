@php
@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Új generált jelszó')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Tisztelt {{ $name }}!</h2>
            <p>
                A következő jelszóval tud belépni: {{ $password }}
            <p>
            Üdvözlettel,<br>
            {{ $createdByName }},
            {{ $createdByEmail }}
            </p>
        </div>
    </div>
@endsection
