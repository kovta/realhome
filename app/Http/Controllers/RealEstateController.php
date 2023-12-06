<?php

namespace App\Http\Controllers;

use App\Http\FileManager;
use App\Models\AdvertisingPartner;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Enum\UserTypeEnum;
use App\Models\Enum\RealEstateAgriculturalSubTypeEnum;
use App\Models\Enum\RealEstateCateringSubTypeEnum;
use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\Enum\RealEstateDevelopmentSiteEnum;
use App\Models\Enum\RealEstateDefaultEnum;
use App\Models\Enum\RealEstateFurnitureEnum;
use App\Models\Enum\RealEstateGardenTypeEnum;
use App\Models\Enum\RealEstateHeatingTypeEnum;
use App\Models\Enum\RealEstateHouseSubTypeEnum;
use App\Models\Enum\RealEstateIndustrialSubTypeEnum;
use App\Models\Enum\RealEstateKitchenTypeEnum;
use App\Models\Enum\RealEstateOfficeLocationEnum;
use App\Models\Enum\RealEstateOrientationEnum;
use App\Models\Enum\RealEstateRetailUnitLocationEnum;
use App\Models\Enum\RealEstateStateEnum;
use App\Models\Enum\RealEstateStatusEnum;
use App\Models\Enum\RealEstateVistaEnum;
use App\Models\Enum\RealEstateWareHouseSubTypeEnum;
use App\Models\Enum\RealEstateWebStatusEnum;
use App\Models\LocationArea;
use App\Models\LocationNeighborhood;
use App\Models\LocationTownDistrict;
use App\Models\RealEstate;
use App\Models\RealEstateType;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Http\Traits\FilterableListTrait;

class RealEstateController extends Controller
{
    use FilterableListTrait;

    /**
     * @var bool
     */
    public bool $filterSavedToSession = true;
    /**
     * @var string
     */
    public string $filterSessionKey = 'RealEstateListFilter';
    /**
     * @var string[]
     */
    public array $filterFields = [
        'code',
        'price_min',
        'price_max',
        'price_currency_id',
        'number_garage_plus_parking',
        'furniture_enums',
        'garden',
        'build_year_min',
        'build_year_max',
        'gross_base_area_min',
        'gross_base_area_max',
        'livingroom_size_min',
        'score_min',
        'floor_min',
        'floor_max',
        'kitchen_type_enums',
        'number_bedroom_min',
        'number_bedroom_max',
        'number_bath_min',
        'location_area_id',
        'location_town_district_id',
        'location_neighborhood_id',
        'szabadszavas',
        'kapcsolattartotulajdonosfilter',
        'utcanevfilter',
        'number_garage_plus_parking',
        'pet_allowed',
        'small_pet_allowed',
        'alarm_system',
        'airconditioning',
        'fireplace',
        'cabeltv',
        'satellite_system',
        'internet',
        'security_service_24h',
        'indoor_pool',
        'outdoor_pool',
        'jacuzzi',
        'sauna',
        'hobby_room_gim',
        'guest_apartment',
        'elevator',
        'panoramic_view',
        'danube_view',
        'balcony',
        'terrace',
        'roof_terrace',
        'winter_garden',
        'irrigation',
        'en_suit_bathroom',
        'laurdy',
        'cellar',
        'hard_wood_flooring',
        'floor_heating',
        'high_ceiling',
        'central_vacuum_cleaner',
        'accessibility',
    ];
    /**
     * @var string[]
     */
    public array $numberFilterFields = [
        'price_min',
        'price_max',
        'number_garage_plus_parking',
        'gross_base_area_min',
        'gross_base_area_max',
        'livingroom_size_min',
        'score_min',
        'floor_min',
        'floor_max',
        'kitchen_type_enums',
        'number_bedroom_min',
        'number_bedroom_max',
        'number_bath_min',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|void
     */
    public function index(Request $request) : View
    {
        $selectableItems = $request->input('selection', null);    // kiválasztós üzemmód
        $nextRouteName = $request->input('nextStep', null);       // a kiválasztást követő route neve
        $entityId = $request->input('entityId', null);            // a kiválasztást 'megrendelő' entitás azonosítója
        if ($selectableItems === 1 && (!$nextRouteName || !$entityId) ) {
            return abort(400, 'Kivalasztos uzemmodban a tablanak tobb parameter kell!');
        }

        $statuses = RealEstateStatusEnum::toSelectValueSet();
        $contractTypeEnums = RealEstateContractTypeEnum::toSelectValueSet();
		$realEstateTypes = RealEstateType::all();

        $notused = new Collection();
        $filters = $this->processFilters($notused, $request);
        $numberOfFilters = count($filters) - count(array_filter($filters, "is_null"));
        $currencies = Currency::all()->sortBy('iso_code');
        $kitchenTypes = RealEstateKitchenTypeEnum::toSelectValueSet( ($filters['kitchen_type_enums']) ?: []);
        $furnitureTypes = RealEstateFurnitureEnum::toSelectValueSet(($filters['furniture_enums']) ?: []);
		if ($filters['location_area_id'] !== null) {
            $requestArray = explode(',', $filters['location_area_id']);
            $requestAreaNameArray = LocationArea::whereIn('id', $requestArray)->get()->toArray();
            unset($requestArray);
            if ($filters['location_town_district_id'] !== null) {
                $requestArray = explode(',', $filters['location_town_district_id']);
                $requestTownDistrictNameArray = LocationTownDistrict::whereIn('id', $requestArray)->get()->toArray();
                $filters['location_town_district_id'] = $requestArray;
                unset($requestArray);
            }
            if ($filters['location_neighborhood_id'] !== null) {
                $requestArray = explode(',', $filters['location_neighborhood_id']);
                $requestNeighborhoodNameArray = LocationNeighborhood::whereIn('id', $requestArray)->get()->toArray();
                $filters['location_town_district_id'] = $requestArray;
                unset($requestArray);
            }
        }

        return view('RealEstate.realestate-list', [
            'statuses' => $statuses,
            'contractTypeEnums' => $contractTypeEnums,
            'realEstateTypes' => $realEstateTypes,
            'selectableItems' => $selectableItems,
            'nextRouteName' => $nextRouteName,
            'entityId' => $entityId,

            'filters' => $filters,
            'requestAreaNameArray' => $requestAreaNameArray ?? null,
            'requestTownDistrictNameArray' => $requestTownDistrictNameArray ?? null,
            'requestNeighborhoodNameArray' => $requestNeighborhoodNameArray ?? null,
            'kitchenTypes' => $kitchenTypes,
            'furnitureTypes' => $furnitureTypes,
            'currencies' => $currencies,

            'numberOfFilters' => $numberOfFilters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $record = array();
        $coWorkers = Client::all();
        foreach($coWorkers as $item)
        {
            if(optional($item->user)->type_enum == UserTypeEnum::adminuser)
            {
                $record[] = $item;
            }
        }

        $realEstate = new RealEstate();

        $statuses = RealEstateStatusEnum::toSelectValueSet([old('status_enum', $realEstate->status_enum)]);
        $webStatuses = RealEstateWebStatusEnum::toSelectValueSet([old('web_status_enum', $realEstate->web_status_enum)]);
        //$users = User::all();
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([old('contract_type_enum', $realEstate->contract_type_enum)]);
        $realEstateTypes = RealEstateType::all()->sortBy('name');
        $orientations = RealEstateOrientationEnum::toSelectValueSet([old('real_estate_orientation_enum', $realEstate->real_estate_orientation_enum)]);
        $vistas = RealEstateVistaEnum::toSelectValueSet([old('real_estate_vista_enum', $realEstate->real_estate_vista_enum)]);
        $kitchenTypes = RealEstateKitchenTypeEnum::toSelectValueSet([old('real_estate_kitchen_type_enum', $realEstate->real_estate_kitchen_type_enum)]);
        $furnitures = RealEstateFurnitureEnum::toSelectValueSet([old('real_estate_furniture_enum', $realEstate->real_estate_furniture_enum)]);
        $gardenTypes = RealEstateGardenTypeEnum::toSelectValueSet([old('real_estate_garden_type_enum', $realEstate->real_estate_garden_type_enum)]);
        $heatingTypes = RealEstateHeatingTypeEnum::toSelectValueSet([old('real_estate_heating_type_enum', $realEstate->real_estate_heating_type_enum)]);
        $availableAdvertisingPartners = AdvertisingPartner::all();
        $assignedAdvertisingPartners = old('advertising_partners', $realEstate->advertisingPartners);
        if (is_array($assignedAdvertisingPartners)){
            $assignedAdvertisingPartners = AdvertisingPartner::whereIn('id', $assignedAdvertisingPartners)->get();
        }
        $states = RealEstateStateEnum::toSelectValueSet([old('real_estate_state_enum', $realEstate->real_estate_state_enum)]);
        $houseSubtypes = RealEstateHouseSubTypeEnum::toSelectValueSet([old('real_estate_house_sub_type_enum', $realEstate->real_estate_house_sub_type_enum)]);
        $unitLocations = RealEstateRetailUnitLocationEnum::toSelectValueSet([old('real_estate_retail_unit_location_enum', $realEstate->real_estate_retail_unit_location_enum)]);
        $officeLocations = RealEstateOfficeLocationEnum::toSelectValueSet([old('real_estate_office_location_enum', $realEstate->real_estate_office_location_enum)]);
        $wareHouseSubtypes = RealEstateWareHouseSubTypeEnum::toSelectValueSet([old('real_estate_warehouse_sub_type_enum', $realEstate->real_estate_warehouse_sub_type_enum)]);
        $cateringSubtypes = RealEstateCateringSubTypeEnum::toSelectValueSet([old('real_estate_catering_sub_type_enum', $realEstate->real_estate_catering_sub_type_enum)]);
        $industrialSubtypes = RealEstateIndustrialSubTypeEnum::toSelectValueSet([old('real_estate_industrial_sub_type_enum', $realEstate->real_estate_industrial_sub_type_enum)]);
        $agriculturalSubtypes = RealEstateAgriculturalSubTypeEnum::toSelectValueSet([old('real_estate_agricultural_sub_type_enum', $realEstate->real_estate_agricultural_sub_type_enum)]);
        $developmentSites = RealEstateDevelopmentSiteEnum::toSelectValueSet([old('real_estate_development_site_enum', $realEstate->real_estate_development_site_enum)]);
        $currencies = Currency::all()->sortBy('iso_code');
        $areas = LocationArea::all();
        $selectedAreas = LocationArea::whereId($realEstate->location_area_id)->get()->toArray();
        $selectedTownDistrict = LocationTownDistrict::whereId($realEstate->location_town_district_id)->get()->toArray();
        $selectedNeighborhood = LocationNeighborhood::whereId($realEstate->location_neighborhood_id)->get()->toArray();

        return view('RealEstate.datapage.realestate-create', [
            'record' => $realEstate,
            'statuses' => $statuses,
            'web_statuses' => $webStatuses,
            'coWorkers' => $record,
            'contract_types' => $contractTypes,
            'real_estate_types' => $realEstateTypes,
            //'users' => $users,
            'orientations' => $orientations,
            'vistas' => $vistas,
            'kitchenTypes' => $kitchenTypes,
            'furnitures' => $furnitures,
            'gardenTypes' => $gardenTypes,
            'heatingTypes' => $heatingTypes,
            'states' => $states,
            'houseSubtypes' => $houseSubtypes,
            'unitLocations' => $unitLocations,
            'officeLocations' => $officeLocations,
            'wareHouseSubtypes' => $wareHouseSubtypes,
            'cateringSubtypes' => $cateringSubtypes,
            'industrialSubtypes' => $industrialSubtypes,
            'agriculturalSubtypes' => $agriculturalSubtypes,
            'developmentSites' => $developmentSites,
            'availableAdvertisingPartners' => $availableAdvertisingPartners,
            'assignedAdvertisingPartners' => $assignedAdvertisingPartners,
            'currencies' => $currencies,
            'areas' => $areas,
            'selectedAreas' => $selectedAreas ?? null,
            'selectedTownDistrict' => $selectedTownDistrict ?? null,
            'selectedNeighborhood' => $selectedNeighborhood ?? null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate(RealEstate::validationRules());

        $entity = new RealEstate();
        $data = $request->only($entity->getFillable());

        foreach ($entity->checkboxes as $checkbox){
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) {
                $data[$checkbox] = null;
            }
        }
        $entity->fill($data);

        foreach(config('translatable.locales') as $locale) {
            $entity->translateOrNew($locale)->marketing_name = $request->input("$locale.marketing_name");
            $entity->translateOrNew($locale)->description = $request->input("$locale.description");
        }

        // metas
        $entity->created_by_id = $request->created_by_id;
        $entity->updated_at = $request->updated_at;
        $entity->score = $request->score;
        $entity->web_appearances = $request->web_appearances;
        $entity->web_interestes = $request->web_interestes;


        $entity->save();

        // spec relations after save the main object
        $entity->advertisingPartners()->sync($request->advertising_partners);

        return redirect(route('realEstates.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param RealEstate $realEstate
     * @return void
     */
    public function show(RealEstate $realEstate): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RealEstate $realEstate
     * @return View
     */
    public function edit(RealEstate $realEstate): View
    {
        $record = array();
        $coWorkers = Client::all();
        foreach($coWorkers as $item)
        {
            if(optional($item->user)->type_enum == UserTypeEnum::adminuser)
            {
                $record[] = $item;
            }
        }

        $statuses = RealEstateStatusEnum::toSelectValueSet([old('status_enum', $realEstate->status_enum)]);
        $webStatuses = RealEstateWebStatusEnum::toSelectValueSet([old('web_status_enum', $realEstate->web_status_enum)]);
        //$users = User::all();
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([old('contract_type_enum', $realEstate->contract_type_enum)]);
        $realEstateTypes = RealEstateType::all()->sortBy('name');
        $orientations = RealEstateOrientationEnum::toSelectValueSet([old('real_estate_orientation_enum', $realEstate->real_estate_orientation_enum)]);
        $vistas = RealEstateVistaEnum::toSelectValueSet([old('real_estate_vista_enum', $realEstate->real_estate_vista_enum)]);
        $kitchenTypes = RealEstateKitchenTypeEnum::toSelectValueSet([old('real_estate_kitchen_type_enum', $realEstate->real_estate_kitchen_type_enum)]);
        $furnitures = RealEstateFurnitureEnum::toSelectValueSet([old('real_estate_furniture_enum', $realEstate->real_estate_furniture_enum)]);
        $gardenTypes = RealEstateGardenTypeEnum::toSelectValueSet([old('real_estate_garden_type_enum', $realEstate->real_estate_garden_type_enum)]);
        $heatingTypes = RealEstateHeatingTypeEnum::toSelectValueSet([old('real_estate_heating_type_enum', $realEstate->real_estate_heating_type_enum)]);
        $availableAdvertisingPartners = AdvertisingPartner::all();
        $assignedAdvertisingPartners = old('advertising_partners', $realEstate->advertisingPartners);
        if (is_array($assignedAdvertisingPartners)){
            $assignedAdvertisingPartners = AdvertisingPartner::whereIn('id', $assignedAdvertisingPartners)->get();
        }
        $states = RealEstateStateEnum::toSelectValueSet([old('real_estate_state_enum', $realEstate->real_estate_state_enum)]);
        $houseSubtypes = RealEstateHouseSubTypeEnum::toSelectValueSet([old('real_estate_house_sub_type_enum', $realEstate->real_estate_house_sub_type_enum)]);
        $unitLocations = RealEstateRetailUnitLocationEnum::toSelectValueSet([old('real_estate_retail_unit_location_enum', $realEstate->real_estate_retail_unit_location_enum)]);
        $officeLocations = RealEstateOfficeLocationEnum::toSelectValueSet([old('real_estate_office_location_enum', $realEstate->real_estate_office_location_enum)]);
        $wareHouseSubtypes = RealEstateWareHouseSubTypeEnum::toSelectValueSet([old('real_estate_warehouse_sub_type_enum', $realEstate->real_estate_warehouse_sub_type_enum)]);
        $cateringSubtypes = RealEstateCateringSubTypeEnum::toSelectValueSet([old('real_estate_catering_sub_type_enum', $realEstate->real_estate_catering_sub_type_enum)]);
        $industrialSubtypes = RealEstateIndustrialSubTypeEnum::toSelectValueSet([old('real_estate_industrial_sub_type_enum', $realEstate->real_estate_industrial_sub_type_enum)]);
        $agriculturalSubtypes = RealEstateAgriculturalSubTypeEnum::toSelectValueSet([old('real_estate_agricultural_sub_type_enum', $realEstate->real_estate_agricultural_sub_type_enum)]);
        $developmentSites = RealEstateDevelopmentSiteEnum::toSelectValueSet([old('real_estate_development_site_enum', $realEstate->real_estate_development_site_enum)]);
        $currencies = Currency::all()->sortBy('iso_code');
        $commission_contract_name = ($realEstate->commission_contract_id) ? $realEstate->getMedia('files')->firstWhere('id', '=', $realEstate->commission_contract_id) : null;
        $areas = LocationArea::all();
        $selectedAreas = LocationArea::whereId($realEstate->location_area_id)->get()->toArray();
        $selectedTownDistrict = LocationTownDistrict::whereId($realEstate->location_town_district_id)->get()->toArray();
        $selectedNeighborhood = LocationNeighborhood::whereId($realEstate->location_neighborhood_id)->get()->toArray();

        return view('RealEstate.datapage.realestate-edit', [
            'record' => $realEstate,
            'statuses' => $statuses,
            'web_statuses' => $webStatuses,
            'coWorkers' => $record,
            'contract_types' => $contractTypes,
            'real_estate_types' => $realEstateTypes,
            //'users' => $users,
            'orientations' => $orientations,
            'vistas' => $vistas,
            'kitchenTypes' => $kitchenTypes,
            'furnitures' => $furnitures,
            'gardenTypes' => $gardenTypes,
            'heatingTypes' => $heatingTypes,
            'states' => $states,
            'houseSubtypes' => $houseSubtypes,
            'unitLocations' => $unitLocations,
            'officeLocations' => $officeLocations,
            'wareHouseSubtypes' => $wareHouseSubtypes,
            'cateringSubtypes' => $cateringSubtypes,
            'industrialSubtypes' => $industrialSubtypes,
            'agriculturalSubtypes' => $agriculturalSubtypes,
            'developmentSites' => $developmentSites,
            'availableAdvertisingPartners' => $availableAdvertisingPartners,
            'assignedAdvertisingPartners' => $assignedAdvertisingPartners,
            'commission_contract_name' => $commission_contract_name,
            'currencies' => $currencies,
            'areas' => $areas,
            'selectedAreas' => $selectedAreas ?? null,
            'selectedTownDistrict' => $selectedTownDistrict ?? null,
            'selectedNeighborhood' => $selectedNeighborhood ?? null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RealEstate $realEstate
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, RealEstate $realEstate): Redirector|RedirectResponse|Application
    {
        $request->validate(RealEstate::validationRules());

        $entity = $realEstate;
        $data = $request->only($entity->getFillable());

        foreach ($entity->checkboxes as $checkbox){
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) {
                $data[$checkbox] = null;
            }
        }
        $entity->fill($data);

        foreach(config('translatable.locales') as $locale) {
            $entity->translateOrNew($locale)->marketing_name = $request->input("$locale.marketing_name");
            $entity->translateOrNew($locale)->description = $request->input("$locale.description");
        }

        $entity->save();
        // spec relations after save the main object
        $entity->advertisingPartners()->sync($request->advertising_partners);

        return redirect(route('realEstates.edit', $realEstate->id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $entity = RealEstate::find($id);
        if ($entity != null) {
            $entity->delete();
        }
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function tableDataLoader(Request $request)
    {
        $q = RealEstate::query();//->with('realEstates');
        $nextRouteName = request()->get('nextRouteName');
        $entityId = request()->get('entityId');

        // alap szuro, pl. csak azok az ingatlanok, amik nem szerepelnek egy ajanlatban
        if (str_contains($nextRouteName, 'realEstateOffers.addItem')) {
            $collection = DB::table('real_estate_offer_components')
                ->select('real_estate_id')
                ->where('offer_id', '=', $entityId)
                ->get();
            $ids = $collection->implode('real_estate_id', ', ');
            if ($ids !== ''){
                $ids = explode(', ', $ids);
                $q->whereNotIn('id', $ids);
            }
        }
        //
        if(request()->has('filter')) {
            $filters = collect(request()->get('filter'));
            $this->processFilters($filters, $request);

            // szabadszavas filter
            /*
            if($filters->get('szabadszavas') !== null){
                $szabadszavastomb = explode(' ', $filters->get('szabadszavas'));
                foreach($szabadszavastomb as $searchword) {
                    if(!empty($searchword)) {
                        $q->orWhere('street_address_1', 'like', '%' . $searchword . '%');
                        $q->orWhere('street_address_2', 'like', '%' . $searchword . '%');
                        $q->orWhere('street_address_3', 'like', '%' . $searchword . '%');
                        $q->orWhere('owner_name', 'like', '%' . $searchword . '%');
                        $q->orWhere('owner_contact_name', 'like', '%' . $searchword . '%');
                    }
                }
            }
            */

            // kapcsolattartó vagy tulajdonos név filter (teljes kifejezésre keres vagy az egyik, vagy a másik értékben)
            if($filters->get('kapcsolattartotulajdonosfilter') !== null) {
                $q->where(function ($query) use ($filters) {
                    $f = $filters->get('kapcsolattartotulajdonosfilter');
                    $query
                        ->orWhere('owner_name', 'like', '%' . $f . '%')
                        ->orWhere('owner_contact_name', 'like', '%' . $f . '%');
                });
            }

            // utcanév keresés:
            if($filters->get('utcanevfilter') !== null) {
                $q->where('street_address_1', 'like', '%'.$filters->get('utcanevfilter').'%');
            }

            // ID filter
            if($filters->get('code') !== null){
                $q->where('code', 'like', '%'.$filters->get('code').'%');
            }

            // location filter
            if ($filters->get('location_area_id') !== null){
                $requestArray = explode(',', $filters->get('location_area_id'));
                $q->whereIn('location_area_id', $requestArray);
                unset($requestArray);
            }
            if ($filters->get('location_town_district_id') !== null){
                $requestArray = explode(',', $filters->get('location_town_district_id'));
                $q->whereIn('location_town_district_id', $requestArray);
                unset($requestArray);
            }
            if ($filters->get('location_neighborhood_id') !== null){
                $requestArray = explode(',', $filters->get('location_neighborhood_id'));
                $q->whereIn('location_neighborhood_id', $requestArray);
                unset($requestArray);
            }
            //  status  filter
            if($filters->get('status_enum') !== null) {
                $q->where('status_enum', '=', $filters->get('status_enum'));
            }
            //  contract type filter
            if($filters->get('contract_type_enum') !== null) {
                $q->where('contract_type_enum', '=', $filters->get('contract_type_enum'));
            }
            //  real estate type filter
            if ($filters->get('real_estate_type_id') !== null){
                $q->whereIn('real_estate_type_id', $filters->get('real_estate_type_id') );
            }

            // price filter
            // (csak a vesszovel tagolt ezreseknel mukodik, mas formatummal nem)
            /*
            if (($filters->get('price_min') !== null) && ($filters->get('price_max') == null)) {
                //  csak a vesszovel tagolt ezreseknel mukodik, mas formatummal nem:
                $price_min_filter = (int)str_replace(',', '', $filters->get('price_min'));
                $q->where('offer_price', '>=', $price_min_filter);
                $q->orWhere('limit_price', '>=', $price_min_filter);
            } elseif (($filters->get('price_min') == null) && ($filters->get('price_max') !== null)) {
                //  csak a vesszovel tagolt ezreseknel mukodik, mas formatummal nem:
                $price_max_filter = (int)str_replace(',', '', $filters->get('price_max'));
                $q->where('offer_price', '<=', $price_max_filter);
                $q->orWhere('limit_price', '<=', $price_max_filter);
            } elseif (($filters->get('price_min') !== null) && ($filters->get('price_max') !== null)) {
                //  csak a vesszovel tagolt ezreseknel mukodik, mas formatummal nem:
                $price_min_filter = (int)str_replace(',', '', $filters->get('price_min'));
                $price_max_filter = (int)str_replace(',', '', $filters->get('price_max'));
                $q->whereBetween('limit_price', [$price_min_filter, $price_max_filter]);
            }
            */
            // price filter: kérésre: csak az irányárat vegye figyelembe:
            if (!empty($filters->get('price_min')) ) {
                //  csak a vesszovel tagolt ezreseknel mukodik, mas formatummal nem:
                $price_min_filter = (int)str_replace(',', '', $filters->get('price_min'));
            } else {
                $price_min_filter = 0;
            }
            if (!empty($filters->get('price_max'))) {
                //  csak a vesszovel tagolt ezreseknel mukodik, mas formatummal nem:
                $price_max_filter = (int)str_replace(',', '', $filters->get('price_max'));
                // legalacsonyabb árban keres:
                // $q->whereBetween('limit_price', [$price_min_filter, $price_max_filter], 'and');
                // irányárban keres:
                $q->whereBetween('offer_price', [$price_min_filter, $price_max_filter], 'and');
            } else {
                // legalacsonyabb árban keres:
                // $q->where('limit_price', '>=', $price_min_filter);
                // irányárban keres:
                $q->where('offer_price', '>=', $price_min_filter);
            }

            // currency filter
            if($filters->get('price_currency_id') !== null){
                $q->where('price_currency_id', '=', $filters->get('price_currency_id'));
            }

            // parking filter
            if($filters->get('number_garage_plus_parking') !== null){
                $q->where([
                    ['number_garage', '<>', 'null'],
                    ['number_parking', '<>', 'null'],
                ])->whereRaw('(number_garage + number_parking >= ?)', [$filters->get('number_garage_plus_parking')] );
            }

            // furniture filter
            if ($filters->get('furniture_enums') !== null){
                $q->whereIn('real_estate_furniture_enum', $filters->get('furniture_enums') );
            }

            // garden filter
            if($filters->get('garden') == FilterableListTrait::$threeSwitchOff){
                $q->where('real_estate_garden_type_enum', '=', RealEstateGardenTypeEnum::nincs);
            }
            if($filters->get('garden') == FilterableListTrait::$threeSwitchOn){
                $q->where('real_estate_garden_type_enum', '>', RealEstateGardenTypeEnum::nincs);
            }

            // build year filter
            if (($filters->get('build_year_min') !== null) && ($filters->get('build_year_max') == null)){
                $q->where('build_year', '>=', $filters->get('build_year_min'));
            } else
            if (($filters->get('build_year_min') == null) && ($filters->get('build_year_max') !== null)){
                $q->where('build_year', '<=', $filters->get('build_year_max'));
            } else
            if (($filters->get('build_year_min') !== null) && ($filters->get('build_year_max') !== null)){
                $q->whereBetween('build_year', [$filters->get('build_year_min'), $filters->get('build_year_max')]);
            }

            // base area filter
            if (($filters->get('gross_base_area_min') !== null) && ($filters->get('gross_base_area_max') == null)){
                $q->where('base_area_gross', '>=', $filters->get('gross_base_area_min'));
            } else
            if (($filters->get('gross_base_area_min') == null) && ($filters->get('gross_base_area_max') !== null)){
                $q->where('base_area_gross', '<=', $filters->get('gross_base_area_max'));
            } else
            if (($filters->get('gross_base_area_min') !== null) && ($filters->get('gross_base_area_max') !== null)){
                $q->whereBetween('base_area_gross', [$filters->get('gross_base_area_min'), $filters->get('gross_base_area_max')]);
            }

            // living room filter
            if (($filters->get('livingroom_size_min') !== null) ){
                $q->where('living_room_size', '>=', $filters->get('livingroom_size_min'));
            }

            // score filter
            if (($filters->get('score_min') !== null) ){
                $q->where('score', '>=', $filters->get('score_min'));
            }

            // floor filter
            if (($filters->get('floor_min') !== null) && ($filters->get('floor_max') == null)){
                $q->where('floor', '>=', $filters->get('floor_min'));
            } else
            if (($filters->get('floor_min') == null) && ($filters->get('floor_max') !== null)){
                $q->where('floor', '<=', $filters->get('floor_max'));
            } else
            if (($filters->get('floor_min') !== null) && ($filters->get('floor_max') !== null)){
                $q->whereBetween('floor', [$filters->get('floor_min'), $filters->get('floor_max')]);
            }

            // kitchen type filter
            if ($filters->get('kitchen_type_enums') !== null){
                $q->whereIn('real_estate_kitchen_type_enum', $filters->get('kitchen_type_enums') );
            }

            // bedroom filter
            if (($filters->get('number_bedroom_min') !== null) && ($filters->get('number_bedroom_max') == null)){
                $q->where('number_bedroom', '>=', $filters->get('number_bedroom_min'));
            } else
            if (($filters->get('number_bedroom_min') == null) && ($filters->get('number_bedroom_max') !== null)){
                $q->where('number_bedroom', '<=', $filters->get('number_bedroom_max'));
            } else
            if (($filters->get('number_bedroom_min') !== null) && ($filters->get('number_bedroom_max') !== null)){
                $q->whereBetween('number_bedroom', [$filters->get('number_bedroom_min'), $filters->get('number_bedroom_max')]);
            }

            // bath filter
            if (($filters->get('number_bath_min') !== null) ){
                $q->where('number_bath', '>=', $filters->get('number_bath_min'));
            }
            // pet_allowed filter
            if($filters->get('pet_allowed') == FilterableListTrait::$threeSwitchOff){
                $q->where('pet_allowed', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('pet_allowed') == FilterableListTrait::$threeSwitchOn){
                $q->where('pet_allowed', '=', RealEstateDefaultEnum::igen);
            }
            // small_pet_allowed filter
            if($filters->get('small_pet_allowed') == FilterableListTrait::$threeSwitchOff){
                $q->where('small_pet_allowed', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('small_pet_allowed') == FilterableListTrait::$threeSwitchOn){
                $q->where('small_pet_allowed', '=', RealEstateDefaultEnum::igen);
            }
            // alarm_system filter
            if($filters->get('alarm_system') == FilterableListTrait::$threeSwitchOff){
                $q->where('alarm_system', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('alarm_system') == FilterableListTrait::$threeSwitchOn){
                $q->where('alarm_system', '=', RealEstateDefaultEnum::igen);
            }
            // airconditioning filter
            if($filters->get('airconditioning') == FilterableListTrait::$threeSwitchOff){
                $q->where('airconditioning', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('airconditioning') == FilterableListTrait::$threeSwitchOn){
                $q->where('airconditioning', '=', RealEstateDefaultEnum::igen);
            }
            // fireplace filter
            if($filters->get('fireplace') == FilterableListTrait::$threeSwitchOff){
                $q->where('fireplace', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('fireplace') == FilterableListTrait::$threeSwitchOn){
                $q->where('fireplace', '=', RealEstateDefaultEnum::igen);
            }
            // cabletv filter
            if($filters->get('cabletv') == FilterableListTrait::$threeSwitchOff){
                $q->where('cabletv', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('cabletv') == FilterableListTrait::$threeSwitchOn){
                $q->where('cabletv', '=', RealEstateDefaultEnum::igen);
            }
            // satellite_system filter
            if($filters->get('satellite_system') == FilterableListTrait::$threeSwitchOff){
                $q->where('satellite_system', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('satellite_system') == FilterableListTrait::$threeSwitchOn){
                $q->where('satellite_system', '=', RealEstateDefaultEnum::igen);
            }
            // internet filter
            if($filters->get('internet') == FilterableListTrait::$threeSwitchOff){
                $q->where('internet', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('internet') == FilterableListTrait::$threeSwitchOn){
                $q->where('internet', '=', RealEstateDefaultEnum::igen);
            }
            // security_service_24h filter
            if($filters->get('security_service_24h') == FilterableListTrait::$threeSwitchOff){
                $q->where('security_service_24h', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('security_service_24h') == FilterableListTrait::$threeSwitchOn){
                $q->where('security_service_24h', '=', RealEstateDefaultEnum::igen);
            }
            // indoor_pool filter
            if($filters->get('indoor_pool') == FilterableListTrait::$threeSwitchOff){
                $q->where('indoor_pool', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('indoor_pool') == FilterableListTrait::$threeSwitchOn){
                $q->where('indoor_pool', '=', RealEstateDefaultEnum::igen);
            }
            // outdoor_pool filter
            if($filters->get('outdoor_pool') == FilterableListTrait::$threeSwitchOff){
                $q->where('outdoor_pool', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('outdoor_pool') == FilterableListTrait::$threeSwitchOn){
                $q->where('outdoor_pool', '=', RealEstateDefaultEnum::igen);
            }
            // jacuzzi filter
            if($filters->get('jacuzzi') == FilterableListTrait::$threeSwitchOff){
                $q->where('jacuzzi', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('jacuzzi') == FilterableListTrait::$threeSwitchOn){
                $q->where('jacuzzi', '=', RealEstateDefaultEnum::igen);
            }
            // sauna filter
            if($filters->get('sauna') == FilterableListTrait::$threeSwitchOff){
                $q->where('sauna', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('sauna') == FilterableListTrait::$threeSwitchOn){
                $q->where('sauna', '=', RealEstateDefaultEnum::igen);
            }
            // hobby_room_gim filter
            if($filters->get('hobby_room_gim') == FilterableListTrait::$threeSwitchOff){
                $q->where('hobby_room_gim', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('hobby_room_gim') == FilterableListTrait::$threeSwitchOn){
                $q->where('hobby_room_gim', '=', RealEstateDefaultEnum::igen);
            }
            // guest_apartment filter
            if($filters->get('guest_apartment') == FilterableListTrait::$threeSwitchOff){
                $q->where('guest_apartment', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('guest_apartment') == FilterableListTrait::$threeSwitchOn){
                $q->where('guest_apartment', '=', RealEstateDefaultEnum::igen);
            }
            // elevator filter
            if($filters->get('elevator') == FilterableListTrait::$threeSwitchOff){
                $q->where('elevator', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('elevator') == FilterableListTrait::$threeSwitchOn){
                $q->where('elevator', '=', RealEstateDefaultEnum::igen);
            }
            // panoramic_view filter
            if($filters->get('panoramic_view') == FilterableListTrait::$threeSwitchOff){
                $q->where('panoramic_view', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('panoramic_view') == FilterableListTrait::$threeSwitchOn){
                $q->where('panoramic_view', '=', RealEstateDefaultEnum::igen);
            }
            // danube_view filter
            if($filters->get('danube_view') == FilterableListTrait::$threeSwitchOff){
                $q->where('danube_view', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('danube_view') == FilterableListTrait::$threeSwitchOn){
                $q->where('danube_view', '=', RealEstateDefaultEnum::igen);
            }
            // balcony filter
            if($filters->get('balcony') == FilterableListTrait::$threeSwitchOff){
                $q->where('balcony', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('balcony') == FilterableListTrait::$threeSwitchOn){
                $q->where('balcony', '=', RealEstateDefaultEnum::igen);
            }
            // terrace filter
            if($filters->get('terrace') == FilterableListTrait::$threeSwitchOff){
                $q->where('terrace', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('terrace') == FilterableListTrait::$threeSwitchOn){
                $q->where('terrace', '=', RealEstateDefaultEnum::igen);
            }
            // roof_terrace filter
            if($filters->get('roof_terrace') == FilterableListTrait::$threeSwitchOff){
                $q->where('roof_terrace', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('roof_terrace') == FilterableListTrait::$threeSwitchOn){
                $q->where('roof_terrace', '=', RealEstateDefaultEnum::igen);
            }
            // winter_garden filter
            if($filters->get('winter_garden') == FilterableListTrait::$threeSwitchOff){
                $q->where('winter_garden', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('winter_garden') == FilterableListTrait::$threeSwitchOn){
                $q->where('winter_garden', '=', RealEstateDefaultEnum::igen);
            }
            // irrigation filter
            if($filters->get('irrigation') == FilterableListTrait::$threeSwitchOff){
                $q->where('irrigation', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('irrigation') == FilterableListTrait::$threeSwitchOn){
                $q->where('irrigation', '=', RealEstateDefaultEnum::igen);
            }
            // en_suit_bathroom filter
            if($filters->get('en_suit_bathroom') == FilterableListTrait::$threeSwitchOff){
                $q->where('en_suit_bathroom', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('en_suit_bathroom') == FilterableListTrait::$threeSwitchOn){
                $q->where('en_suit_bathroom', '=', RealEstateDefaultEnum::igen);
            }
            // laundry filter
            if($filters->get('laundry') == FilterableListTrait::$threeSwitchOff){
                $q->where('laundry', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('laundry') == FilterableListTrait::$threeSwitchOn){
                $q->where('laundry', '=', RealEstateDefaultEnum::igen);
            }
            // cellar filter
            if($filters->get('cellar') == FilterableListTrait::$threeSwitchOff){
                $q->where('cellar', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('cellar') == FilterableListTrait::$threeSwitchOn){
                $q->where('cellar', '=', RealEstateDefaultEnum::igen);
            }
            // hard_wood_flooring filter
            if($filters->get('hard_wood_flooring') == FilterableListTrait::$threeSwitchOff){
                $q->where('hard_wood_flooring', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('hard_wood_flooring') == FilterableListTrait::$threeSwitchOn){
                $q->where('hard_wood_flooring', '=', RealEstateDefaultEnum::igen);
            }
            // floor_heating filter
            if($filters->get('floor_heating') == FilterableListTrait::$threeSwitchOff){
                $q->where('floor_heating', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('floor_heating') == FilterableListTrait::$threeSwitchOn){
                $q->where('floor_heating', '=', RealEstateDefaultEnum::igen);
            }
            // high_ceiling filter
            if($filters->get('high_ceiling') == FilterableListTrait::$threeSwitchOff){
                $q->where('high_ceiling', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('satellite_system') == FilterableListTrait::$threeSwitchOn){
                $q->where('satellite_system', '=', RealEstateDefaultEnum::igen);
            }
            // central_vacuum_cleaner filter
            if($filters->get('central_vacuum_cleaner') == FilterableListTrait::$threeSwitchOff){
                $q->where('central_vacuum_cleaner', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('central_vacuum_cleaner') == FilterableListTrait::$threeSwitchOn){
                $q->where('central_vacuum_cleaner', '=', RealEstateDefaultEnum::igen);
            }
            // accessibility filter
            if($filters->get('accessibility') == FilterableListTrait::$threeSwitchOff){
                $q->where('accessibility', '=', RealEstateDefaultEnum::nem);
            }
            if($filters->get('accessibility') == FilterableListTrait::$threeSwitchOn){
                $q->where('accessibility', '=', RealEstateDefaultEnum::igen);
            }
        }
        return DataTables::of($q)
            ->addColumn('first_image', function(RealEstate $rec) {
                return ($rec->getMedia('images')->first() != null) ? $rec->getMedia('images')->first()->getUrl('admin-thumb') : '';
            })
            ->addColumn('gallery', function(RealEstate $rec) {
                //  teszt:
                //  return (!empty($rec->getMedia('images')->first()) ? $rec->getMedia('images')->first()->getUrl('admin-thumb') : '');

                //  így kell megjelennie a js-ben:
                //  [{thumb: 'https://petapixel.com/assets/uploads/2019/06/manipulatedelephant-800x534.jpg', src: 'https://petapixel.com/assets/uploads/2019/06/manipulatedelephant-800x534.jpg'}]
                $images = $rec->getMedia('images')->all();
                $image_list = array();
                foreach($images as $image){
                    $image_list[] = ['thumb' => $image->getUrl('admin-thumb'), 'src' => $image->getUrl('admin-gallery-main-image')];
                }
                //  $image_list = ['thumb' => 'https://petapixel.com/assets/uploads/2019/06/manipulatedelephant-800x534.jpg', 'src' => 'https://petapixel.com/assets/uploads/2019/06/manipulatedelephant-800x534.jpg'];
                return $image_list;
            })
            ->addColumn('code_url', function(RealEstate $rec) {
                return route('realEstates.edit', [$rec->id]);
            })
            // Kerulet
            ->addColumn('location_town_district_id', function(RealEstate $rec) {
                return $rec->locationTownDistrict->name ?? $rec->location_town_district_id;
            })
            // Utca
            ->addColumn('street_address', function(RealEstate $rec) {
                if (!empty($rec->street_address_1)) {
                    return $rec->street_address_1;
                }
                if (!empty($rec->street_address_2)) {
                    return $rec->street_address_2;
                }
                return $rec->street_address_3;
            })
//            // Hazszam
            ->addColumn('street_address_2', function(RealEstate $rec) {
                if (!empty($rec->street_address_2)) {
                    return $rec->street_address_2;
                }
                return $rec->street_address_3;
            })
            // Emelet
            ->addColumn('floor', function(RealEstate $rec) {
                return $rec->floor;
            })
            // negyzetmeter
            ->addColumn('base_area_gross', function(RealEstate $rec) {
                return $rec->base_area_gross;
            })
            // ennek alapbol HUF-nak kell lennie, kulonben nem muxik a JS szam formazo
            ->addColumn('price_currency_code', function(RealEstate $rec){
                return !empty($rec->currency) ? $rec->currency->iso_code : 'HUF';
            })
            ->make(true);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function selectContract(Request $request): Redirector|RedirectResponse{
        $key = $request->get('key');
        $fmKey = $request->get('fmkey');
        $fm = FileManager::loadFromSession($fmKey);
        $className = $fm->ownerClassName;
        $entity = $className::find($fm->ownerId);
        $mediaItem = $entity->getMedia($fm->mediaCollectionName)->get($key);
        if ($mediaItem != null && $mediaItem->id > 0) {
            $entity->commission_contract_id = $mediaItem->id;
            $entity->save();
        }
        return redirect(route('realEstates.edit', [$entity->id]));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function clearContract(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $entity = RealEstate::find($id);
        if ($entity != null) {
            $entity->commission_contract_id = null;
            $entity->save();
        }
        return response()->json([
            'status' => 'ok'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function locationAreasQueryAjax(): JsonResponse
    {
        $location_areas = LocationArea::all();
        return response()->json([
            'status' => 'ok',
            'data' => $location_areas
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function locationTownDistrictsQueryAjax($id): JsonResponse
    {
        $location_town_district = LocationArea::find($id)->locationTownDistrict;
        return response()->json([
            'status' => 'ok',
            'data' => $location_town_district
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function locationTownNeighborhoodQueryAjax($id): JsonResponse
    {
        $location_neighborhood_district = LocationTownDistrict::find($id)->LocationNeighborhood;
        return response()->json([
            'status' => 'ok',
            'data' => $location_neighborhood_district
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function clone(Request $request): Redirector|RedirectResponse
    {
        $id = $request->get('id');
        $clone = RealEstate::deepClone($id);
        return redirect(route('realEstates.edit', [$clone->id]));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function clearFilters(Request $request): Redirector|RedirectResponse|Application
    {
        $this->clearFiltersFromSession();
        return redirect(route('realEstates.index'));
    }

}
