<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\ClientRequirement
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $status_enum
 * @property int|null $contract_type_enum
 * @property int|null $client_id
 * @property int|null $real_estate_type_id
 * @property int|null $location_area_id
 * @property int|null $price_min
 * @property int|null $price_max
 * @property int|null $build_year_min
 * @property int|null $build_year_max
 * @property int|null $gross_base_area_min
 * @property int|null $gross_base_area_max
 * @property int|null $score_min
 * @property int|null $floor_min
 * @property int|null $floor_max
 * @property int|null $number_bedroom_min
 * @property int|null $number_bedroom_max
 * @property int|null $number_bath_min
 * @property int|null $livingroom_size_min
 * @property int|null $furniture
 * @property int|null $kitchen
 * @property int|null $garden
 * @property int|null $number_garage_plus_parking
 * @property int|null $pet_allowed
 * @property int|null $small_pet_allowed
 * @property int|null $alarm_system
 * @property int|null $airconditioning
 * @property int|null $fireplace
 * @property int|null $cabletv
 * @property int|null $satellite_system
 * @property int|null $internet
 * @property int|null $security_service_24h
 * @property int|null $indoor_pool
 * @property int|null $outdoor_pool
 * @property int|null $jacuzzi
 * @property int|null $sauna
 * @property int|null $hobby_room_gim
 * @property int|null $guest_apartment
 * @property int|null $elevator
 * @property int|null $panoramic_view
 * @property int|null $danube_view
 * @property int|null $balcony
 * @property int|null $balcony_size
 * @property int|null $terrace
 * @property int|null $terrace_size
 * @property int|null $roof_terrace
 * @property int|null $roof_terrace_size
 * @property int|null $winter_garden
 * @property int|null $irrigation
 * @property int|null $en_suit_bathroom
 * @property int|null $laundry
 * @property int|null $cellar
 * @property int|null $hard_wood_flooring
 * @property int|null $floor_heating
 * @property int|null $high_ceiling
 * @property int|null $central_vacuum_cleaner
 * @property int|null $accessibility
 * @property-read \App\Models\Client|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereAccessibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereAirconditioning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereAlarmSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereBalcony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereBalconySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereBuildYearMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereBuildYearMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereCalbletv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereCellar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereCentralVacuumCleaner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereContractTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereDanubeView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereElevator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereEnSuitBathroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereFireplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereFloorHeating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereFloorMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereFloorMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereFurniture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereGarden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereGrossBaseAreaMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereGrossBaseAreaMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereGuestApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereHardWoodFlooring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereHighCeiling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereHobbyRoomGim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereIndoorPool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereInternet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereIrrigation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereJacuzzi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereKitchen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereLaundry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereLivingroomSizeMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereLocationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereNumberBathMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereNumberBedroomMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereNumberBedroomMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereNumberGaragePlusParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereOutdoorPool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement wherePanoramicView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement wherePetAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereSmallPetAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement wherePriceCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement wherePriceMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement wherePriceMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereRealEstateTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereRoofTerrace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereRoofTerraceSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereSatelliteSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereSauna($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereScoreMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereSecurityService24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereStatusEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereTerrace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereTerraceSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereWinterGarden($value)
 * @mixin \Eloquent
 * @property int|null $calbletv
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereCabletv($value)
 * @property int|null $price_currency_id
 * @property-read \App\Models\Currency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement wherePriceCurrencyId($value)
 * @property int|null $location_town_district_id
 * @property int|null $location_neighborhood_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereLocationNeighborhoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClientRequirement whereLocationTownDistrictId($value)
 */
class ClientRequirement extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_enum',
        'contract_type_enum',
        'client_id',
        'real_estate_type_id',
        'location_area_id',
        'location_town_district_id',
        'location_neighborhood_id',
        'price_min',
        'price_max',
        'price_currency_id',
        'build_year_min',
        'build_year_max',
        'gross_base_area_min',
        'gross_base_area_max',
        'score_min',
        'floor_min',
        'floor_max',
        'number_bedroom_min',
        'number_bedroom_max',
        'number_bath_min',
        'livingroom_size_min',
        'furniture',
        'kitchen_type_enums',
        'garden',
        'number_garage_plus_parking',

        // felszereltseg
        'pet_allowed',
        'small_pet_allowed',
        'alarm_system',
        'airconditioning',
        'fireplace',
        'cabletv',
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
        'winter_garden',
        'irrigation',
        'en_suit_bathroom',
        'laundry',
        'cellar',
        'hard_wood_flooring',
        'floor_heating',
        'high_ceiling',
        'central_vacuum_cleaner',
        'accessibility',
    ];


    /**
     * The attributes that represents a boolean value.
     * @var array
     */
    public $checkboxes = [
        'furniture',
        'garden',

        'pet_allowed',
        'small_pet_allowed',
        'alarm_system',
        'airconditioning',
        'fireplace',
        'cabletv',
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
        'winter_garden',
        'irrigation',
        'en_suit_bathroom',
        'laundry',
        'cellar',
        'hard_wood_flooring',
        'floor_heating',
        'high_ceiling',
        'central_vacuum_cleaner',
        'accessibility',
    ];


    /**
     * The feature attributes.
     * @var array
     */
    public static $features = [
        'pet_allowed',
        'small_pet_allowed',
        'alarm_system',
        'airconditioning',
        'fireplace',
        'cabletv',
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
        'winter_garden',
        'irrigation',
        'en_suit_bathroom',
        'laundry',
        'cellar',
        'hard_wood_flooring',
        'floor_heating',
        'high_ceiling',
        'central_vacuum_cleaner',
        'accessibility',
    ];




    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function currency(){
        return $this->belongsTo('App\Models\Currency', 'price_currency_id', 'id');
    }



    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            'contract_type_enum' => 'required',
            'real_estate_type_id' => 'required',
        ];
        return $validationRules;
    }


    /**
     * Stringify the requirements properties to URL query string.
     * Admin oldalon ezzel lehet ajanlathoz szurt ingatlan listat kerni.
     * A nyilvanos oldal az mas!
     * @param $clientRequirementId
     * @return string
     */
    public static function getParametersString($clientRequirementId, $urlEncoded = true)
    {
        $entity = ClientRequirement::find($clientRequirementId);
        $data = [];
        foreach ($entity->getFillable() as $propertyName) {
            $data[$propertyName] = $entity->$propertyName;
        }
        foreach ($entity->checkboxes as $propertyName) {
            $data[$propertyName] = ($entity->$propertyName == 1) ? 1 : 0;
        }

        // load requirement kitchen_types
        $temp = \DB::table('client_requirement_kitchen_types')
            ->where('client_requirement_id', '=', $clientRequirementId)
            ->get();
        $selectedKitchenTypes = [];
        foreach ($temp as $item){
            $selectedKitchenTypes[] = $item->kitchen_type_enum;
        }
        $data['kitchen_type_enums'] = implode(', ', $selectedKitchenTypes);


        // collect above datapieces to URL query string
        $dataPieces = [];
        foreach ($data as $key => $value) {
            $dataPieces[] = "$key=$value";
        }
        $dataStr = implode('&', $dataPieces);

        if ($urlEncoded)
            return urlencode($dataStr);
        else
            return $dataStr;
    }

}
