@php
    /**
    * @var App\Models\SpecialOfferPage[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.special_offer_page_list_title_caption'))

@section('content')

    <div class="admin-list-title">@lang('messages.special_offer_page_list_title_caption')</div>

    <div class="admin-toolbar">
        <a class="btn btn-primary" href="{{route('specialOfferPages.create')}}">@lang('messages.crud_new_special_offer_page_button_caption')</a>
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
        <th style="width: 150px;">@lang('messages.special_offer_page_list_position_column_caption')</th>
        <th>@lang('messages.special_offer_page_list_menu_column_caption')</th>
        <th>@lang('messages.special_offer_page_modify_column_caption')</th>
        </thead>
        <tbody>
        @foreach ($records as $rec)
            <tr>
                <td class="admin-list-manage-colcell">
                    @include('inc.delete-icon', ['deleteRoute' => route('specialOfferPages.destroy', $rec->id) ])
                </td>
                <td>
                    {{ $rec->position }}.
                    @include('inc.down-icon', ['downRoute' => route('specialOfferPageDown', $rec->id) ])
                    @include('inc.up-icon', ['upRoute' => route('specialOfferPageUp', $rec->id) ])
                </td>
                <td>
                    <a class="name" href="{{route('specialOfferPages.edit', [$rec->id])}}">{{ $rec->getTranslation(App::getLocale())->menu_name }}</a>
                </td>
                <td>
                    {{ $rec->updated_at }}
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
                "order": null,
                'pageLength': 25,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json'
                },
                //  szandekosan nincs sorbarendezes, mivel a menu pozicio megkavarna a user-t!
                columns: [
                    { orderable: false, },
                    { orderable: false, },
                    { orderable: false, },
                    { orderable: false, }
                ]
            });
        });
    </script>
@endsection
