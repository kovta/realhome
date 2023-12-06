<div class="btn-group" id="locale-switch-wrapper">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('messages.location_switch_toggle_translation') <span>{{app()->getLocale()}}</span></button>
    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 28px, 0px);">
        @foreach(config('translatable.locales') as $locale)
            <span class="dropdown-item" data-locale="{{$locale}}">@lang('messages.location_switch_change_to') {{$locale}}</span>
        @endforeach
    </div>
</div>
