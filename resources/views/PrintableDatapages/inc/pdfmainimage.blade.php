{{--<div style="background-color:grey; width: 100%; height: 490px; overflow-y:hidden">--}}
{{--    <img src="{{ asset($item->getMedia('images')->first()->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" />--}}
{{--</div>--}}
<div style="background-color:grey; width: 100%; height: 400px; overflow-y:hidden">
@if(!is_null($item->getMedia('images')->first()))
    <img src="{{ asset($item->getMedia('images')->first()->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" />
@endif
</div>
