@php
    use App\Models\Partner;
    use App\Models\Enum\ClientPreferredContactEnum;
    /**
    * @var Partner[] $partners
    */
@endphp
<div class="card">
    <div class="card-header" id="heading-1">
        <h5 class="mb-0 float-left" style="padding: .75rem  1.25rem">
            @lang('messages.partners_page_title')
        </h5>
            <a href="{{ route('partners.create') }}"
               style="padding: .75rem  1.25rem;"
               class="btn btn-primary float-right">@lang('messages.partners_new_button')</a>
    </div>
    @if(!is_null($partners) || !empty($partners))
        <div class="table-sm-responsive">
            <table id="table" class="table table-striped dataTables     no-footer">
                <thead>
                <th scope="col" class="admin-list-manage-colhead">@lang('messages.crud_manage_column_caption')</th>
                <th scope="col" style="width:300px;">@lang('messages.partners_list_td_head_name')</th>
                <th scope="col"
                    style="width:300px;">@lang('messages.partners_list_td_head_preferred')</th>
                </thead>
                <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td style="text-align: center;">
                            <div class="float-left" style="padding-top: 0.1rem;">
                                <a href="{{ route('partners.edit', $partner->id) }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </div>
                            <form class="float-right" method="post" action="{{ route('partners.destroy', $partner->id) }}">
                                @csrf
                                @method('POST')
                                <button style="padding-top: 0; padding-bottom: 0" type="submit" class="btn btn-link"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $partner->partner_name }}</td>
                        <td>
                            @php $partnerEnum =  empty(ClientPreferredContactEnum::getDescription($partner->preferred_contact_enum))? null :ClientPreferredContactEnum::getDescription($partner->preferred_contact_enum); @endphp
                            @if(!is_null($partnerEnum))
                                {{ $partnerEnum }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


