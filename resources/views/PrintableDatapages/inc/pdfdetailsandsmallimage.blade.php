<div style="height: 208px; padding:0; margin-top:5mm; margin-bottom:4mm; overflow-y: hidden;">
    <div style="float:left; display:inline; width: 50%; overflow-y: hidden;">
        <div style="padding-right:20px;">
            <p style="font-size:14px; font-weight:bold;">@lang('offerpdf.Leírás'):</p>
            <p style="font-size:13px; font-weight:300;">{!! \Illuminate\Support\Str::limit(strip_tags($item->getTranslation($locale)->description), 1016,'(..)' ) !!}</p>
        </div>
    </div>
    <div style="float:left; display:inline; width: 50%; overflow-y: hidden;">
        <div style="width:100%;">
            @if(!is_null($item->getMedia('images')->get(1)))
            <img src="{{ asset($item->getMedia('images')->get(1)->getUrl('public-realestate-datapage-gallery-image')) }}" style="width: 100%; height: auto; padding:0; margin:0;" />
            @endif
        </div>
    </div>
    <div style="clear:left;"></div>
</div>
