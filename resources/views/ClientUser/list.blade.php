@php
    /**
    * @var App\Models\Client[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.clientusers_list_title_caption'))

@section('content')

    <div class="admin-list-title"><i class="fas fa-users"></i> @lang('messages.clientusers_list_title_caption')</div>

    <div class="admin-toolbar">
        <a class="btn btn-primary" href="{{route('clientusers.create')}}">@lang('messages.crud_new_client_user_button_caption')</a>
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
        <th style="width:200px;">@lang('messages.clientusers_list_name_column_caption')</th>
        <th>@lang('messages.clientusers_list_user_column_caption')</th>
        <th>@lang('messages.clientusers_list_role_column_caption')</th>
        </thead>
        <tbody>
        @foreach ($records as $rec)
            <tr>
                <td class="admin-list-manage-colcell">
                    @include('inc.delete-icon', ['deleteRoute' => route('clientusers.destroy', $rec->id) ])
                </td>
                <td>
                    <a class="name" href="{{route('clientusers.edit', [$rec->id])}}">{{ $rec->user->name }}</a>
                </td>
                <td>
                    {{ $rec->user->email  }}
                </td>
                <td>
                    {{ $rec->user->roles->implode('name', ', ')  }}
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
                'pageLength': 25,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json'
                },
            });
        });
    </script>
@endsection
