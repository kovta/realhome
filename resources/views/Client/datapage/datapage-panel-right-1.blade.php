<div class="card">
    <div class="card-header" id="meta-heading-1">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#meta-collapse-1" aria-expanded="true" aria-controls="meta-collapse-1">
                @lang('messages.clients_datapage_panel_right_1_title_caption')
            </button>
        </h5>
    </div>

    <div id="meta-collapse-2" class="collapse show" aria-labelledby="meta-heading-2" data-parent="#rightSections">
        <div class="card-body">

            <div class="col-12" style="margin: 5px 0;">
                <a class="btn btn-secondary" href="{{ route('realEstateOffers.index', $record->id) }}"><i class="fas fa-folder-open"></i> Ajanlatok</a>
            </div>
            <div class="col-12" style="margin: 5px 0;">
                <a class="btn btn-secondary" href="#"><i class="fas fa-heart"></i> Kívánalmak</a>
            </div>

        </div>
    </div>
</div>
