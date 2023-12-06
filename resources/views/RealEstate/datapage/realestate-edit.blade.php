@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.real_estates_datapage_title_caption'))

@section('javascript')
    <script type="text/javascript">
        function clearContractClick(id) {
            if ( !confirm('@lang('messages.crud_delete_confirm_text')') ) return;
            $.post('{{ route('realEstates.clearContract') }}', {
                '_token': '{{ @csrf_token() }}',
                'id': id
            })
                .done(function (result) {
                    if (result.status == 'ok') {
                        $('#commission_contract_id').val('');
                        $('#commission_contract_name').val('');
                    }
                })
                .fail(function () {
                    alert('The operation is failed!');
                })
                .always(function () {
                });
        }

    </script>
@endsection

@section('content')

    <div class="admin-form-wrapper">

        <div class="admin-form-title">@lang('messages.real_estates_datapage_title_caption'){{--@include('inc.localeSwitch')--}}</div>

        @include('RealEstate.datapage.realestate-datapage-toolbar')

        <form method="POST" action="{{route('realEstates.update', [$record->id])}}">
            @csrf
            @method('PUT')

            <div class="row" style="margin-bottom: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>

            @include('RealEstate.datapage.realestate-datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>
    </div>

@endsection
