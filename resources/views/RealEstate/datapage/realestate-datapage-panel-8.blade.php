@php
    /**
    * @var \App\Models\RealEstate $record
    */
@endphp

<div class="card">
    <div class="card-header" id="heading-8">
        <h5 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-8" aria-expanded="true" aria-controls="collapse-8">
                @lang('messages.real_estates_datapage_left_col_panel_8_caption')
            </button>
        </h5>
    </div>
    <div id="collapse-8" class="collapse show" aria-labelledby="heading-8" data-parent="#leftSections">
        <div class="card-body">
            <div class="col-12">
                <div id="imageGalleryApp">
                    <lightbox
                            :images="[ @foreach($record->getMedia('images') as $media) { thumb: '{{ $media->getUrl('admin-list-thumb') }}', src: '{{ $media->getUrl('admin-gallery-main-image') }}' }, @endforeach ]"
                            ref="lightbox"
                            :show-caption="false"
                            :show-light-box="false">
                    </lightbox>
                    @foreach($record->getMedia('images') as $media)
                        <a @click="showImage({{ $loop->index }})"><img src="{{ $media->getUrl('admin-list-thumb') }}" alt="" /></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
