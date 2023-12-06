<?php

namespace App\Models;

use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\Enum\RealEstateStatusEnum;
use App\User;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lang;
use League\Glide\Filesystem\FileNotFoundException;
use NumberFormatter;
use OwenIt\Auditing\Contracts\Auditable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait; régi
use Spatie\MediaLibrary\InteractsWithMedia; // új verzió
// use Spatie\MediaLibrary\Models\Media; régi verzió
use Spatie\MediaLibrary\MediaCollections\Models\Media; // új verzioó

/**
 * App\Models\RealEstate
 *
 * @property-read \App\User $createdBy
 * @property-read \App\Models\RealEstateType $realEstateType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RealEstateTranslation[] $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdvertisingPartner[] $advertisingPartners
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate withTranslation()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property int|null $status_enum
 * @property int|null $web_status_enum
 * @property int|null $created_by_id
 * @property int|null $commission
 * @property int|null $commission_contract_id
 * @property int $presentable
 * @property string|null $moveindate
 * @property int|null $score
 * @property int|null $web_appearances
 * @property int|null $web_interestes
 * @property string|null $last_owner_contact_noify_sent
 * @property int|null $contract_type_enum
 * @property int|null $location_area_id
 * @property int|null $location_town_district_id
 * @property int|null $location_neighborhood_id
 * @property string|null $street_address_1
 * @property string|null $street_address_2
 * @property string|null $street_address_3
 * @property string|null $place_number
 * @property int|null $real_estate_type_id
 * @property int|null $base_area_gross
 * @property int|null $base_area_net
 * @property int|null $lot_size
 * @property float|null $offer_price
 * @property float|null $limit_price
 * @property int|null $build_year
 * @property int|null $renovation_year
 * @property int|null $real_estate_orientation_enum
 * @property int|null $real_estate_vista_enum
 * @property int|null $utilities
 * @property int|null $number_levels
 * @property float|null $floor
 * @property int|null $living_room_size
 * @property int|null $number_bedroom
 * @property int|null $real_estate_kitchen_type_enum
 * @property int|null $real_estate_furniture_enum
 * @property int|null $number_bath
 * @property int|null $number_shower
 * @property int|null $number_wc
 * @property int|null $common_charge
 * @property int|null $real_estate_garden_type_enum
 * @property int|null $garden_size
 * @property int|null $number_garage
 * @property int|null $number_parking
 * @property int|null $real_estate_heating_type_enum
 * @property int|null $real_estate_state_enum
 * @property int|null $real_estate_house_sub_type_enum
 * @property int|null $real_estate_retail_unit_location_enum
 * @property int|null $real_estate_office_location_enum
 * @property int|null $real_estate_warehouse_sub_type_enum
 * @property int|null $real_estate_catering_sub_type_enum
 * @property int|null $real_estate_industrial_sub_type_enum
 * @property int|null $real_estate_agricultural_sub_type_enum
 * @property int|null $real_estate_development_site_enum
 * @property int|null $operation_fee
 * @property float|null $common_area_mult
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
 * @property string|null $owner_name
 * @property string|null $owner_phone_1
 * @property string|null $owner_phone_2
 * @property string|null $owner_email
 * @property string|null $owner_contact_name
 * @property string|null $owner_contact_phone
 * @property string|null $owner_contact_email
 * @property string|null $owner_bell
 * @property string|null $owner_alarm
 * @property int|null $owner_keys
 * @property string|null $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|Media $media
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereAccessibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereAirconditioning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereAlarmSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereBalcony($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereBalconySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereBaseAreaGross($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereBaseAreaNet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereBuildYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCalbletv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCellar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCentralVacuumCleaner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCommissionContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCommonAreaMult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCommonCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereContractTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereDanubeView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereElevator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereEnSuitBathroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereFireplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereFloorHeating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereGardenSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereGuestApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereHardWoodFlooring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereHighCeiling($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereHobbyRoomGim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereIndoorPool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereInternet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereIrrigation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereJacuzzi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLastOwnerContactNoifySent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLaundry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLimitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLivingRoomSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLocationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLocationNeighborhoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLocationTownDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereLotSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereMoveindate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberBath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberBedroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberGarage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberLevels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberShower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereNumberWc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOperationFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOutdoorPool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerAlarm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerBell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerKeys($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerPhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereOwnerPhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate wherePanoramicView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate wherePetAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate wherePlaceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate wherePresentable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate wherePriceCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateAgriculturalSubTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateCateringSubTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateDevelopmentSiteEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateFurnitureEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateGardenTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateHeatingTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateHouseSubTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateIndustrialSubTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateKitchenTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateOfficeLocationEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateOrientationEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateRetailUnitLocationEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateStateEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateVistaEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRealEstateWarehouseSubTypeEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRenovationYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRoofTerrace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereRoofTerraceSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereSatelliteSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereSauna($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereSecurityService24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereStatusEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereStreetAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereStreetAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereStreetAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereTerrace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereTerraceSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereUtilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereWebAppearances($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereWebInterestes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereWebStatusEnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereWinterGarden($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RealEstateOffer[] $offers
 * @property int|null $calbletv
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate whereCabletv($value)
 * @property int|null $price_currency_id
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\LocationArea|null $locationArea
 * @property-read \App\Models\LocationTownDistrict|null $locationTownDistrict
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RealEstate wherePriceCurrencyId($value)
 * @property-read \App\Models\LocationNeighborhood|null $locationNeighborhood
 * @property-read int|null $advertising_partners_count
 * @property-read int|null $media_count
 * @property-read int|null $offers_count
 * @property-read \App\Models\RealEstateTranslation $translation
 * @property-read int|null $translations_count
 */
class RealEstate extends Model implements Transformable, HasMedia, Auditable
{
    // use HasMediaTrait;
    use InteractsWithMedia;
    use TransformableTrait;
    use Translatable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        //'marketing_name',
        'status_enum',
        'web_status_enum',
        'contract_type_enum',
        'commission',
        'commission_contract_id',


        // ingatlan tipus...
        'real_estate_state_enum',
        'real_estate_type_id',
        'real_estate_garden_type_enum',
        'garden_size',
        'lot_size',
        'real_estate_house_sub_type_enum',
        'real_estate_retail_unit_location_enum',
        'real_estate_office_location_enum',
        'real_estate_warehouse_sub_type_enum',
        'real_estate_catering_sub_type_enum',
        'real_estate_industrial_sub_type_enum',
        'real_estate_agricultural_sub_type_enum',
        'real_estate_development_site_enum',
        'location_area_id',
        'location_town_district_id',
        'location_neighborhood_id',
        'street_address_1',
        'street_address_2',
        'street_address_3',
        'floor',
        'real_estate_orientation_enum',
        'real_estate_vista_enum',


        //kozmuvek, stb...
        'utilities',
        'real_estate_heating_type_enum',
        'base_area_gross',
        'number_levels',
        'living_room_size',
        'base_area_net',
        'number_bedroom',
        'real_estate_kitchen_type_enum',
        'real_estate_furniture_enum',
        'number_bath',
        'number_shower',
        'number_wc',
        'number_garage',
        'number_parking',
        'balcony',
        'balcony_size',
        'terrace',
        'terrace_size',
        'roof_terrace',
        'roof_terrace_size',


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


        // tulajdonos
        'owner_name',
        'owner_email',
        'owner_phone_1',
        'owner_phone_2',
        'owner_contact_name',
        'owner_contact_phone',
        'owner_contact_email',
        'owner_bell',
        'owner_alarm',
        'owner_keys',
        'comment',


        // koltsegek
        'operation_fee',
        'common_area_mult',
        'common_charge',

        // leiras
        //'description',


        // valami
        'moveindate',
        'last_owner_contact_noify_sent',
        'place_number',
        'build_year',
        'renovation_year',
        'price_currency_id',
        'offer_price',
        'limit_price',

        // metas
//        'created_by_id',
//        'updated_at',
        'score',
//        'web_appearances',
        'web_interestes',
    ];



    /**
     * The attributes that represents a boolean value.
     * @var array
     */
    public $checkboxes = [
        'commission',
        'utilities',
        'balcony',
        'terrace',
        'roof_terrace',
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
        'owner_keys',
    ];


    public static $features = [
        //'commission',
        'utilities',
        'balcony',
        'terrace',
        'roof_terrace',
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
        //'owner_keys',
    ];

    public $translatedAttributes = ['marketing_name', 'description'];



    public $pubMainProperties = [
        'code',
        'score',
        'marketing_name',
        'contract_type_enum' => [
            'enumClassName' => '\App\Models\Enum\RealEstateContractTypeEnum',
        ],
        'locationArea' => [
            'caption'=>'messages.real_estates_datapage_location_label',
            'valuePropName'=>'name'
        ],
        'locationTownDistrict' => [
            'caption'=>'messages.real_estates_datapage_town_district_label',
            'valuePropName'=>'name'
        ],
        'locationNeighborhood' => [
            'caption'=>'messages.real_estates_datapage_neighborhood_label',
            'valuePropName'=>'name'
        ],
        'place_number',
        'realEstateType' => [
            'caption'=>'messages.real_estates_datapage_real_estate_type_label',
            'valuePropName'=>'name'
        ],
        'base_area_gross' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'base_area_net' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'lot_size' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'offer_price' => [
            'format'=>'currency',
        ],
        'build_year',
        'renovation_year',
        'real_estate_orientation_enum',
        'real_estate_vista_enum',
        'utilities' => [
            'format'=>'yesNo',
        ],
        'number_levels',
        'floor',
        'living_room_size' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'number_bedroom',
        'real_estate_kitchen_type_enum',
        'real_estate_furniture_enum',
        'number_bath',
        'number_shower',
        'number_wc',
        'common_charge' => [
            'format'=>'currency',
        ],
        'real_estate_garden_type_enum',
        'garden_size' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'number_garage',
        'number_parking',
        'real_estate_heating_type_enum',
        'real_estate_house_sub_type_enum',
        'real_estate_retail_unit_location_enum',
        'real_estate_office_location_enum',
        'real_estate_warehouse_sub_type_enum',
        'real_estate_catering_sub_type_enum',
        'real_estate_industrial_sub_type_enum',
        'real_estate_agricultural_sub_type_enum',
        'real_estate_development_site_enum',
        'operation_fee' => [
            'format'=>'currency',
        ],
        'common_area_mult',
        'balcony_size' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'terrace_size' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
        'roof_terrace_size' => [
            'unit'=>'<span>m<sup>2</sup>',
        ],
    ];





    public function __construct(array $attributes = [])
    {

        /* inject translatable locale codes */
        $this->fillable = array_merge($this->fillable, array_values(config('translatable.locales')));

        parent::__construct($attributes);
    }

    /**
     * Attributes to include in the Audit.
     * Empty array = all properties
     *
     * @var array
     */
    protected $auditInclude = [];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [];

    /**
     * @return array
     */
    public static function validationRules()
    {
        $validationRules = [
            //'code' => 'required',
            'contract_type_enum' => 'required',
            'real_estate_type_id' => 'required',
        ];
        $translatableLocales = config('translatable.locales');
        foreach ($translatableLocales as $locale) {
            $validationRules["$locale.marketing_name"] = 'required';
        }
        return $validationRules;
    }



    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by_id');
    }

    public function realEstateType(){
        return $this->belongsTo('App\Models\RealEstateType');
    }


    public function getLastModified(){
        return ($this->updated_at == null) ? $this->created_at : $this->updated_at;
    }

    public function advertisingPartners(){
        return $this->belongsToMany('\App\Models\AdvertisingPartner','real_estates_advertising_partners');
    }

    public function offers(){
        return $this->belongsToMany( '\App\Models\RealEstateOffer', 'real_estate_offer_components', 'real_estate_id', 'offer_id' );
    }

    public function locationArea(){
        return $this->belongsTo( '\App\Models\LocationArea');
    }

    public function locationTownDistrict(){
        return $this->belongsTo('App\Models\LocationTownDistrict');
    }

    public function locationNeighborhood(){
        return $this->belongsTo('App\Models\LocationNeighborhood');
    }

    public function currency(){
        return $this->belongsTo('App\Models\Currency', 'price_currency_id', 'id');
    }



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('files');
    }

    /**
     * @param Media|null $media
     * @throws FileNotFoundException
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {

        // admin
        // képnézegető a galériához:
        $this->addMediaConversion('admin-gallery-main-image')
            ->crop(Manipulations::CROP_CENTER, 1920, 1080)->nonQueued();
        $this->addMediaConversion('admin-thumb')
            ->crop(Manipulations::CROP_CENTER, 300, 300)->nonQueued();
        $this->addMediaConversion('admin-list-thumb')
            ->crop(Manipulations::CROP_CENTER, 70, 70)->nonQueued();

        // public
        $this->addMediaConversion('public-realestate-featured')
            ->crop(Manipulations::CROP_CENTER, 370, 260)
            ->watermark(public_path('images/watermarks/watermark-public-realestate-featured.png'))
            //  ->watermarkOpacity(75)
            //  ->watermarkPadding(10)
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT)->nonQueued();

        $this->addMediaConversion('public-realestate-list')
            ->crop(Manipulations::CROP_CENTER, 300, 300)
            ->watermark(public_path('images/watermarks/watermark-public-realestate-list.png'))
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT)->nonQueued();

        $this->addMediaConversion('public-realestate-datapage-gallery-image')
            ->crop(Manipulations::CROP_CENTER, 1920, 1080)
            ->watermark(public_path('images/watermarks/watermark-public-realestate-datapage-gallery-image.png'))
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT)->nonQueued();

        // picSizeInPixels = [printRES] * ( [picSizeInCM]/2.54 )

        // print
        // kb. 15cm nyomtatva, 300DPI-vel
        $this->addMediaConversion('printable-realestate-featured')
            ->fit(Manipulations::FIT_FILL, 1700, 0)
            ->watermark(public_path('images/watermarks/watermark-printable-realestate-featured.png'))
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT);
        // kb. 8cm nyomtatva, 300DPI-vel
        $this->addMediaConversion('printable-realestate-thumb')
            ->fit(Manipulations::FIT_FILL, 800, 0)
            ->watermark(public_path('images/watermarks/watermark-printable-realestate-thumb.png'))
            ->watermarkPosition(Manipulations::POSITION_BOTTOM_RIGHT);
    }

    /**
     * @return mixed|Media|null
     */
    public function getFeaturedImage()
    {
        $collection = $this->getMedia('images')->where('custom_properties.featured', '=', 1);
        if ($collection == null || $collection->count() == 0) {
           //$featuredImage = $this->getFirstMedia('images');
            $featuredImage = null;
        } else  {
            $featuredImage = $collection->first();
        }
        return $featuredImage;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getOtherImages()
    {
        $images = $this->getMedia('images')->where('custom_properties.featured', '<>', 1);
        if ($images == null || $images->count() == 0) {
            $images = null;
        }
        return $images;
    }

    /**
     * @param $id
     * @return RealEstate|RealEstate[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public static function deepClone($id){
        $realEstate = RealEstate::find($id)->load('advertisingPartners');

        $clone = $realEstate->replicate();

        foreach(config('translatable.locales') as $locale) {
            $clone->translateOrNew($locale)->marketing_name = 'Cloned from this: '.$realEstate->getTranslation($locale)->marketing_name;
            $clone->translateOrNew($locale)->description = $realEstate->getTranslation($locale)->description;
        }

        $clone->save();

        $clone->advertisingPartners()->attach($realEstate->advertisingPartners);
        return $clone;
    }

    /**
     * @return string
     */
    public function getCommaSeparatedFeatureList()
    {
        $captions = array();
        foreach (RealEstate::$features as $feature){
            if ($this->$feature == 1) {
                $captions[] = __("messages.real_estates_datapage_{$feature}_label");
            }
        }
        $result = implode(', ', $captions);
        return $result;
    }

    /**
     * @return array
     */
    public function getFeatures()
    {
        $captions = array();
        foreach (RealEstate::$features as $feature){
            if ($this->$feature == 1) {
                $captions[] = __("messages.real_estates_datapage_{$feature}_label");
            }
        }
        return $captions;
    }

    /**
     * @param ?string $nopic helyettesítő kép relativ url-je, vagy null
     * @return string
     */
    public function getPublicFeaturedImage($nopicUrl = null)
    {
        return ($this->getFirstMediaUrl('images', 'public-realestate-featured')) ?
            $this->getFirstMediaUrl('images', 'public-realestate-featured') : (asset($nopicUrl) ?? '');
            //  asset('vendor/homex/images/thumbnail/01.jpg');
    }

    /**
     * @param ?string $nopic helyettesítő kép relativ url-je, vagy null
     * @return string
     */
    public function getPublicPrintableFeaturedImage($nopicUrl = null)
    {
        return ($this->getFirstMediaUrl('images', 'printable-realestate-featured')) ?
            $this->getFirstMediaUrl('images', 'printable-realestate-featured') : (asset($nopicUrl) ?? '');
            //  asset('vendor/homex/images/thumbnail/01.jpg');
    }

    /**
     * @param ?string $nopic helyettesítő kép relativ url-je, vagy null
     * @return string
     */
    public function getPublicListImage($nopicUrl = null)
    {
        return ($this->getFirstMediaUrl('images', 'public-realestate-list')) ?
            $this->getFirstMediaUrl('images', 'public-realestate-list') : (asset($nopicUrl) ?? '');
    }

    /**
     * @param ?string $nopic helyettesítő kép relativ url-je, vagy null
     * @return string
     */
    public function getPublicDatapageFeaturedImage($nopicUrl = null)
    {
        return ($this->getFirstMediaUrl('images', 'public-realestate-datapage-gallery-image')) ?
            $this->getFirstMediaUrl('images', 'public-realestate-datapage-gallery-image') : (asset($nopicUrl) ?? '');
        //asset('vendor/homex/images/thumbnaillist/01.jpg');
    }

    /**
     * @return array
     */
    public function getPublicDatapageGalleryImages(){
        $result = array();
        $collection = $this->getMedia('images');
        foreach ($collection as $key=> $item) {
            $result[$key] = $item->getUrl('public-realestate-datapage-gallery-image');
        };
        return $result;
    }


    /**
     * Vissza adja a nyilvanos oldalora megfelelo nevet
     * @return string
     */
    public function getPublicName()
    {
        return ucfirst($this->getTranslation(App::getLocale())->marketing_name);
    }

    /**
     * @return string|null
     */
    public function getPublicCreatedByName()
    {
        return ($this->createdBy != null) ? $this->createdBy->name : null;
    }

    /**
     * @return false|string|null
     */
    public function getPublicCreatedAt()
    {
        return ($this->created_at != null) ? date('Y. M d.', $this->created_at->timestamp) : null;
    }

    /**
     * @return string
     */
    public function getPublicOfferPrice()
    {
        //  TODO: berakni a millióra fordítást
        if ($this->offer_price == null){
            $result = 'N/A';
        } else {
            $result = number_format($this->offer_price, 0, '.', ' ');
            if ($this->currency != null && $this->currency->iso_code != null) {
                $result .= ' ' . $this->currency->iso_code;
            }
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getPublicOperationFee()
    {
        if ($this->operation_fee == null){
            $result = 'N/A';
        } else {
            $result = number_format($this->operation_fee, 0, '.', ' ');
            if ($this->currency != null && $this->currency->iso_code != null) {
                $result .= ' ' . $this->currency->iso_code;
            }
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getContractTypeCaption()
    {
        $result = RealEstateContractTypeEnum::getDescription($this->contract_type_enum);
        return $result;
    }

    /**
     * @return string
     */
    public function getPublicSquareMeterPrice()
    {
        if ($this->base_area_gross == null || $this->base_area_gross == 0){
            $result = 'N/A';
        } else {
            $result = number_format(intval($this->offer_price / $this->base_area_gross), 0, '.', ' ') . ' ' . $this->currency->iso_code;
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getPublicLocation()
    {
        $result = '';
        if ($this->locationArea != null) $result .= $this->locationArea->name;
        if ($this->locationTownDistrict != null) $result = $this->locationTownDistrict->name;
        if ($this->locationNeighborhood != null) $result .= ' ('. $this->locationNeighborhood->name.')';
        //  Ezt nem szabad publikussá tenni:
        //  if ($this->street_address_1 != null) $result .= ' '. $this->street_address_1;
        //  if ($this->street_address_2 != null) $result .= ' '. $this->street_address_2;
        //  return ($result) ? $result : 'unknown location';
        return ($result) ? $result : '';
    }

     /**
     *  A modelben a pubMainProperties-ben megadott tulajdonsagok es szabalyok alapjan tombot allit ossze,
     *  ami tartalmazza a formazott tulajdonsag ertekeket.
     *  @return array
     */
    public function getPublicMainProperties(){
        $result = array();

        foreach ($this->pubMainProperties as $key => $property) {

            if (!is_array($property)){
                $propertyValue = $this->$property;
                $labelKey = 'messages.real_estates_datapage_'.$property.'_label';
                if (strpos($property, '_enum') !== false){
                    $labelKey = str_replace('messages.real_estates_datapage_real_estate_', 'messages.real_estates_datapage_', $labelKey);
                    $labelKey = str_replace('_enum', '', $labelKey);
                    $enumClassName = str_replace('_', '', ucwords($property, '_'));
                    $propertyValue = call_user_func( '\App\Models\Enum\\'.$enumClassName.'::getDescription', $propertyValue);
                }
            } else {
                $propertyValue = $this->$key;
                if (array_key_exists('caption', $property)){
                    $labelKey = $property['caption'];
                } else {
                    $labelKey = 'messages.real_estates_datapage_'.$key.'_label';
                    if (strpos($key, '_enum') !== false){
                        $labelKey = str_replace('messages.real_estates_datapage_real_estate_', 'messages.real_estates_datapage_', $labelKey);
                        $labelKey = str_replace('_enum', '', $labelKey);
                    }
                }
                if (gettype($propertyValue) == 'object'){
                    $field = $property['valuePropName'];
                    $propertyValue = $this->$key->$field;
                }
                if (strpos($key, '_enum') !== false) {
                    $enumClassName = '\App\Models\Enum\\'.str_replace('_', '', ucwords($key, '_'));
                    if (array_key_exists('enumClassName', $property)) {
                        $enumClassName = $property['enumClassName'];
                    }
                    $propertyValue = call_user_func("{$enumClassName}::getDescription", $propertyValue);
                }

                if (array_key_exists('unit', $property)){
                    $propertyValue .= ' '.$property['unit'];
                } else
                if (array_key_exists('format', $property)){
                    if ($property['format'] == 'currency') {
                        $propertyValue = number_format($propertyValue, 0, '.', ' ');
                        if ($this->currency != null && $this->currency->iso_code != null) {
                            $propertyValue .= ' ' . $this->currency->iso_code;
                        }
                    }
                    if ($property['format'] == 'yesNo') {
                        $propertyValue = ($propertyValue == 1) ? __('messages.yes') : __('messages.no');
                    }
                }
            }

            $result[] = ['labelKey' => __($labelKey), 'value' => $propertyValue ];
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function isFavoriteOfLoginedUser(){
        if (Auth::user() == null){
            return false;
        }
        $id = DB::table('real_estate_short_list')
            ->select('id')
            ->where('real_estate_id', '=', $this->id)
            ->where('client_id', '=', Auth::user()->client->id)
            ->first();
        return ($id != null);
    }

    /**
     * Datatabels frontendnek megformazza az arat, hogy kiferjen.
     *
     * @param $price
     */
    public function priceFormatterToDataTables($price): string
    {
        $thousands = $price % 1000000;
        $millions = ($price - $thousands)/1000000;
        $thousands /= 1000;
        if ($millions == 0 && $thousands == 0) {
            return $millions;
        }
        if ($millions == 0 && $thousands != 0) {
            return $price;
        }
        if ($thousands == 0) {
            return $millions . ' ' . Lang::get('messages.real_estates_list_mill_column_caption');
        }
        $formattedThousands = substr($thousands,0, strpos($thousands, '0'));
        if ($formattedThousands) {
            return $millions . '.' . $formattedThousands . ' ' . Lang::get('messages.real_estates_list_mill_column_caption');
        }
        return $millions . '.' . $thousands . ' ' . Lang::get('messages.real_estates_list_mill_column_caption');

    }

    /**
     * @return string[][]
     */
    public static function getPublicPageOrderColumnName(): array
    {
        return [
            '1' => [
                'column' => 'updated_at',
                'direction' => 'desc'
            ],
            '2' => [
                'column' => 'offer_price',
                'direction' => 'asc'
            ],
            '3' => [
                'column' => 'offer_price',
                'direction' => 'desc'
            ]
        ];
    }
}
