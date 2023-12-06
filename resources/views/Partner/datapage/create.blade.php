@php
    use App\Models\Partner;
    use App\Models\Enum\ClientPreferredContactEnum;
    /**
    * @var Partner $partner
    * @var ClientPreferredContactEnum $preferredContacts
    */
@endphp

@extends('layouts.admin.defaultpage')

@section('title', __('messages.partners_partner_panel_title'))

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.partners_partner_panel_title')</div>

        <form method="POST" action="{{route('partners.store', ['id' => $partner->id])}}">
            @csrf
            @method('POST')

            @include('Partner.datapage.partner-datapage-body')

            <div class="row" style="margin-top: 20px;">
                <input type="submit" class="btn btn-primary save" value="@lang('messages.button_save_caption')" />
            </div>
        </form>

    </div>

@endsection
