@php
    /**
    * @var \Spatie\Permission\Models\Role[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.roles_list_title_caption'))

@section('content')

    <div class="admin-list-title"><i class="fas fa-user-tag"></i> @lang('messages.roles_list_title_caption')</div>

    <div class="admin-toolbar">
        {{--<a class="btn btn-primary" href="{{route('roles.create')}}">@lang('messages.crud_new_item_button_caption')</a>--}}
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
        <th>@lang('messages.roles_list_name_column_caption')</th>
        </thead>
        <tbody>
        @foreach ($records as $rec)
            <tr>
                <td class="admin-list-manage-colcell">
                    {{--@include('inc.delete-icon', ['deleteRoute' => route('roles.destroy', $rec->id) ])--}}
                </td>
                <td>
                    {{ $rec->name }}
                    {{--<a class="name" href="{{route('roles.edit', [$rec->id])}}">{{ $rec->name }}</a>--}}
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
