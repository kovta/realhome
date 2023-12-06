@php
    /**
    * @var App\Models\SiteParameter[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.siteparameters_list_title_caption'))

@section('content')

                <div class="admin-list-title">@lang('messages.siteparameters_list_title_caption')</div>

{{--
                <div class="admin-toolbar">
                    <a class="btn btn-primary" href="{{route('siteParameters.create')}}">@lang('messages.crud_new_item_button_caption')</a>
                </div>
--}}

                <table id="table" class="display" style="width:100%">
                    <thead>
                        {{--<th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>--}}
                        <th>@lang('messages.siteparameters_list_name_column_caption')</th>
                        <th>@lang('messages.siteparameters_list_value_column_caption')</th>
                        <th>@lang('messages.siteparameters_list_description_column_caption')</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $rec)
                            <tr>
{{--
                                <td class="admin-list-manage-colcell">
                                    @include('inc.delete-icon', ['deleteRoute' => route('siteParameters.destroy', $rec->id) ])
                                </td>
--}}
                                <td>
                                    <a class="name" href="{{route('siteParameters.edit', [$rec->id])}}">{{ $rec->code_name }}</a>
                                </td>
                                <td>
                                    @if ( strpos($rec->getValue(), '#') !== 0 )
                                    {{ $rec->getValue() }}
                                    @else
                                    <i class="list-color-sample-box" style="background-color:{{$rec->getValue()}}" title="{{$rec->getValue()}}"></i>
                                    @endif
                                </td>
                                <td>
                                    {{ $rec->description }}
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
                "order": [[0, "asc"]],
                'pageLength': 50,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json'
                },
            });
        });
    </script>
@endsection
