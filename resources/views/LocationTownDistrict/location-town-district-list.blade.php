@php
    /**
    * @var App\Models\LocationTownDistrict[] $records
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.locationtowndistricts_list_title_caption'))

@section('content')

                <div class="admin-list-title">@lang('messages.locationtowndistricts_list_title_caption')</div>

                <div class="admin-toolbar">
                    <a class="btn btn-primary" href="{{route('locationTownDistricts.create')}}">@lang('messages.crud_new_town_district_button_caption')</a>
                </div>

                <table id="table" class="display" style="width:100%">
                    <thead>
                        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                        <th>@lang('messages.locationtowndistricts_list_name_column_caption')</th>
                        <th style="width: 200px;">@lang('messages.locationtowndistricts_list_area_column_caption')</th>
                        <th>@lang('messages.locationtowndistricts_list_neighborhoods_column_caption')</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $rec)
                            <tr>
                                <td class="admin-list-manage-colcell">
                                    @include('inc.delete-icon', ['deleteRoute' => route('locationTownDistricts.destroy', $rec->id) ])
                                </td>
                                <td>
                                    <a class="name" href="{{route('locationTownDistricts.edit', [$rec->id])}}">{{ $rec->name }}</a>
                                </td>
                                <td>
                                    {{ $rec->locationArea->name }}
                                </td>
                                <td>
                                    {{ $rec->locationNeighborhood->implode('name',', ')  }}
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
