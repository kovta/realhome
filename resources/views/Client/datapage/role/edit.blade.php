@php
    use App\Models\Client;
    /**
    * @var Client $client
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.clients_datapage_title_caption'))

@section('content')

    <div class="admin-form-wrapper">
        {{-- Fejlec Felirat --}}
        <div class="admin-form-title">@lang('messages.clients_datapage_title_caption')</div>

        <form method="POST" action="
                @if(is_null($client->user))
                    {{ route('clientRole.store') }}
                @else
                    {{ route('clientRole.update') }}
                @endif">
            @csrf
            @if(!is_null($client->user))
                @method('PUT')
            @endif
            {{-- Card --}}
            <div class="row">
                <div class="col-6 accordion" id="leftSections">
                    {{-- Hozzaferesi adatok --}}
                    <div class="card">
                        <div class="card-header" id="heading-1">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapse-1"
                                        aria-expanded="true" aria-controls="collapse-1">
                                    {{--                                    @lang('messages.clients_datapage_panel_1_title_caption')--}}
                                    Hozzarendelesi adatok
                                </button>
                            </h5>
                        </div>
                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                             data-parent="#leftSections">
                            <div class="card-body">
                                {{-- Alert --}}
                                <div class="alert alert-primary" style="text-align: center" role="alert">
                                    @if(is_null($client->user))
                                        @lang('messages.clients_datapage_view_client_panel_info_box_disabled')
                                    @else
                                        @lang('messages.clients_datapage_view_client_panel_info_box')
                                    @endif
                                </div>
                                {{-- Client ID--}}
                                @if(is_null($client->user))
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                @else
                                    <input type="hidden" name="user_id" value="{{ $client->user->id }}">
                                @endif
                                {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-sm-2 col-form-label">@lang('messages.clients_datapage_email_label')</label>
                                    <div class="col-sm-10">
                                        <input type="email"
                                               class="form-control disabled" name="email" value="
                                                @if(is_null($client->user))
                                                    {{ $client->email }}
                                                @else
                                                    {{ $client->user->email }}
                                                @endif">
                                    </div>
                                </div>
                                {{-- Password --}}
                                <div class="form-group row justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        @if(is_null($client->user))
                                            Jelszo generalasa
                                        @else
                                            Uj jelszo generalasa
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
