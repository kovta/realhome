@php
    /**
    * @var App\Models\Client[] $records
    * @var App\User[] $users
    * @var array $filters
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.clients_list_title_caption'))

@section('content')

    <div class="admin-list-title">@lang('messages.clients_list_title_caption')</div>

    <div class="admin-toolbar">
        <a class="btn btn-primary" href="{{route('clientusers.create')}}">@lang('messages.crud_new_client_button_caption')</a>
    </div>

    <div class="card admin-list-filterbox">
        <div class="card-header" id="filter-heading">
            <h5 class="mb-0">
                <button class="btn btn-link" style="float: left;" type="button" data-toggle="collapse" data-target="#filter-collapse" aria-expanded="true" aria-controls="filter-collapse">
                    @lang('messages.list_filterbox_title_caption')
                </button>
                <div class="admin-list-filterbox-summary">summary</div>
            </h5>
        </div>

        <div id="filter-collapse" class="collapse show" aria-labelledby="filter-heading">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="client_id" class="col-form-label col-form-label-sm">@lang('messages.clients_datapage_client_id_label')</label>
                            <input type="text" class="form-control form-control-sm table-filter" name="client_id" value="{{ $filters['client_id'] }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div id="backendSearchableSelect" class="form-group">
                            <label for="name" class="col-form-label col-form-label-sm">@lang('messages.offers_datapage_client_label')</label>
                            <select class="form-control form-control-sm table-filter selectpicker" name="name" data-live-search="true">
                                <option value="">Összes ügyfél</option>
                                @foreach($clients as $client)
                                    <option value="{{$client->name}}" @if($filters['client_id'] == $client->id) selected @endif>{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="partner" class="col-form-label col-form-label-sm">@lang('messages.clients_datapage_partner_label')</label>
                            <input type="text" class="form-control form-control-sm table-filter" name="partner" value="{{ $filters['partner'] }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check form-control-sm" style="margin-top: 2rem;">
                            <input class="form-check-input table-filter" type="checkbox" value="1" name="status">
                            <label class="form-check-label" for="status">@lang('messages.clients_list_onlyactual_filter_caption')</label>
                        </div>
                    </div>
                </div>

                <div class="admin-filter-button-wrapper">
                    <button class="btn btn-secondary btn-sm" id="filterUpdateButton">@lang('messages.list_filterbox_filter_update_button_caption')</button>
                    <a class="btn btn-secondary btn-sm" id="filterClearButton" href="{{ route('clients.clearFilters') }}">@lang('messages.list_filterbox_filter_clear_button_caption')</a>
                </div>
            </div>
        </div>
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
        <th style="width: 100px;">@lang('messages.crud_manage_column_caption')</th>
        <th style="width:300px;">@lang('messages.clients_list_name_column_caption')</th>
        <th style="width:200px;">@lang('messages.clients_list_email_column_caption')</th>
        <th>@lang('messages.clients_list_phone_column_caption')</th>
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
            $.post('{{ route('clients.destroy') }}', { id: id } )
                .done(function (result) {
                    console.log(result.message);
                })
                .fail(function () {
                })
                .always(function () {
                    table.ajax.reload();
                });
        }




        $('#filterUpdateButton').on('click', function () {
            table.ajax.reload();
            $('#h_tableFilterChanged').val(0);
            $(this).blur();
        });


        $(document).ready(function () {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json'
                },
                ajax: {
                    url: '{{ route('clients.tabledata') }}',
                    type: 'POST',
                    data: function (data){
                        data['filter'] = {};
                        $('.table-filter').each(function(){
                            let $this = $(this);
                            let name = $this.attr('name');
                            let value = $this.val();
                            //let inputType = $this[0].localName;
                            let inputType = $this.attr('type');
                            if (inputType == 'checkbox'){
                                data['filter'][name] = ($this.prop('checked')) ? value : null;
                            } else {
                                data['filter'][name] = value;
                            }
                        })
                    }

                },
                order: [[ 1, 'asc']],
                pageLength: 25,
                dom: "<'row'<'col-sm-12 col-md-6'l>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columns: [
                    {
                        data: null, name: null,
                        orderable: false,
                        className: 'admin-list-manage-colcell',
                        'render': function(data,type,row){
                            let offersIcon = '<a class="btn btn-link"  href="{{ Route('realEstateOffers.index') }}?filter=client_id='+data['id']+'" title="@lang('messages.crud_offers_item_button_tooltip')"><i class="fas fa-folder-open"></i></a>';
                            let requirementsIcon = '<a class="btn btn-link"  href="{{ Route('clientRequirements.index') }}?client='+data['id']+'" title="@lang('messages.crud_requirements_item_button_tooltip')"><i class="fas fa-heart"></i></a>';
                            let deleteIcon = '<a class="btn btn-link"  href="#" onclick="deleteRecordClick('+data['id']+');return false;" title="@lang('messages.crud_delete_item_button_tooltip')"><i class="fas fa-trash"></i></a>';
                            return offersIcon + requirementsIcon + deleteIcon;
                        }
                    },
                    {
                        data: null, name: 'name',
                        'render': function(data,type,row){
                            return '<a href="'+data['name_url']+'">'+data['name']+'</a>';
                        }
                    },
                    { data: 'email', name: 'email' },
                    { data: 'phone_1', name: 'phone_1' },
                ]
            });

        });
    </script>
@endsection
