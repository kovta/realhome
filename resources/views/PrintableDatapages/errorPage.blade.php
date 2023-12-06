@php
    /**
    * @var string $message
    */
@endphp


@extends('PrintableDatapages.defaultprintable')

@section('title', 'Nyomtatási hiba')

@section('content')
    <div class="row" style="margin: 10px;">
        <div class="col-12">
            <div class="alert alert-danger">
                <div style="float: left;">
                    <i class="icon fa fa-exclamation-triangle"></i>
                </div>
                <div style="margin-left: 30px;">{{ $message }}</div>
            </div>
        </div>
    </div>
@endsection
