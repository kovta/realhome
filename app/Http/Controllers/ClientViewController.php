<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Enum\ClientPreferredContactEnum;
use App\Models\Enum\ClientRequiredSchoolEnum;
use App\Models\Enum\ClientSourceEnum;
use App\Models\Enum\ClientStatusEnum;
use App\Models\Enum\UserTypeEnum;
use App\Models\Enum\LanguageEnum;
use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\Enum\RealEstateKitchenTypeEnum;
use App\Models\Enum\RealEstateStatusEnum;
use App\Models\LocationArea;
use App\Models\LocationNeighborhood;
use App\Models\LocationTownDistrict;
use App\Models\RealEstateOffer;
use App\User;
use BenSampo\Enum\Exceptions\InvalidEnumKeyException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Models\Currency;
use App\Models\RealEstateType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientViewController extends Controller
{
    /**
     * @var string
     */
    protected $statuses;
    /**
     * @var string
     */
    protected $coWorkers;
    /**
     * @var
     */
    protected $source;
    /**
     * @var
     */
    protected $realEstateOffers;

    /**
     * Create client view
     *
     * @param Client $client
     * @return Application|Factory|View
     * @throws InvalidEnumKeyException
     */
    public function __invoke(Client $client)
    {
        /*
         * Megnezzuk, hogy az ugyfelhez tartozik-e felhasznalo
         */
        if(!is_null($client->user)){
            $hasUser = $client->user;
        }
        else
        {
            $hasUser = null;
        }
        /*
         * Ugyfel adatok es partner adatokhoz szukseges adatok
         */
        if(!is_null($client->broker_id))
        {
            $this->coWorkers = User::where('id','=',$client->broker_id)->first();
        }
        else {
            $this->coWorkers = null;
        }
        /*
         * Ugyfel ajanlatokhoz szukseges adatok
         */
        $this->realEstateOffers = RealEstateOffer::where('client_id', '=', $client->id)->with('realEstates')->get();
        if($this->realEstateOffers->isEmpty()) {
            $this->realEstateOffers = null;
        }
        $entity = new RealEstateOffer();
        $entity->created_by_id = Auth::user()->id;
        /*
         * Ugyfel igenyeihez szukseges adatok
         */
        $client->load('clientRequirement');
        /*
         * Ha nincs az ugyfelnek igenyei, akkor nem vegzi el a szukseges adatok meghatarozasat (null-t adunk at, hogy ne jelenjen meg)
         */
        if(!is_null($client->clientRequirement)) {
            $temp = DB::table('client_requirement_kitchen_types')
                ->where('client_requirement_id', '=', $client->clientRequirement->id)
                ->get()
            ;
            $selectedKitchenTypes = [];
            foreach($temp as $item) {
                $selectedKitchenTypes[] = $item->kitchen_type_enum;
            }
        }
        return view('Client.view', [
            'record' => $client,
            'clientPartner' => is_null($client->partner)? null : $client->partner,
            'clientRequirement' => !is_null($client->clientRequirement) ? $client->clientRequirement : null,
            'statuses' => empty(ClientStatusEnum::getDescription($client->status_enum)) ? null : ClientStatusEnum::getDescription($client->status_enum),
            'preferredContacts' => empty(ClientPreferredContactEnum::getDescription($client->preferred_contact_enum)) ? null : ClientPreferredContactEnum::getDescription($client->preferred_contact_enum),
            'preferredPartnerContacts' => empty(ClientPreferredContactEnum::getDescription(optional($client->partner)->preferred_contact_enum)) ? null : ClientPreferredContactEnum::getDescription($client->partner->preferred_contact_enum),
            'sources' => empty(ClientSourceEnum::getDescription($client->source_enum)) ? null : ClientSourceEnum::getDescription($client->source_enum),
            'coWorkers' => $this->coWorkers,
            'requiredSchools' => empty(ClientRequiredSchoolEnum::getDescription($client->required_school_enum)) ? null : ClientRequiredSchoolEnum::getDescription($client->required_school_enum),
            'realEstateOffers' => $this->realEstateOffers,
            'newRealEstateOffers' => $entity,
            'realStatuses' => !is_null($client->clientRequirement) ? RealEstateStatusEnum::getDescription($client->clientRequirement->status_enum) : null,
            'contract_types' => !is_null($client->clientRequirement) ? RealEstateContractTypeEnum::getDescription($client->clientRequirement->contract_type_enum) : null,
            'real_estate_types' => RealEstateType::all()->sortBy('name'),
            'realEstateLocationArea' => !is_null($client->clientRequirement) ? LocationArea::getLocationArea($client->clientRequirement->location_area_id) : null,
            'realEstateLocationDistrict' => !is_null($client->clientRequirement) ? LocationTownDistrict::getLocationTownDistrict($client->clientRequirement->location_town_district_id) : null,
            'realEstateLocationNeighborhood' => !is_null($client->clientRequirement) ? LocationNeighborhood::getLocationNeighborhood($client->clientRequirement->location_neighborhood_id) : null,
            'kitchenTypes' => !is_null($client->clientRequirement) ? RealEstateKitchenTypeEnum::toSelectValueSet($selectedKitchenTypes) : null,
            'currencies' => Currency::all()->sortBy('iso_code'),
            'hasUser' => $hasUser,
            'languages' => LanguageEnum::fromKey(LanguageEnum::getKey(LanguageEnum::magyar)),
        ]);
    }
}
