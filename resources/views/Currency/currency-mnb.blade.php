@php
    /**
    * @var App\Models\Currency $record
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', 'MNB teszt')

@section('content')

    <div class="admin-list-title">MNB teszt</div>

    <div>{{$day}}</div>
    @foreach ($records as $rec)
        <div>{{$rec->iso_code}} = {{$rec->rate}}</div>
    @endforeach

@endsection


@section('javascript')
@endsection
