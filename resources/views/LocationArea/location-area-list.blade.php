@php
    /**
    * @var App\Models\LocationArea[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.locationareas_list_title_caption'))

@section('content')

                <div class="admin-list-title">@lang('messages.locationareas_list_title_caption')</div>

                <div class="admin-toolbar">
                    <a class="btn btn-primary" href="{{route('locationAreas.create')}}">@lang('messages.crud_new_area_button_caption')</a>
                </div>

                <table id="table" class="display" style="width:100%">
                    <thead>
                        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                        <th>@lang('messages.locationareas_list_name_column_caption')</th>
                        <th>@lang('messages.locationareas_list_districts_column_caption')</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $rec)
                            <tr>
                                <td class="admin-list-manage-colcell">
                                    @include('inc.delete-icon', ['deleteRoute' => route('locationAreas.destroy', $rec->id) ])
                                </td>
                                <td>
                                    <a class="name" href="{{route('locationAreas.edit', [$rec->id])}}">{{ $rec->name }}</a>
                                </td>
                                <td>
                                    {{ $rec->locationTownDistrict->implode('name',', ')  }}
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
        });
    </script>
@endsection
