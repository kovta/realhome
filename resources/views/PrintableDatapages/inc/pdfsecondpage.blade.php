<div style="width: 100%; height: 400px; overflow-y:hidden">
    @if(!is_null($item->getMedia('images')->get(2)))
    <img src="{{ asset($item->getMedia('images')->get(2)->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" />
    @endif
</div>
<div style="margin-top:5mm; width: 100%;">
    @if(!is_null($item->getMedia('images')->get(3)))
    <div style="float:left; display: inline; width:50%;">
        <div style="padding-right:2.5mm; padding-bottom:5mm;"><img src="{{ asset($item->getMedia('images')->get(3)->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" /></div>
    </div>
    @endif
    @if(!is_null($item->getMedia('images')->get(4)))
    <div style="float:left; display: inline; width:50%;">
        <div style="padding-left:2.5mm; padding-bottom:5mm;"><img src="{{ asset($item->getMedia('images')->get(4)->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" /></div>
    </div>
    @endif
    @if(!is_null($item->getMedia('images')->get(5)))
    <div style="float:left; display: inline; width:50%;">
        <div style="padding-right:2.5mm; padding-bottom:4mm;"><img src="{{ asset($item->getMedia('images')->get(5)->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" /></div>
    </div>
    @endif
    @if(!is_null($item->getMedia('images')->get(6)))
    <div style="float:left; display: inline; width:50%;">
        <div style="padding-left:2.5mm;"><img src="{{ asset($item->getMedia('images')->get(6)->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto;" /></div>
    </div>
    @endif
    <div style="clear: left;"></div>
</div>
