<div style="width:80%; margin: 0 auto; height:50px; overflow-y: hidden;">
    @if(!empty($item->getFeatures()))
        @foreach(array_chunk($item->getFeatures(), (ceil(count($item->getFeatures())/3)), true) as $featureChunk)
            <div style="float:left; display:inline; width:33%;">
                @foreach($featureChunk as $featureData)
                    @if($loop->index <= 3)
                        <p style="margin:5px; padding-left:5px; font-size:13px; font-weight:bold;"><i class="fa-solid fa-check"></i> <span style="padding-left:5px;">{{ $featureData }}</span></p>
                    @endif
                @endforeach
            </div>
        @endforeach
    @endif
    <div style="clear:left;"></div>
</div>
