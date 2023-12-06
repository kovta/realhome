@php
    /**
    * @var App\Models\Currency[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.currencies_list_title_caption'))

@section('content')

                <div class="admin-list-title">@lang('messages.currencies_list_title_caption')</div>

                <div class="admin-toolbar">
                    <a class="btn btn-primary" href="{{route('currencies.create')}}">@lang('messages.crud_new_currency_button_caption')</a>
                    <button id="lekerdezesMostButton" class="btn btn-secondary" >@lang('messages.currencies_query_now_caption')</button>
                </div>

                <table id="table" class="display" style="width:100%">
                    <thead>
                        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                        <th style="width:100px;">@lang('messages.currencies_list_iso_code_column_caption')</th>
                        <th>@lang('messages.currencies_list_rate_column_caption')</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $rec)
                            <tr>
                                <td class="admin-list-manage-colcell">
                                    @if ($rec->id != \App\Models\Currency::$HUF)
                                        @include('inc.delete-icon', ['deleteRoute' => route('currencies.destroy', $rec->id) ])
                                    @endif
                                </td>
                                <td>
                                    @if ($rec->id == \App\Models\Currency::$HUF)
                                        {{ $rec->iso_code }}
                                    @else
                                        <a class="name" href="{{route('currencies.edit', [$rec->id])}}">{{ $rec->iso_code }}</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $rec->rate }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>

@endsection


@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "order": [[1, "asc"]],
                'pageLength': 50,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json'
                },
            });

            $('#lekerdezesMostButton').on( "click", function() {
                $(this).prop('disabled', true);
                $.get("{{route('mnbCurrencyQuery')}}", { _token: '{{ csrf_token() }}' })
                    .done(function(response) {
                        window.location.reload(true);
                        if (response.code == 0) {
                            alert(response.message);
                        } else {
                            alert(response.error);
                        }
                    })
                    .fail(function(response) {
                        alert('AJAX hiba');
                    })
                    .always(function() {
                        $('#lekerdezesMostButton').prop('disabled', false);
                    });

            });

        });
    </script>
@endsection
