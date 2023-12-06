
@extends('layouts.admin.defaultpage')

@section('title', __('messages.partners_partner_panel_title'))

@section('content')

    <div class="admin-form-wrapper">
        <div style="overflow: unset" class="card col-sm-6">
            <div class="card-header" id="heading-1">
                <h5>
                    Partner valaszto
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ route('partners.relationship.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="client_id" value="{{ $client_id }}">
                            <div id="PartnerSelectorApp">
                                <partner-selector url="{{ route('partnerQueryAjax') }}"></partner-selector>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
