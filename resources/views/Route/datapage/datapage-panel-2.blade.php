@php
    /**
    * @var \App\Models\Route $record
    * @var \App\Models\Client[] $clients
    * @var \App\Models\Client[] $coWorkers
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-2">
        <div class="row">
            <div class="col-6">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
                        @lang('messages.routes_datapage_panel_2_title_caption')
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
                           href="{{ route('realEstates.index').'?selection=1&nextStep=realEstateRoutes.addItem&entityId='.$record->id }}">
                            @lang('messages.button_find_properties_caption')
                        </a>
                        <a class="dropdown-item {{ \App\Models\RealEstateOffer::hasClientsRequirements($record->offer_id) ? '' : 'disabled' }}"
                           href="{{ (\App\Models\RealEstateOffer::hasClientsRequirements($record->offer_id)) ? route('realEstates.index').'?selection=1&nextStep=realEstateRoutes.addItem&entityId='.$record->id.
                               '&filter='.\App\Models\RealEstateOffer::getClientsRequirementsParametersString($record->offer_id) : '#'}}">
                            @lang('messages.button_required_properties_caption')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-secondary" style="margin: 5px 0; width: 100%;" id="itemDeleteButton"
                        onclick="deleteRouteItems();return false;">
                    @lang('messages.button_remove_caption')
                </button>
            </div>
            <div class="col-2">
                <button class="btn btn-secondary" style="margin: 5px 0; width: 100%;" id="itemDeleteButton" onclick="reindexRouteItems();return false;">@lang('messages.button_reindex_items_caption')</button>
            </div>
        </div>
    </div>

    <div id="collapse-2" class="collapse @if ($record->id > 0) {{ 'show' }} @endif" aria-labelledby="heading-2" data-parent="#leftSections">
        <div class="card-body">
            <!-- The Modal Gallery-->
            <div id="myModal" class="modal">
                <span class="closeModal">&times;</span>
                <img class="modal-content center" id="img01">
            </div>
            <!-- The Modal -->
            <div class="row">
                <div id="dataTablesApp" class="col-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-1 text-center">@lang('messages.real_estates_list_image_column_caption')</div>
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-1 datatable-header-padding-0 text-center"><p>@lang('messages.real_estates_list_id_column_caption')</p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.real_estates_list_meg_column_caption')</p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.locationneighborhoods_datapage_district_label')</p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.routes_datapage_item_locationStreet-1_label')</p></div>
                                    <div class="col-1 datatable-header-padding-0 text-center"><p>@lang('messages.routes_datapage_item_locationStreet-3_label')</p></div>
                                    <div class="col-1 datatable-header-padding-0 text-center"><p>  m<sup style='top: -0.5em'>2</sup></p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.real_estates_list_gross_column_caption')</p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.client_requirements_datapage_price_min_label')</p></div>
                                    <div class="col-1 datatable-header-padding-0 text-center"><p>@lang('messages.routes_datapage_item_score_label')</p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.real_estates_datapage_build_year_label')</p></div>
                                    <div class="col-1 datatable-header-padding-0"><p>@lang('messages.real_estates_datapage_renovation_year_label')</p></div>
                                    {{--                            <div class="col-1"></div>--}}
                                    <div class="col-1">Utvonal sorszam</div>
                                </div>
                            </div>
                        </div>
                        <div id="route-item-list-wrapper">
                            <div id="route-item-list" class="list-group">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    <script type="text/javascript">

        function loadRouteItems() {
            $('.list-group-item-body').toggleClass('loading');
            $.get('{{ route('realEstateRoutes.routeItemList', [$record->id]) }}' )
                .done(function (result) {
                    $('#route-item-list').html(result);
                    $('.list-group-item-header').on('click', function () {
                        $(this).toggleClass('active');
                        $(this).parent().toggleClass('active');
                    });
                })
                .fail(function () {
                })
                .always(function () {
                    if (($('#route-item-list .list-group-item').length > 0)){
                        $('#itemDeleteButton').css('display', 'inline' );
                    } else {
                        $('#itemDeleteButton').css('display', 'none' );
                    }
                    $('.list-group-item-body').toggleClass('loading');
                });
        }

        function deleteRouteItems(){
            if ( !confirm('@lang('messages.list_selected_item_delete_confirm_text')') ) return;
            let ids = [];
            $('#route-item-list').find('.active').each(function(){
                ids.push($(this).attr('data-id'));
            });
            let idString = ids.join(',');
            console.log(idString);
            $.post('{{ route('realEstateRoutes.deleteItems', [$record->id]) }}', { ids: idString } )
                .done(function (result) {
                })
                .fail(function () {
                })
                .always(function () {
                    loadRouteItems();
                });
        }

        function deleteRouteItem(id){
            if ( !confirm('@lang('messages.list_selected_item_delete_confirm_text')') ) return;
            $.post('{{ route('realEstateRoutes.deleteItems', [$record->id]) }}', { ids: id } )
                .done(function (result) {
                })
                .fail(function () {
                })
                .always(function () {
                    loadRouteItems();
                });
        }

        function routeItemCollapseClick(e) {
            e.stopImmediatePropagation();
            $(e.target).toggleClass('fa-angle-right');
            $(e.target).toggleClass('fa-angle-up');
            $(e.target).parent().parent().parent().parent().parent().parent().parent().find('.list-group-item-body').toggle();
        }

        function reindexRouteItems(id){
            $.post('{{ route('realEstateRoutes.reindexItems', [$record->id]) }}' )
                .done(function (result) {
                    console.log(result.message);
                })
                .fail(function () {
                })
                .always(function () {
                    loadRouteItems();
                });
        }

        /* Open the image with a big picture in modal */
        function OpenGallery (img) {
            // Get the modal
            var modal = document.getElementById("myModal");
            // Get the image and insert it inside the modal
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = img.srcset;
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeModal")[0];
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        }


        $(document).ready(function () {

            var sortable = Sortable.create( document.getElementById('route-item-list') , {
                onEnd: function (event) {
                    var itemEl = event.item;  // dragged HTMLElement
                    var id = $(itemEl).attr('data-id');
                    $.post('{{ route('realEstateRoutes.dragReorderItems') }}', { routeId: '{{$record->id}}', itemId: id, oldIndex: event.oldIndex, newIndex: event.newIndex } )
                        .done(function (result) {
                            if (result.status == 'error'){
                                console.error(result.message);
                            } else {
                                console.log(result.message);
                            }
                        })
                        .fail(function () {
                        })
                        .always(function () {
                            if (event.oldIndex != event.newIndex) loadRouteItems();
                        });
                },
            });

            loadRouteItems();
        });


    </script>
@endsection
