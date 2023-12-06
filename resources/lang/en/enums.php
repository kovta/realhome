<?php

use App\Models\Enum\RealEstateCategoryEnum;
use \App\Models\Enum\RealEstateStatusEnum;
use \App\Models\Enum\RealEstateWebStatusEnum;
use \App\Models\Enum\RealEstateContractTypeEnum;
use \App\Models\Enum\RealEstateOrientationEnum;
use \App\Models\Enum\RealEstateVistaEnum;
use \App\Models\Enum\RealEstateKitchenTypeEnum;
use \App\Models\Enum\RealEstateFurnitureEnum;
use \App\Models\Enum\RealEstateGardenTypeEnum;
use \App\Models\Enum\RealEstateHeatingTypeEnum;
use \App\Models\Enum\RealEstateStateEnum;
use \App\Models\Enum\RealEstateHouseSubTypeEnum;
use \App\Models\Enum\RealEstateRetailUnitLocationEnum;
use \App\Models\Enum\RealEstateOfficeLocationEnum;
use \App\Models\Enum\RealEstateWareHouseSubTypeEnum;
use \App\Models\Enum\RealEstateCateringSubTypeEnum;
use \App\Models\Enum\RealEstateIndustrialSubTypeEnum;
use \App\Models\Enum\RealEstateDevelopmentSiteEnum;
use \App\Models\Enum\ClientStatusEnum;
use \App\Models\Enum\ClientPreferredContactEnum;
use \App\Models\Enum\ClientSourceEnum;
use \App\Models\Enum\ClientRequiredSchoolEnum;
use \App\Models\Enum\RealEstateOfferStatusEnum;
use \App\Models\Enum\UserTypeEnum;

return [

    RealEstateCategoryEnum::class => [
        RealEstateCategoryEnum::lakoIngatlan => 'Residental',
        RealEstateCategoryEnum::kereskedelmiIngatlan => 'Commercial',
    ],

    RealEstateStatusEnum::class => [
        RealEstateStatusEnum::aktualis => 'active',
        RealEstateStatusEnum::nemAktualis => 'inactive',
    ],

    RealEstateWebStatusEnum::class => [
        RealEstateWebStatusEnum::aktiv => 'active',
        RealEstateWebStatusEnum::inaktiv => 'inactive)',
        RealEstateWebStatusEnum::kiemelt => 'highlighted',
    ],

    RealEstateContractTypeEnum::class => [
        RealEstateContractTypeEnum::elado => 'Sale',
        RealEstateContractTypeEnum::kiado => 'Rental',
    ],

    RealEstateOrientationEnum::class => [
        RealEstateOrientationEnum::eszaki => 'North',
        RealEstateOrientationEnum::deli => 'South',
        RealEstateOrientationEnum::keleti => 'East',
        RealEstateOrientationEnum::nyugati => 'West',
        RealEstateOrientationEnum::eszakKeleti => 'northeast',
        RealEstateOrientationEnum::delKeleti => 'southeast',
        RealEstateOrientationEnum::eszakNyugati => 'northwest',
        RealEstateOrientationEnum::delNyugati => 'southwest',
    ],

    RealEstateVistaEnum::class => [
        RealEstateVistaEnum::utcara => 'Street',
        RealEstateVistaEnum::udvarra => 'Yard',
        RealEstateVistaEnum::zoldre => 'Garden',
        RealEstateVistaEnum::parkra => 'Park',
        RealEstateVistaEnum::panoramas => 'Panoramic',
    ],

    RealEstateKitchenTypeEnum::class => [
        RealEstateKitchenTypeEnum::openPlan => 'Open-plan',
        RealEstateKitchenTypeEnum::openPlanDiningRoom => 'Open-plan+dining room',
        RealEstateKitchenTypeEnum::openPlanDiningArea => 'Open-plan+dining area',
        RealEstateKitchenTypeEnum::openPlanCanBeSepareted => 'Open-plan, can be separated',
        RealEstateKitchenTypeEnum::separeted => 'Separated',
        RealEstateKitchenTypeEnum::separetedDiningRoom => 'Separated+dining room',
        RealEstateKitchenTypeEnum::separetedDiningArea => 'Separated+dining area',
        RealEstateKitchenTypeEnum::teaKitchen => 'Tea kitchen',
        RealEstateKitchenTypeEnum::eatInKitchen => 'Eat-in kitchen',
    ],

    RealEstateFurnitureEnum::class => [
        RealEstateFurnitureEnum::butorozott => 'furnished',
        RealEstateFurnitureEnum::butorozatlan => 'unfurnished',
        RealEstateFurnitureEnum::reszbenButorozott => 'partly furnished',
        RealEstateFurnitureEnum::keresreMegoldhato => 'furnished upon request',
    ],

    RealEstateGardenTypeEnum::class => [
        RealEstateGardenTypeEnum::nincs => 'None',
        RealEstateGardenTypeEnum::privat => 'Private',
        RealEstateGardenTypeEnum::kozos => 'Shared',
        RealEstateGardenTypeEnum::parkositott => 'Park-like',
        RealEstateGardenTypeEnum::tetokert => 'Roof',
    ],


    RealEstateHeatingTypeEnum::class => [
        RealEstateHeatingTypeEnum::gazCirko => 'gas heating',
        RealEstateHeatingTypeEnum::gazKonvektor => 'gas convector',
        RealEstateHeatingTypeEnum::hazKozponti => 'central',
        RealEstateHeatingTypeEnum::hazKozpontiEgyediMeressel => 'central (meatered)',
        RealEstateHeatingTypeEnum::tavFutes => 'district heating',
        RealEstateHeatingTypeEnum::tavFutesEgyediMeressel => 'distric heating (meatered)',
        RealEstateHeatingTypeEnum::elektromos => 'electric',
        RealEstateHeatingTypeEnum::fanCoil => 'fan-coil',
        RealEstateHeatingTypeEnum::vegyesTuzelesuKazan => 'mixed heating)',
        RealEstateHeatingTypeEnum::egyebKazan => 'other heater',
        RealEstateHeatingTypeEnum::padlofutes => 'floor heating',
        RealEstateHeatingTypeEnum::falfutes => 'wall heating',
        RealEstateHeatingTypeEnum::mennyezetiHutesFutes => 'ceiling heating-cooling)',
        RealEstateHeatingTypeEnum::hooszivattyu => 'heat pump',
        RealEstateHeatingTypeEnum::megujulo => 'renewable energy',
        RealEstateHeatingTypeEnum::egyeb => 'other',
        RealEstateHeatingTypeEnum::nincs => 'none',
    ],

    RealEstateStateEnum::class => [
        RealEstateStateEnum::ujepitesu => 'newly built',
        RealEstateStateEnum::ujszeru => 'as new',
        RealEstateStateEnum::felujitott => 'renovated',
        RealEstateStateEnum::joAllapotu => 'good condition',
        RealEstateStateEnum::felujitando => 'to be renovated',
    ],

    RealEstateHouseSubTypeEnum::class => [
        RealEstateHouseSubTypeEnum::csaladiHaz => 'Detached house',
        RealEstateHouseSubTypeEnum::ikerHaz => 'Duplex',
        RealEstateHouseSubTypeEnum::sorHaz => 'Rowhouse',
        RealEstateHouseSubTypeEnum::villa => 'Villa',
    ],

    RealEstateRetailUnitLocationEnum::class => [
        RealEstateRetailUnitLocationEnum::utcaiBejarat => 'street entrance',
        RealEstateRetailUnitLocationEnum::udvariBejarat => 'courtyard entrance',
        RealEstateRetailUnitLocationEnum::uzletkozpontban => 'in shopping center',
        RealEstateRetailUnitLocationEnum::egyeb => 'other',
    ],

    RealEstateOfficeLocationEnum::class => [
        RealEstateOfficeLocationEnum::irodahazban => 'in office building',
        RealEstateOfficeLocationEnum::csaladihazban => 'in detached house',
        RealEstateOfficeLocationEnum::lakasban => 'in apartment',
        RealEstateOfficeLocationEnum::egyeb => 'other',
    ],

    RealEstateWareHouseSubTypeEnum::class => [
        RealEstateWareHouseSubTypeEnum::logisztikaiPark => 'logistics park',
        RealEstateWareHouseSubTypeEnum::raktarbazis => 'warehouse center',
        RealEstateWareHouseSubTypeEnum::raktarhelyiseg => 'warehouse',
    ],

    RealEstateCateringSubTypeEnum::class => [
        RealEstateCateringSubTypeEnum::etterem => 'restaurant',
        RealEstateCateringSubTypeEnum::hotel => 'hotel',
        RealEstateCateringSubTypeEnum::panzio => 'inn',
        RealEstateCateringSubTypeEnum::egyeb => 'other',
    ],

    RealEstateIndustrialSubTypeEnum::class => [
        RealEstateIndustrialSubTypeEnum::telephely => 'yard',
        RealEstateIndustrialSubTypeEnum::muhely => 'workshop',
        RealEstateIndustrialSubTypeEnum::egyeb => 'other)',
    ],

    RealEstateDevelopmentSiteEnum::class => [
        RealEstateDevelopmentSiteEnum::lakoTerulet => 'residential',
        RealEstateDevelopmentSiteEnum::kereskedelmiTerulet => 'commercial district',
        RealEstateDevelopmentSiteEnum::lakoKereskedelmiTerulet => 'residential-commercial area',
        RealEstateDevelopmentSiteEnum::udoloTerulet => 'recreational area',
        RealEstateDevelopmentSiteEnum::ipariTerulet => 'industrical district',
    ],

    RealEstateOfferStatusEnum::class => [
        RealEstateOfferStatusEnum::vazlat => 'draft',
        RealEstateOfferStatusEnum::mentett => 'saved',
        RealEstateOfferStatusEnum::kikuldve => 'sent',
    ],

    ClientStatusEnum::class => [
        ClientStatusEnum::aktualis => 'active',
        ClientStatusEnum::nemAktualis => 'inactive',
    ],

    ClientPreferredContactEnum::class => [
        ClientPreferredContactEnum::email => 'e-mail',
        ClientPreferredContactEnum::telefon => 'phone',
    ],

    ClientSourceEnum::class => [
        ClientSourceEnum::sajatWeb => 'own web',
        ClientSourceEnum::kereso => 'seach',
        ClientSourceEnum::ingatlanCom => 'ingatlan.com',
        ClientSourceEnum::attelepitesiCeg => 'relocation agency',
        ClientSourceEnum::regiUgyfel => 'old client',
        ClientSourceEnum::egyeb => 'other',
    ],

    ClientRequiredSchoolEnum::class => [
        ClientRequiredSchoolEnum::ovoda => 'kindergarten',
        ClientRequiredSchoolEnum::amerikai => 'American',
        ClientRequiredSchoolEnum::brit => 'Brittish',
        ClientRequiredSchoolEnum::francia => 'French',
        ClientRequiredSchoolEnum::nemet => 'German',
        ClientRequiredSchoolEnum::osztrak => 'Austrian',
    ],

    UserTypeEnum::class => [
        UserTypeEnum::adminuser => 'admin user',
        UserTypeEnum::ugyfel => 'client, reg. visitor',
    ],


];
