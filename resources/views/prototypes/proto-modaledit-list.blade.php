@php
    /**
    * @var App\Models\AdvertisingPartner[] $records
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.advertisingpartners_list_title_caption'))

@section('content')

                <div class="admin-list-title">@lang('messages.advertisingpartners_list_title_caption') (modal edit)</div>

                <div class="admin-toolbar">
                    <a class="btn btn-primary" onclick="showCrudModal('@lang('messages.advertisingpartners_datapage_title_caption')', '{{route('modalEditPrototypes.create')}}?showInIframe=1', '{{route('modalEditPrototypes.store')}}');return false;" href="#">@lang('messages.crud_new_item_button_caption')</a>
                </div>

                <table id="table" class="display" style="width:100%">
                    <thead>
                        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                        <th>@lang('messages.advertisingpartners_list_name_column_caption')</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $rec)
                            <tr>
                                <td class="admin-list-manage-colcell">
                                    @include('inc.delete-icon', ['deleteRoute' => route('modalEditPrototypes.destroy', $rec->id) ])
                                </td>
                                <td>
                                    <a class="name" onclick="showCrudModal('@lang('messages.advertisingpartners_datapage_title_caption')', '{{route('modalEditPrototypes.edit', [$rec->id])}}?showInIframe=1', '{{route('modalEditPrototypes.update', [$rec->id])}}');return false;" href="#">{{ $rec->name }}</a>
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
            $('#table').DataTable();
        });
    </script>
@endsection
