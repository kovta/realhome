@php
    /**
    * @var integer $selectableItems
    * @var string nextRouteName
    * @var integer entityId

    * @var array $filters

    * @var \App\Models\Client[] $clients
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.real_estate_offers_list_title_caption'))

@section('content')

<div class="admin-list-title">
@if ($selectableItems == 1)
    @lang('messages.list_title_caption_selection_prefix')
@endif
    @lang('messages.real_estate_offers_list_title_caption')
</div>

<div class="admin-toolbar">
    <form id="sendSelectionForm" style="display: inline; margin: 0; padding: 0;" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="ids" name="ids">
    </form>
@if ($selectableItems == 1)
    <button class="btn btn-primary" id="selectionReadyButton">@lang('messages.crud_list_selection_is_ready_button_caption')</button>
@else
    <a class="btn btn-primary" href="{{route('realEstateOffers.create')}}@if ($filters['client_id']){{ '?filter=client_id='.$filters['client_id'] }} @endif">@lang('messages.crud_new_offer_button_caption')</a>
@endif
</div>

<div class="card admin-list-filterbox">
    <div class="card-header" id="filter-heading">
        <h5 class="mb-0">
            <button class="btn btn-link" style="float: left;" type="button" data-toggle="collapse" data-target="#filter-collapse" aria-expanded="true" aria-controls="filter-collapse">
                @lang('messages.list_filterbox_title_caption')
            </button>
            <i
                id="tooltip-client-list-filter"
                data-toggle="tooltip"
                class="fa fa-info-circle"
                title="Alapértelmezetten amíg nincs kiválasztva a szűrőbe ügyfél, a listában lenn az ügyfél nélküli ajánlatok jelennek meg!"
            ></i>
            <div class="admin-list-filterbox-summary">summary</div>
        </h5>
    </div>

    <div id="filter-collapse" class="collapse show" aria-labelledby="filter-heading">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div id="backendSearchableSelect" class="form-group">
                        <label for="client_id" class="col-form-label col-form-label-sm">@lang('messages.offers_datapage_client_label')</label>
                        <select class="form-control form-control-sm table-filter selectpicker" name="client_id" data-live-search="true">
                            <option value="">@lang('messages.combobox_empty_caption')</option>
                            @foreach($clients as $item)
                                <option value="{{$item->id}} @if ($filters['client_id'] == $item->id) selected @endif">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="admin-filter-button-wrapper">
                <button class="btn btn-secondary btn-sm" id="filterUpdateButton">@lang('messages.list_filterbox_filter_update_button_caption')</button>
                <a class="btn btn-secondary btn-sm" id="filterClearButton" href="{{ route('realEstateOffers.clearFilters') }}">@lang('messages.list_filterbox_filter_clear_button_caption')</a>
            </div>
        </div>
    </div>
</div>

<table id="table" class="display" style="width:100%">
    <thead>
        <th class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
        <th style="width:200px;">@lang('messages.real_estate_offers_list_name_column_caption')</th>
        <th style="width:300px;" >@lang('messages.real_estate_offers_list_client_column_caption')</th>
        <th style="width:100px;">@lang('messages.real_estate_offers_list_status_column_caption')</th>
        <th>@lang('messages.real_estate_offers_list_realestates_column_caption')</th>
        <th>@lang('messages.real_estates_datapage_updated_at_label')</th>
    </thead>
    <tbody></tbody>
    <tfoot></tfoot>
</table>
<input type="hidden" id="h_tableFilterChanged" value="0">
@endsection


@section('javascript')
<script type="text/javascript">

    let table = null;

    function deleteRecordClick(id) {
        if ( !confirm('@lang('messages.crud_delete_confirm_text')') ) return;
        $.post('{{ route('realEstateOffers.destroy') }}', { id: id } )
            .done(function (result) {
                console.log(result.message);
            })
            .fail(function () {
            })
            .always(function () {
                table.ajax.reload();
            });
    }


    function collectSelectedItemIds() {
        let ids = [];
        table.rows('.selected').data().each(function(item){
            ids.push(item.id);
        });
        console.log(ids);
        if (ids.length == 0) { alert('@lang('messages.crud_no_selection_warning_text')'); return false; }
        let idStr = ids.join(',');
        $('#ids').val(idStr);
        return idStr;
    }


    $('#filterUpdateButton').on('click', function () {
        table.ajax.reload();
        $('#h_tableFilterChanged').val(0);
        $(this).blur();
    });




@if ($selectableItems == 1)

    let selectableItems = '{{ $selectableItems }}';

    $('#table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    });

    $('#sendSelectionForm').on( 'submit', function () {
        return collectSelectedItemIds();
    });

    $('#selectionReadyButton').on( 'click', function () {
        $('#sendSelectionForm').attr('action', '@if ($nextRouteName) {{ route($nextRouteName, [$entityId]) }} @endif');
        $('#sendSelectionForm').submit();
    });
/*
    $('#createOfferFromSelectedItemsButton').on( 'click', function () {
        createOfferFromSelectedItems();
    });
*/
    $('#tableSelectAllButton').on( 'click', function () {
        table.rows().select();
        $(this).blur();
    });

    $('#tableSelectNoneButton').on( 'click', function () {
        table.rows().deselect();
        $(this).blur();
    });

@endif

    $(document).ready(function () {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                'url': '/lang/datatables/{{App::getLocale()}}.json'
            },
            ajax: {
                url: '{{ route('realEstateOffers.tabledata') }}',
                type: 'POST',
                data: function (data){
                    data['filter'] = {};
                    $('.table-filter').each(function(){
                        let $this = $(this);
                        let name = $this.attr('name');
                        let value = $this.val();
//                        let inputType = $this[0].localName;
                        data['filter'][name] = value;
                    })
                }

            },
            order: [[ 5, 'desc']],
            pageLength: 25,
            dom: "<'row'<'col-sm-12 col-md-6'l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            columns: [
                {
                    data: null,
                    name: null,
                    orderable: false,
                    className: 'admin-list-manage-colcell',
                    'render': function(data,type,row){
                        let deleteIcon = '<a class="btn btn-link" href="#" onclick="deleteRecordClick('+data['id']+');return false;" title="@lang('messages.crud_delete_item_button_tooltip')"><i class="fas fa-trash"></i></a>';
                        return deleteIcon;
                    }
                },
                {
                    data: null, name: 'name',
                    'render': function(data,type,row){
                        return '<a href="'+data['name_url']+'">'+data['name']+'</a>';
                    }
                },
                { data: 'client_name', name: 'client_name' },
                { data: 'status', name: 'status' },
                { data: 'realestates', name: 'realestates' },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    render: function(data) {
                        return new Date(data).toLocaleString('hu-HU');
                    }
                },
            ]
        });

    });
</script>
@endsection
