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
        RealEstateCategoryEnum::lakoIngatlan => 'lakóingatlan',
        RealEstateCategoryEnum::kereskedelmiIngatlan => 'kereskedelmi ingatlan',
    ],

    RealEstateStatusEnum::class => [
        RealEstateStatusEnum::aktualis => 'aktuális',
        RealEstateStatusEnum::nemAktualis => 'nem aktuális',
    ],

    RealEstateWebStatusEnum::class => [
        RealEstateWebStatusEnum::aktiv => 'aktív',
        RealEstateWebStatusEnum::inaktiv => 'inaktív',
        RealEstateWebStatusEnum::kiemelt => 'kiemelt',
    ],

    RealEstateContractTypeEnum::class => [
        RealEstateContractTypeEnum::elado => 'eladó',
        RealEstateContractTypeEnum::kiado => 'kiadó',
    ],

    RealEstateOrientationEnum::class => [
        RealEstateOrientationEnum::eszaki => 'északi',
        RealEstateOrientationEnum::deli => 'déli',
        RealEstateOrientationEnum::keleti => 'keleti',
        RealEstateOrientationEnum::nyugati => 'nyugati',
        RealEstateOrientationEnum::eszakKeleti => 'északkeleti',
        RealEstateOrientationEnum::delKeleti => 'délkeleti',
        RealEstateOrientationEnum::eszakNyugati => 'északnyugati',
        RealEstateOrientationEnum::delNyugati => 'délnyugati',
    ],

    RealEstateVistaEnum::class => [
        RealEstateVistaEnum::utcara => 'utcára',
        RealEstateVistaEnum::udvarra => 'udvarra',
        RealEstateVistaEnum::zoldre => 'zöldre',
        RealEstateVistaEnum::parkra => 'parkra',
        RealEstateVistaEnum::panoramas => 'panorámás',
    ],

    RealEstateKitchenTypeEnum::class => [
        RealEstateKitchenTypeEnum::openPlan => 'Amerikai',
        RealEstateKitchenTypeEnum::openPlanDiningRoom => 'Amerikai+étkező',
        RealEstateKitchenTypeEnum::openPlanDiningArea => 'Amerikai+étkező rész',
        RealEstateKitchenTypeEnum::openPlanCanBeSepareted => 'Amerikai, leválasztható',
        RealEstateKitchenTypeEnum::separeted => 'Szeparált',
        RealEstateKitchenTypeEnum::separetedDiningRoom => 'Szeparált+étkező',
        RealEstateKitchenTypeEnum::separetedDiningArea => 'Szeparált+étkező rész',
        RealEstateKitchenTypeEnum::teaKitchen => 'Teakonyha',
        RealEstateKitchenTypeEnum::eatInKitchen => 'Étkezős konyha',
    ],

    RealEstateFurnitureEnum::class => [
        RealEstateFurnitureEnum::butorozott => 'bútorozott',
        RealEstateFurnitureEnum::butorozatlan => 'bútorozatlan',
        RealEstateFurnitureEnum::reszbenButorozott => 'részben bútorozott',
        RealEstateFurnitureEnum::keresreMegoldhato => 'kérésre megoldható',
    ],

    RealEstateGardenTypeEnum::class => [
        RealEstateGardenTypeEnum::nincs => 'nincs',
        RealEstateGardenTypeEnum::privat => 'privát',
        RealEstateGardenTypeEnum::kozos => 'közös',
        RealEstateGardenTypeEnum::parkositott => 'parkosított',
        RealEstateGardenTypeEnum::tetokert => 'tetőkert',
    ],

    RealEstateHeatingTypeEnum::class => [
        RealEstateHeatingTypeEnum::gazCirko => 'Gáz (cirko)',
        RealEstateHeatingTypeEnum::gazKonvektor => 'Gáz (konvektor)',
        RealEstateHeatingTypeEnum::hazKozponti => 'Házközponti',
        RealEstateHeatingTypeEnum::hazKozpontiEgyediMeressel => 'Házközponti egyedi méréssel',
        RealEstateHeatingTypeEnum::tavFutes => 'Távfűtés',
        RealEstateHeatingTypeEnum::tavFutesEgyediMeressel => 'Távfűtés egyedi méréssel',
        RealEstateHeatingTypeEnum::elektromos => 'Elektromos',
        RealEstateHeatingTypeEnum::fanCoil => 'Fan-coil',
        RealEstateHeatingTypeEnum::vegyesTuzelesuKazan => 'Vegyestüzelésű kazán',
        RealEstateHeatingTypeEnum::egyebKazan => 'Egyéb kazán',
        RealEstateHeatingTypeEnum::padlofutes => 'Padlófűtés',
        RealEstateHeatingTypeEnum::falfutes => 'Falfűtés',
        RealEstateHeatingTypeEnum::mennyezetiHutesFutes => 'Mennyezeti hűtés-fűtés',
        RealEstateHeatingTypeEnum::hooszivattyu => 'Hőszivattyú',
        RealEstateHeatingTypeEnum::megujulo => 'Megújuló energia',
        RealEstateHeatingTypeEnum::egyeb => 'Egyéb',
        RealEstateHeatingTypeEnum::nincs => 'Nincs',
    ],

    RealEstateStateEnum::class => [
        RealEstateStateEnum::ujepitesu => 'újépítésű',
        RealEstateStateEnum::ujszeru => 'újszerű',
        RealEstateStateEnum::felujitott => 'felújított',
        RealEstateStateEnum::joAllapotu => 'jó állpotú',
        RealEstateStateEnum::felujitando => 'felújítandó',
    ],

    RealEstateHouseSubTypeEnum::class => [
        RealEstateHouseSubTypeEnum::csaladiHaz => 'családi ház',
        RealEstateHouseSubTypeEnum::ikerHaz => 'ikerház',
        RealEstateHouseSubTypeEnum::sorHaz => 'sorház',
        RealEstateHouseSubTypeEnum::villa => 'villa',
    ],

    RealEstateRetailUnitLocationEnum::class => [
        RealEstateRetailUnitLocationEnum::utcaiBejarat => 'utcai bejárattal',
        RealEstateRetailUnitLocationEnum::udvariBejarat => 'udvari bejárattal',
        RealEstateRetailUnitLocationEnum::uzletkozpontban => 'üzletközpontban',
        RealEstateRetailUnitLocationEnum::egyeb => 'egyéb',
    ],

    RealEstateOfficeLocationEnum::class => [
        RealEstateOfficeLocationEnum::irodahazban => 'irodaházban',
        RealEstateOfficeLocationEnum::csaladihazban => 'családi házban',
        RealEstateOfficeLocationEnum::lakasban => 'lakásban',
        RealEstateOfficeLocationEnum::egyeb => 'egyéb',
    ],

    RealEstateWareHouseSubTypeEnum::class => [
        RealEstateWareHouseSubTypeEnum::logisztikaiPark => 'logisztikai park',
        RealEstateWareHouseSubTypeEnum::raktarbazis => 'raktárbázis',
        RealEstateWareHouseSubTypeEnum::raktarhelyiseg => 'raktárhelyiség',
    ],

    RealEstateCateringSubTypeEnum::class => [
        RealEstateCateringSubTypeEnum::etterem => 'étterem',
        RealEstateCateringSubTypeEnum::hotel => 'hotel',
        RealEstateCateringSubTypeEnum::panzio => 'panzió',
        RealEstateCateringSubTypeEnum::egyeb => 'egyéb',
    ],

    RealEstateIndustrialSubTypeEnum::class => [
        RealEstateIndustrialSubTypeEnum::telephely => 'telephely',
        RealEstateIndustrialSubTypeEnum::muhely => 'műhely',
        RealEstateIndustrialSubTypeEnum::egyeb => 'egyéb',
    ],

    RealEstateDevelopmentSiteEnum::class => [
        RealEstateDevelopmentSiteEnum::lakoTerulet => 'lakóterület',
        RealEstateDevelopmentSiteEnum::kereskedelmiTerulet => 'kereskedelmi terület',
        RealEstateDevelopmentSiteEnum::lakoKereskedelmiTerulet => 'lakó- kereskedelmi terület',
        RealEstateDevelopmentSiteEnum::udoloTerulet => 'üdülő terület',
        RealEstateDevelopmentSiteEnum::ipariTerulet => 'ipari terület',
    ],

    RealEstateOfferStatusEnum::class => [
        RealEstateOfferStatusEnum::vazlat => 'vázlat',
        RealEstateOfferStatusEnum::mentett => 'mentett',
        RealEstateOfferStatusEnum::kikuldve => 'kiküldve',
    ],

    ClientStatusEnum::class => [
        ClientStatusEnum::aktualis => 'aktuális',
        ClientStatusEnum::nemAktualis => 'nem aktuális',
    ],

    ClientPreferredContactEnum::class => [
        ClientPreferredContactEnum::email => 'e-mail',
        ClientPreferredContactEnum::telefon => 'telefon',
    ],

    ClientSourceEnum::class => [
        ClientSourceEnum::sajatWeb => 'saját web',
        ClientSourceEnum::kereso => 'kereső',
        ClientSourceEnum::ingatlanCom => 'ingatlan.com',
        ClientSourceEnum::attelepitesiCeg => 'áttelepítési cég',
        ClientSourceEnum::regiUgyfel => 'régi ügyfél',
        ClientSourceEnum::egyeb => 'egyéb',
    ],

    ClientRequiredSchoolEnum::class => [
        ClientRequiredSchoolEnum::ovoda => 'óvoda',
        ClientRequiredSchoolEnum::amerikai => 'amerikai',
        ClientRequiredSchoolEnum::brit => 'brit',
        ClientRequiredSchoolEnum::francia => 'francia',
        ClientRequiredSchoolEnum::nemet => 'német',
        ClientRequiredSchoolEnum::osztrak => 'osztrák',
    ],

    UserTypeEnum::class => [
        UserTypeEnum::adminuser => 'admin felhasználó',
        UserTypeEnum::ugyfel => 'ügyfél, reg. látogató',
    ],

];
