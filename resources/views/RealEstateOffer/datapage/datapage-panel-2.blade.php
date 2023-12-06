@php
    /**
    * @var \App\Models\RealEstateOffer $record
    * @var \App\Models\enum\RealEstateOfferStatusEnum[] $statuses
    * @var \App\Models\Client[] $clients
    * @var \App\Models\Client[] $coWorkers
    * @var \App\Models\enum\LanguageEnum[] $languages
    */
@endphp

<div class="card">

    <div class="card-header" id="heading-2">
        <div class="row">
            <div class="col-8">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                        @lang('messages.offers_datapage_panel_2_title_caption')
                    </button>
                </h5>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" style="margin: 5px 0; width: 100%;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('messages.button_add_caption')
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                           href="{{ route('realEstates.index').'?selection=1&nextStep=realEstateOffers.addItem&entityId='.$record->id }}">
                            @lang('messages.button_find_properties_caption')
                        </a>
                        <a class="dropdown-item {{ \App\Models\RealEstateOffer::hasClientsRequirements($record->id) ? '' : 'disabled' }}"
                           href="{{ (\App\Models\RealEstateOffer::hasClientsRequirements($record->id)) ? route('realEstates.index').'?selection=1&nextStep=realEstateOffers.addItem&entityId='.$record->id.
                               '&filter='.\App\Models\RealEstateOffer::getClientsRequirementsParametersString($record->id) : '#'}}">
                            @lang('messages.button_required_properties_caption')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-secondary" style="margin: 5px 0; width: 100%;" id="itemDeleteButton"
                        onclick="deleteRealEstateOfferItems();return false;">
                    @lang('messages.button_remove_caption')
                </button>
            </div>
        </div>
    </div>
    <div id="imageGalleryApp">
        <lightbox :images="images" ref="lightbox" :show-caption="false" :show-light-box="false"></lightbox>
    </div>

    <table id="table" class="display" style="width:100%">
        <thead>
            <th>@lang('messages.real_estates_list_image_column_caption')</th>
            <th class="admin-list-manage-colhead">@lang('messages.real_estates_list_id_column_caption')</th>
            <th></th>
            <th>@lang('messages.real_estates_list_meg_column_caption')</th>
            <th>@lang('messages.locationneighborhoods_datapage_district_label')</th>
            <th>@lang('messages.routes_datapage_item_locationStreet-1_label')</th>
            <th>@lang('messages.real_estates_datapage_floor_label')</th>
            <th>  m<sup style='top: -0.5em'>2</sup></th>
            <th>@lang('messages.real_estates_list_gross_column_caption')</th>
            <th>@lang('messages.client_requirements_datapage_price_min_label')</th>
            <th>@lang('messages.routes_datapage_item_score_label')</th>
            <th>@lang('messages.real_estates_datapage_build_year_label')</th>
            <th>@lang('messages.real_estates_datapage_renovation_year_label')</th>
            <th>@lang('messages.real_estates_datapage_description_label')</th>
            <th></th>
            </thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>
</div>

@section('javascript')
    <script type="text/javascript">
        let table = null;

        function deleteRealEstateOfferItems(){
            let selectedTr = $('.selected');
            let ids = [];
            selectedTr.children().children().each(function () {
                if ($(this).hasClass("hiddens")) {
                    ids.push($(this).val())
                    console.log($(this).hasClass("hiddens"), $(this).val());
                }
            })
            let idString = ids.join(',');
            $.post('{{ route('realEstateOffers.deleteItems', [$record->id]) }}', { ids: idString })
                .done(function (result) {
                    console.log(result.message);
                })
                .fail(function () {
                })
                .always(function () {
                    table.ajax.reload();
                });
        }

        function collectSelectedItemIds(event) {
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


        function createOfferFromSelectedItems() {
            if ( !confirm('@lang('messages.crud_sure_confirm_text')') ) return;
            $('#sendSelectionForm').attr('action', '{{ route('realEstateOffers.createWithItems') }}');
            $('#sendSelectionForm').submit();
        }

        $('#table tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });


        $('#sendSelectionForm').on( 'submit', function (event) {
            return collectSelectedItemIds(event);
        });

        $('#createOfferFromSelectedItemsButton').on( 'click', function () {
            createOfferFromSelectedItems();
        });

        function initPopovers(){
            //console.log('table data done.');
            $('a[rel=popover]').popover({
                html: true,
                trigger: 'hover',
                placement: 'bottom',
                // a tartalmat a data-content adja
                //content: function(){return '<img src="..." />';}
            });
        }

        //  képnézegető:
        function showLightboxGallery(id) {
            //  NE írd át az egyenlőségjelet === -re, mert nem fog működni!
            filteredImageListById = table.data().toArray().filter(obj=>{ return Number(obj.id_code) === Number(id) });
            //  console.log(filteredImageListById);
            window.imageGalleryApp.images = filteredImageListById[0].gallery;
            //  megjeleníti a lightbox nagyméretű képlapozót:
            imageGalleryApp.$refs.lightbox.showImage(0);
            return false;
        }

        function format ( d ) {
            // `d` is the original data object for the row
            return '<table>'+
                '<tr style="border: black 1px solid">'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_real_estate_code_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['code'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_commission_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['commission'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_locationTownDistrictName_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['locationTownDistrict'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_locationStreet-1_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['street_address_1'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_locationStreet-3_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['street_address_3'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_baseAreaGross_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['base_area_gross'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_offerPrice_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['offer_price'] +'</td>'+

                '</tr>'+
                '<tr style="border: black 1px solid">'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_ownerName_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['owner_name'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_ownerPhone-1_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['owner_phone_1'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_ownerPhone-2_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['owner_phone_2'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_ownerContactName_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['owner_contact_name'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_ownerContactPhone_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['owner_keys'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_ownerKeys_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['owner_name'] +'</td>'+
                    '<td style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_score_label')}}</td>' +
                    '<td style="border-bottom: 1px solid black; border-right: 1px solid black;">'+ d['details']['score'] +'</td>'+
                '</tr>'+
                '<tr style="border: black 1px solid">'+
                    '<td  style="border-bottom: 1px solid black;">{{__('messages.routes_datapage_item_comment_label')}}</td>' +
                    '<td  style="border-bottom: 1px solid black; border-right: 1px solid black;" colspan="13">'+ d['details']['comment'] +'</td>'+
                '</tr>'+
                '</table>';
        }

        $(document).ready(function () {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                "bLengthChange": false,
                "iDisplayLength": 50,
                "paging":   false,
                "bInfo" : false,
                "language": {
                    'url': '/lang/datatables/{{App::getLocale()}}.json',
                    "select": {
                        "rows": {
                            _: ", ebből kijelölve %d sor."
                        }
                    }
                },
                "ajax": {
                    "url": '{{ route('realEstateOffers.offerItemList') }}',
                    "type": 'POST',
                    "data": {
                        "offer_id": {{$record->id}}
                    }
                },
                // "rowCallback": function( row, data, index ) {
                //     console.log(data['details'])
                // },
                // drawCallback: function (settings){
                //     //console.log('aaaaaaaaaaa');
                // },
                // order: [[ 1, 'asc']],
                //  lengthMenu: [1,10,20,100],
                dom: "<'row'<'col-sm-12 col-md-6'l>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columns: [
                    // Gallery
                    {   data: null,
                        name: 'gallery',
                        orderable: false,
                        searchable: false,
                        className: "dt-center",
                        'render': function(data) {
                            window.imageGalleryApp.images = [];
                            if (data !== null && typeof Object.values(data.gallery)[0] !== 'undefined') {
                                return '<a href="#" onclick="showLightboxGallery('+data.id_code+'); return false;"><img src="' + data.gallery[0]['thumb'] + '" alt="" width="30" height="30" /></a>';
                                //  ez a megoldás azért nem jó, mert a paramétert itt - a létrehozás miatt - string-re konvertálja, holott a paraméter obj lenne:
                                //  return '<img src="' + data.gallery[0]['thumb'] + '" alt="" width="120" height="120" onclick="showLightboxGallery('+data.gallery+');" />';
                            }
                            return '';
                        }
                    },
                    // ID
                    {
                        data: null,
                        name: 'code',
                        orderable: false,
                        searchable: false,
                        'render': function(data){
                            return '<a href="'+data['id']+'">'+data['code']+'</a>';
                        }
                    },
                    // ID hidden
                    {
                        data: null,
                        name: 'hidden',
                        orderable: false,
                        searchable: false,
                        'render': function(data){
                            return '<input type="hidden" class="hiddens" value="'+data.id_code+'"/>';
                        }
                    },
                    // Megbizas
                    {
                        data: 'commission',
                        name: 'commission',
                        orderable: false,
                        searchable: false,
                    },
                    // Kerulet
                    {
                        data: 'location_town_district_id',
                        name: 'location_town_district_id',
                        orderable: true,
                        searchable: false,
                    },
                    // Utca
                    {
                        data: 'street_address',
                        name: 'street_address',
                        orderable: false,
                        searchable: false,
                    },
                    // Emelet
                    {
                        data: 'floor',
                        name: 'floor',
                        orderable: false,
                        searchable: false,
                    },
                    // negyzetmeter
                    {
                        data: 'base_area_gross',
                        name: 'base_area_gross',
                        orderable: false,
                        searchable: false,
                    },
                    // Brutto
                    {
                        data: 'offer_price',
                        name: 'offer_price',
                        orderable: false,
                        searchable: false,
                    },
                    // Ar min
                    {
                        data: 'limit_price',
                        name: 'limit_price',
                        orderable: false,
                        searchable: false,
                    },
                    // Pontszam
                    {
                        data: 'score',
                        name: 'score',
                        orderable: false,
                        searchable: false,
                    },
                    // Epitve
                    {
                        data: 'build_year',
                        name: 'build_year',
                        orderable: false,
                        searchable: false,
                    },
                    // Felujitva
                    {
                        data: 'renovation_year',
                        name: 'renovation_year',
                        orderable: false,
                        searchable: false,
                    },
                    // leiras
                    {
                        data: null,
                        name: 'details',
                        className: "dt-center",
                        orderable: false,
                        searchable: false,
                        'render': function(){
                            return '<button type="button" class="btn btn-info rounded-circle btn-sm"><i class="fa fa-info-circle"></i></a>';
                        }
                    },
                    // reszletek
                    {
                        className: 'details-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    }
                ]
            })
            table.on( 'click', 'button', function () {
                let tr = $(this).closest('tr');
                let row = table.row(tr);
                if ( row.child.isShown() ) {
                    tr.removeClass('selected');
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    tr.removeClass('selected');
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
                // console.log( table.row().data() );
            } );

            table.on('draw.dt', function(){
                //console.log('bbbbbbbb');
                initPopovers();
            });
        })


    </script>
@endsection
