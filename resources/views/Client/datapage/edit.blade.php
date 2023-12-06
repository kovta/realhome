@php
    /**
    * @var \App\Models\Client $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.clients_datapage_title_caption'))

@section('content')

    <div class="admin-form-wrapper">
        {{-- Fejlec Felirat --}}
        <div class="admin-form-title">@lang('messages.clients_datapage_title_caption')</div>

        {{-- Fejlec gombok --}}
        <div class="admin-toolbar">
            <a class="btn btn-secondary btn-sm" href="{{ Route('realEstateOffers.index').'?filter=client_id='.$record->id }}"><i class="fas fa-folder-open"></i> @lang('messages.real_estate_offers_list_title_caption')</a>
            <a class="btn btn-secondary btn-sm" href="{{ Route('clientRequirements.index').'?client='.$record->id }}"><i class="fa fa-heart"></i> @lang('messages.clients_requirements_list_title_caption')</a>
@if ($record->clientRequirement)
            <a class="btn btn-secondary btn-sm" href="#" onclick="deleteRequirementsClick({{ ($record->clientRequirement) ? $record->clientRequirement->id : 'null' }});return false;"
               title="@lang('messages.clients_datapage_delete_requirement_button_tooltip')">
                <i class="fas fa-heart-broken"></i> @lang('messages.clients_datapage_delete_requirement_button_caption')
            </a>
@endif
        </div>

        <form method="POST" action="{{route('clients.update', [$record->id])}}">
            @csrf
            @method('PUT')

            {{-- Mentes gomb --}}
            <div class="row" style="margin-bottom: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>

            {{-- Card --}}
            @include('Client.datapage.client-datapage-body')

            {{-- Mentes gomb --}}
            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>
    </div>

@endsection


@section('javascript')
    <script type="text/javascript">
        function deleteRequirementsClick(id) {
            if ( !confirm('@lang('messages.crud_delete_confirm_text')') ) return;
            $.post('{{ route('clientRequirements.destroy') }}', { id: id } )
                .done(function (result) {
                    console.log(result.message);
                })
                .fail(function () {
                })
                .always(function () {
                    window.location.reload(true);
                });
        }
    </script>
@endsection
