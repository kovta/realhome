@php
    /**
    * @var App\Models\Post[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.post_list_title_caption'))

@section('content')

    <div class="admin-list-title"><i class="fas fa-edit"></i> @lang('messages.post_list_title_caption')</div>

    <div class="admin-toolbar">
        <a class="btn btn-primary" href="{{route('posts.create')}}">@lang('messages.crud_new_post_button_caption')</a>
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
        <th style="width: 100px;">@lang('messages.post_list_thumb_column_caption')</th>
        <th>@lang('messages.post_list_title_column_caption')</th>
        </thead>
        <tbody>
        @foreach ($records as $rec)
            <tr>
                <td class="admin-list-manage-colcell">
                    @include('inc.delete-icon', ['deleteRoute' => route('posts.destroy', $rec->id) ])
                </td>
                <td>
                    <img src="{{ $rec->getListThumbImage() }}">
                </td>
                <td>
                    <a class="name" href="{{route('posts.edit', [$rec->id])}}">{{ $rec->translateOrDefault(App::getLocale())->title }}</a>
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
                'pageLength': 5,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json'
                },
            });
        });
    </script>
@endsection
