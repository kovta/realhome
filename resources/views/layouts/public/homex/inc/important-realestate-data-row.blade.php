<ul>
    <li>
        @lang('public.real_estate_base_area_gross_label')<br/>
        <span>{{ $realEstate->base_area_gross }} m<sup>2</sup></span>
    </li>
    <li>
        @lang('public.real_estate_number_levels_label')<br/>
        <span>{{ $realEstate->number_levels }}</span>
    </li>
    <li>
        @lang('public.real_estate_number_bedroom_label')<br/>
        <span>{{ $realEstate->number_bedroom }}</span>
    </li>
    <li>
        @lang('public.real_estate_number_bath_label')<br/>
        <span>{{ $realEstate->number_bath + $realEstate->number_shower }}</span>
    </li>
    <li>
        @lang('public.real_estate_number_garage_label')<br/>
        <span>{{ $realEstate->number_garage }}</span>
    </li>
    <li>
        @lang('public.real_estate_terrace_size_label')<br/>
        <span>{{ $realEstate->terrace_size }} m<sup>2</sup></span>
    </li>
    <li>
        @lang('public.real_estate_kitchen_type_label')<br/>
        <span>{{ \App\Models\Enum\RealEstateKitchenTypeEnum::getDescription($realEstate->real_estate_kitchen_type_enum) }}</span>
    </li>
</ul>
