@php
  use App\User;
    /**
    * @var App\Models\Client[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.adminusers_list_title_caption'))

@section('content')

    <div class="admin-list-title"><i class="fas fa-users"></i> @lang('messages.adminusers_list_title_caption')</div>

    <div class="admin-toolbar">
        @hasrole('developers|administrators')
        <a class="btn btn-primary" href="{{route('adminusers.create')}}">@lang('messages.crud_new_admin_user_button_caption')</a>
        @endhasrole
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                <th style="width:200px;">@lang('messages.adminusers_list_name_column_caption')</th>
                <th>@lang('messages.adminusers_list_user_column_caption')</th>
                <th>@lang('messages.adminusers_list_role_column_caption')</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($records as $rec)
            <tr>
                <td class="admin-list-manage-colcell">
                    @include('inc.delete-icon', ['deleteRoute' => route('adminusers.destroy', [$rec->id]) ])
                </td>
                <td>
                    <a class="name" href="{{route('adminusers.edit', [$rec->id])}}">{{ $rec->name }}</a>
                </td>
                <td>
                    {{ $rec->email  }}
                </td>
                <td>
                    {{ $rec->roles->implode('name', ', ')  }}
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
