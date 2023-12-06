@php
    /**
    * @var App\Models\RealEstateType[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.real_estate_types_list_title_caption'))

@section('content')

                <div class="admin-list-title">@lang('messages.real_estate_types_list_title_caption') {{ Session::get('editedLanguage') }}</div>

                <div class="admin-toolbar">
                    <a class="btn btn-primary" href="{{route('realEstateTypes.create')}}">@lang('messages.crud_new_real_estate_type_button_caption')</a>
                </div>

                <table id="table" class="display" style="width:100%">
                    <thead>
                        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                        <th style="width: 300px;">@lang('messages.real_estate_types_name_column_caption')</th>
                        <th>@lang('messages.real_estate_types_category_column_caption')</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $rec)
                            <tr>
                                <td class="admin-list-manage-colcell">
                                    @include('inc.delete-icon', ['deleteRoute' => route('realEstateTypes.destroy', $rec->id) ])
                                </td>
                                <td>
                                    <a class="name" href="{{route('realEstateTypes.edit', [$rec->id])}}">{{ $rec->translateOrDefault(Session::get('editedLanguage'))->name }}</a>
                                </td>
                                <td>
                                    {{ \App\Models\Enum\RealEstateCategoryEnum::getDescription($rec->real_estate_category_id) }}
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
