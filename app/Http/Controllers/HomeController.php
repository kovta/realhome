<?php

namespace App\Http\Controllers;

use App\Http\Traits\FilterableListTrait;
use App\Mail\ClientRequirementUpdatedMail;
use App\Mail\KapcsolatfelveteliKeresMail;
use App\Models\Client;
use App\Models\ClientRequirement;
use App\Models\Currency;
use App\Models\Enum\ClientRequirementStatusEnum;
use App\Models\Enum\RealEstateFurnitureEnum;
use App\Models\Enum\UserTypeEnum;
use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\Enum\RealEstateKitchenTypeEnum;
use App\Models\Enum\RealEstateStatusEnum;
use App\Models\Enum\RealEstateWebStatusEnum;
use App\Models\LocationArea;
use App\Models\LocationNeighborhood;
use App\Models\LocationTownDistrict;
use App\Models\Post;
use App\Models\RealEstate;
use App\Models\RealEstateType;
use App\Models\SiteParameter;
use App\Models\SpecialOfferPage;
use App\Models\TextContentPage;
use App\User;
use Doctrine\DBAL\Driver\AbstractDB2Driver;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // kiszedve, hogy a kezdolap ne legyen vedett
        //$this->middleware('auth');
        Route::getRoutes()->getByName('realEstatePublicList')->breadCrumbCaption = 'public.real_estate_list_title';
        Route::getRoutes()->getByName('realEstatePublicDatapage')->breadCrumbCaption = 'public.real_estate_public_datapage_title';
    }

    /**
     * @param $priceFilterMin
     * @param $priceFilterMax
     */
    public static function getPriceFilterMinMax(&$priceFilterMin, &$priceFilterMax)
    {
        $priceFilterMin = DB::table('real_estates')->min('offer_price');
        $priceFilterMin = $priceFilterMin / 1000;
        $priceFilterMax = DB::table('real_estates')->max('offer_price');
        $priceFilterMax = $priceFilterMax / 1000;
    }

    /**
     * @return Builder[]|Collection
     */
    public static function getMainRealEstateOfferItems()
    {
        $limit = SiteParameter::getParameterValue('DisplayEstateNumMain1', 6);
        $score = SiteParameter::getParameterValue('MinScoreMainPageAppearence', 4);
        $collection = RealEstate::where('status_enum', '=', RealEstateStatusEnum::aktualis)->
        where('web_status_enum', '=', RealEstateWebStatusEnum::kiemelt)->
        where('score', '>=', $score)->
        limit($limit)->
        orderBy('web_status_enum')->
        orderBy('created_at', 'desc')->
        get();

        return $collection;
    }

    /**
     * @param int $contractType
     * @return Builder[]|Collection
     */
    protected static function getContractTypedFeaturedItems(int $contractType)
    {
        $limit = SiteParameter::getParameterValue('DisplayEstateNumMain2', 3);
        $collection = RealEstate::where('status_enum', '=', RealEstateStatusEnum::aktualis)->
        where('contract_type_enum', '=', $contractType)->
        limit($limit)->
        orderBy('web_status_enum', 'desc')->
        get();
        return $collection;
    }

    /**
     * @return Builder[]|Collection
     */
    public static function getMainRentalRealEstateOfferItems()
    {
        return HomeController::getContractTypedFeaturedItems(RealEstateContractTypeEnum::kiado);
    }

    /**
     * @return Builder[]|Collection
     */
    public static function getMainSaleRealEstateOfferItems()
    {
        return HomeController::getContractTypedFeaturedItems(RealEstateContractTypeEnum::elado);
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $featuredRealEstates = HomeController::getMainRealEstateOfferItems();
        $featuredRentalRealEstates = HomeController::getMainRentalRealEstateOfferItems();
        $featuredSaleRealEstates = HomeController::getMainSaleRealEstateOfferItems();
        HomeController::getPriceFilterMinMax($priceFilterMin, $priceFilterMax);

        $contractTypeEnums = RealEstateContractTypeEnum::toSelectValueSet();
        $realEstateTypes = RealEstateType::all();

        $TagFeaturedBackgroundColor = SiteParameter::getParameterValue('TagFeaturedBackgroundColor');
        $TagFeaturedForegroundColor = SiteParameter::getParameterValue('TagFeaturedForegroundColor');
        $TagContractTypeBackgroundColor = SiteParameter::getParameterValue('TagContractTypeBackgroundColor');
        $TagContractTypeForegroundColor = SiteParameter::getParameterValue('TagContractTypeForegroundColor');
        $TagPriceBackgroundColor = SiteParameter::getParameterValue('TagPriceBackgroundColor');
        $TagPriceForegroundColor = SiteParameter::getParameterValue('TagPriceForegroundColor');
        $furnitureTypes = RealEstateFurnitureEnum::toSelectValueSet([]);

        return view('layouts.public.homex.index', [
            'contractTypeEnums' => $contractTypeEnums,
            'realEstateTypes' => $realEstateTypes,
            'priceFilterMin' => $priceFilterMin,
            'priceFilterMax' => $priceFilterMax,

            'featuredRealEstates' => $featuredRealEstates,
            'featuredRentalRealEstates' => $featuredRentalRealEstates,
            'featuredSaleRealEstates' => $featuredSaleRealEstates,
            'TagFeaturedBackgroundColor' => $TagFeaturedBackgroundColor,
            'TagFeaturedForegroundColor' => $TagFeaturedForegroundColor,
            'TagContractTypeBackgroundColor' => $TagContractTypeBackgroundColor,
            'TagContractTypeForegroundColor' => $TagContractTypeForegroundColor,
            'TagPriceBackgroundColor' => $TagPriceBackgroundColor,
            'TagPriceForegroundColor' => $TagPriceForegroundColor,
            'furnitureTypes' => $furnitureTypes,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function thanksRegister()
    {
        return view('layouts.public.homex.thanksregister');
    }

    /**
     * @return Factory|View
     */
    public function mustValidateEmail()
    {
        return view('layouts.public.homex.mustvalidateemail');
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function rolunk()
    {
        $page = TextContentPage::getPage('rolunk');
        $title = $page->translate(App::getLocale())->title;
        $content = $page->translate(App::getLocale())->content;
        return view('layouts.public.homex.about', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function kapcsolat()
    {
        $page = TextContentPage::getPage('kapcsolat');
        $title = $page->translate(App::getLocale())->title;
        $content = $page->translate(App::getLocale())->content;
        return view('layouts.public.homex.contact', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function kapcsolatfelveteliKeres(Request $request)
    {
        $mail = new KapcsolatfelveteliKeresMail($request->post());
        $from = env('MAIL_FROM_ADDRESS', 'MAIL_FROM_ADDRESS missing from env');
        /*
                // mail to admins...
                $adminUsers = User::role('administrators')->get();
                $to = array();
                foreach ($adminUsers as $user){
                    $to[] = $user->email;
                }
        */
        $subject = env('APP_URL', 'weboldal') . ' - Kapcsolatfelvételi kérés';

        $to = SiteParameter::getParameterValue('EmailFullContactRequest', null);
        $mail->from($from)->to($to)->subject($subject);
        Mail::send($mail);

        return redirect()->back();
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function feltetelek()
    {
        $page = TextContentPage::getPage('feltetelek');
        $title = $page->translate(App::getLocale())->title;
        $content = $page->translate(App::getLocale())->content;
        return view('layouts.public.homex.terms', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function kedvencek(Request $request)
    {
        if(is_null(Auth::user()->client))
        {
            return view('layouts.public.homex.favorites', [
                'admin' => true,
                'realEstates' => "",
                'queryParams' => "",
                'TagFeaturedBackgroundColor' => "",
                'TagFeaturedForegroundColor' => "",
                'TagContractTypeBackgroundColor' => "",
                'TagContractTypeForegroundColor' => "",
                'TagPriceBackgroundColor' => "",
                'TagPriceForegroundColor' => "",
                'contractTypeEnums' => "",
            ]);
        }

        $realEstates = RealEstate::where('status_enum', '=', RealEstateStatusEnum::aktualis)->
        where('web_status_enum', '<>', RealEstateWebStatusEnum::inaktiv)->
        whereIn('id', DB::table('real_estate_short_list')->select('real_estate_id')
            ->where('client_id', '=', Auth::user()->client->id));

        $perPage = SiteParameter::getParameterValue('DisplayEstateNumDefault', 10);
        $realEstates = $realEstates->orderBy('created_at', 'desc')->paginate($perPage);
        $queryParams = $request->input();

        $contractTypeEnums = RealEstateContractTypeEnum::toSelectValueSet();
        $realEstateTypes = RealEstateType::all();

        HomeController::getPriceFilterMinMax($priceFilterMin, $priceFilterMax);

        $TagFeaturedBackgroundColor = SiteParameter::getParameterValue('TagFeaturedBackgroundColor');
        $TagFeaturedForegroundColor = SiteParameter::getParameterValue('TagFeaturedForegroundColor');
        $TagContractTypeBackgroundColor = SiteParameter::getParameterValue('TagContractTypeBackgroundColor');
        $TagContractTypeForegroundColor = SiteParameter::getParameterValue('TagContractTypeForegroundColor');
        $TagPriceBackgroundColor = SiteParameter::getParameterValue('TagPriceBackgroundColor');
        $TagPriceForegroundColor = SiteParameter::getParameterValue('TagPriceForegroundColor');

        return view('layouts.public.homex.favorites', [
            "admin" => false,
            'realEstates' => $realEstates,
            'queryParams' => $queryParams,
            'TagFeaturedBackgroundColor' => $TagFeaturedBackgroundColor,
            'TagFeaturedForegroundColor' => $TagFeaturedForegroundColor,
            'TagContractTypeBackgroundColor' => $TagContractTypeBackgroundColor,
            'TagContractTypeForegroundColor' => $TagContractTypeForegroundColor,
            'TagPriceBackgroundColor' => $TagPriceBackgroundColor,
            'TagPriceForegroundColor' => $TagPriceForegroundColor,

            'contractTypeEnums' => $contractTypeEnums,
//            'realEstateTypes' => $realEstateTypes,
//            'priceFilterMin' => $priceFilterMin,
//            'priceFilterMax' => $priceFilterMax,
//            'filterAreaMin' => $request->minarea,
//            'filterAreaMax' => $request->maxarea,
//            'filterNumberBedroom' => $request->number_bedroom,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function adatkezelesiSzabalyok()
    {
        $page = TextContentPage::getPage('adatkezelesi-szabalyok');
        $title = $page->translate(App::getLocale())->title;
        $content = $page->translate(App::getLocale())->content;
        return view('layouts.public.homex.terms', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     *  Return searching page view
     *
     * @return Application|Factory|View
     */
    public function searchView()
    {
        self::getPriceFilterMinMax($priceFilterMin, $priceFilterMax);
        $contractTypeEnums = RealEstateContractTypeEnum::toSelectValueSet();
        $realEstateTypes = RealEstateType::all();

        return view('RealEstate.realestate-search', [
            'contractTypeEnums' => $contractTypeEnums,
            'realEstateTypes' => $realEstateTypes,
            'priceFilterMin' => $priceFilterMin,
            'priceFilterMax' => $priceFilterMax,
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function realEstateList(Request $request)
    {
        $featuredRealEstates = HomeController::getMainRealEstateOfferItems();
        $offerPage = ($request->input('offerPage', null) * 1);
        $specialOfferPage = SpecialOfferPage::find($offerPage);
//        dd(isset($offerPage) && $offerPage != 0);
        if (isset($offerPage) && $offerPage != 0) {
            $realEstates = RealEstate::where('status_enum', '=', RealEstateStatusEnum::aktualis)
                ->where('real_estate_type_id', $request->type)
                ->where('web_status_enum', '<>', RealEstateWebStatusEnum::inaktiv);
        } else {
            $realEstates = RealEstate::where('status_enum', '=', RealEstateStatusEnum::aktualis)->
            where('web_status_enum', '<>', RealEstateWebStatusEnum::inaktiv);

            if ($request->has('type') && !empty($request->type)) {
                $realEstates = $realEstates->where('real_estate_type_id', '=', $request->type);
            }
            if ($request->has('contract_type') && ($request->contract_type != 0)) {
                $realEstates = $realEstates->where('contract_type_enum', '=', $request->contract_type);
            }

            if ($request->has('minarea') && ($request->minarea > 0)) {
                $realEstates = $realEstates->where('base_area_gross', '>=', $request->minarea);
            }

            if ($request->has('maxarea') && ($request->maxarea > 0)) {
                $realEstates = $realEstates->where('base_area_gross', '<=', $request->maxarea);
            }

            if ($request->has('maxarea') && ($request->maxarea > 0)) {
                $realEstates = $realEstates->where('base_area_gross', '<=', $request->maxarea);
            }
            if ($request->has('real_estate_id') && !empty($request->real_estate_id)) {
                $realEstates = $realEstates->where('code', 'like', '%' . $request->real_estate_id . '%');
            }

            if ($request->has('freetext') && !empty($request->freetext)) {

                /*
                $realEstates->whereHas('translations', function ($query) use ($request) {
                    $query->where('locale', '=', App::getLocale())->where('description', 'like', '%'.$request->freetext.'%');
                });
                // TODO a telepules nevre kereses nem ment
                $realEstates->whereHas('locationArea', function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->freetext.'%');
                });
                */
                //  mivel a lekérdezésben minden egyes paraméter "AND" lekérdezési feltetellel van a query-hez fűzve,
                //  a "freetext" paraméterben érkező viszont a description, a location és a town "OR" logikai művelet van,
                //  (ráadásul mindkettő kapcsolódó táblában)
                //  ezért az alábbi *hack*-re van szükség a megfelelő zárójelezéshez
                $description_needed = false;
                $location_town_needed = false;
                $realEstates = $realEstates->whereHas('translations', function () use (&$description_needed) {
                    $description_needed = true;
                });
                $realEstates = $realEstates->whereHas('locationArea', function () use (&$location_town_needed) {
                    $location_town_needed = true;
                });
                //
                if ($description_needed && $location_town_needed) {
                    $realEstates = $realEstates->whereHas('translations', function ($query) use ($request) {
                        $query->where('locale', '=', App::getLocale())->where('description', 'like', '%' . $request->freetext . '%');
                    })->orWhereHas('locationArea', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->freetext . '%');
                    })->orWhereHas('locationTownDistrict', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->freetext . '%');
                    })->orWhereHas('locationNeighborhood', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->freetext . '%');
                    });
                } elseif ($description_needed) {
                    $realEstates = $realEstates->where('locale', '=', App::getLocale())->where('description', 'like', '%' . $request->freetext . '%');
                } elseif ($location_town_needed) {
                    $realEstates = $realEstates->where('name', 'like', '%' . $request->freetext . '%');
                } else {
                    //
                }

            }

            if ($request->has('price')) {
                list($minPrice, $maxPrice) = explode(';', $request->price);
                $minPrice = $minPrice * 1000;
                $maxPrice = $maxPrice * 1000;
                $realEstates = $realEstates->where('offer_price', '>=', $minPrice)
                    ->where('offer_price', '<=', $maxPrice);
            }

            if ($request->has('number_bedroom_min') && ($request->number_bedroom_min > 0)) {
                $realEstates = $realEstates->where('number_bedroom', '>=', $request->number_bedroom_min);
            }

            if ($request->has('number_bedroom_max') && ($request->number_bedroom_max > 0)) {
                $realEstates = $realEstates->where('number_bedroom', '<=', $request->number_bedroom_max);
            }
            if ($request->has('furniture_enums') && (empty($request->furniture_enums))) {
                foreach ($request->furniture_enums as $emun) {
                    $realEstates = $realEstates->where('real_estate_furniture_enum', '=', $emun);
                }
            };

            if ($request->has('location_area_id') && !empty($request->location_area_id)) {
                $requestAreaArray = explode(',', $request->location_area_id);
                $realEstates = $realEstates->whereIn('location_area_id', $requestAreaArray);
                $requestArray = explode(',', $request->location_area_id);
                $requestAreaNameArray = LocationArea::whereIn('id', $requestArray)->get()->toArray();
                unset($requestArray);
            }
            if ($request->location_area_id != null) {
                if ($request->has('location_town_district_id') && !empty($request->location_town_district_id)) {
                    $requestTownDistrictArray = explode(',', $request->location_town_district_id);
                    $realEstates = $realEstates->whereIn('location_town_district_id', $requestTownDistrictArray);
                    $requestArray = explode(',', $request->location_town_district_id);
                    $requestTownDistrictNameArray = LocationTownDistrict::whereIn('id', $requestArray)->get()->toArray();
                    unset($requestArray);
                }
                if ($request->location_town_district_id != null && $request->has('location_neighborhood_id') && !empty($request->location_neighborhood_id)) {
                    $requestNeighborhoodArray = explode(',', $request->location_neighborhood_id);
                    $realEstates = $realEstates->whereIn('location_neighborhood_id', $requestNeighborhoodArray);
                    $requestArray = explode(',', $request->location_area_id);
                    $requestNeighborhoodNameArray = LocationNeighborhood::whereIn('id', $requestArray)->get()->toArray();
                    unset($requestArray);
                }
            }
            foreach (RealEstate::$features as $feature) {
                if ($request->has($feature) && ($request->$feature == 1)) {
                    $realEstates = $realEstates->where($feature, '=', 1);
                }
            }
        }
        $perPage = SiteParameter::getParameterValue('DisplayEstateNumDefault', 10);
        $getOrderOption = RealEstate::getPublicPageOrderColumnName();
        $orderColumn = 'updated_at';
        $direction = 'desc';
        $orderId = '1';
        if (!empty($request->orderBy) && $request->has('orderBy')) {
            if ($request->orderBy == '1') {
                $orderColumn = $getOrderOption[$request->orderBy]['column'];
                $direction = $getOrderOption[$request->orderBy]['direction'];
                $orderId = $request->orderBy;
            }
            if ($request->orderBy == '2') {
                $orderColumn = $getOrderOption[$request->orderBy]['column'];
                $direction = $getOrderOption[$request->orderBy]['direction'];
                $orderId = $request->orderBy;
            }
            if($request->orderBy == '3') {
                $orderColumn = $getOrderOption[$request->orderBy]['column'];
                $direction = $getOrderOption[$request->orderBy]['direction'];
                $orderId = $request->orderBy;
            }
        }
        $realEstates = $realEstates->orderBy($orderColumn, $direction)->paginate($perPage);
        // ezen szuroknek kellenek az ures kulcsok a templateben
        $queryParams = array_merge(['contract_type' => null, 'type' => null], $request->input());
        $contractTypeEnums = RealEstateContractTypeEnum::toSelectValueSet();
        $realEstateTypes = RealEstateType::all();
        HomeController::getPriceFilterMinMax($priceFilterMin, $priceFilterMax);

        $TagFeaturedBackgroundColor = SiteParameter::getParameterValue('TagFeaturedBackgroundColor');
        $TagFeaturedForegroundColor = SiteParameter::getParameterValue('TagFeaturedForegroundColor');
        $TagContractTypeBackgroundColor = SiteParameter::getParameterValue('TagContractTypeBackgroundColor');
        $TagContractTypeForegroundColor = SiteParameter::getParameterValue('TagContractTypeForegroundColor');
        $TagPriceBackgroundColor = SiteParameter::getParameterValue('TagPriceBackgroundColor');
        $TagPriceForegroundColor = SiteParameter::getParameterValue('TagPriceForegroundColor');
        $furnitureTypes = RealEstateFurnitureEnum::toSelectValueSet( []);

        /**
         * Ha lett beallitva min ar a keresesnel, akkor beallitjuk, hogy a kirenderelt oldalra vissatoltse
         */
        if (isset($minPrice) && $priceFilterMin !== $minPrice) {
            $priceFilterMinValue = $minPrice / 1000;
        }

        /**
         * Ha lett beallitva max ar a keresesnel, akkor beallitjuk, hogy a kirenderelt oldalra vissatoltse
         */
        if (isset($maxPrice) && $priceFilterMax !== $maxPrice) {
            $priceFilterMaxValue = $maxPrice / 1000;
        }
        return view('layouts.public.homex.property-list-sidebar-right', [
            'realEstates' => $realEstates,
            'queryParams' => $queryParams,
            'TagFeaturedBackgroundColor' => $TagFeaturedBackgroundColor,
            'TagFeaturedForegroundColor' => $TagFeaturedForegroundColor,
            'TagContractTypeBackgroundColor' => $TagContractTypeBackgroundColor,
            'TagContractTypeForegroundColor' => $TagContractTypeForegroundColor,
            'TagPriceBackgroundColor' => $TagPriceBackgroundColor,
            'TagPriceForegroundColor' => $TagPriceForegroundColor,
            'furnitureTypes' => $furnitureTypes,

            'contractTypeEnums' => $contractTypeEnums,
            'realEstateTypes' => $realEstateTypes,
            'priceFilterMin' => $priceFilterMin,
            'priceFilterMax' => $priceFilterMax,
            'priceFilterMinValue' => $priceFilterMinValue ?? $priceFilterMin,
            'priceFilterMaxValue' => $priceFilterMaxValue ?? $priceFilterMax,
            'request' => $request,
            'areaNameArray' => $requestAreaNameArray ?? null,
            'townDistrictNameArray' => $requestTownDistrictNameArray ?? null,
            'neighborhoodNameArray' => $requestNeighborhoodNameArray ?? null,

            'specialOfferPage' => $specialOfferPage,
            'featuredRealEstates' => $featuredRealEstates,
            'orderOption' => $getOrderOption,
            'selectedOrder' => $orderId,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function realEstateSalesList(Request $request)
    {
        return redirect(route('realEstatePublicList') . '?contract_type=' . RealEstateContractTypeEnum::elado);
    }

    /**
     * @param Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function realEstateRentalList(Request $request)
    {
        return redirect(route('realEstatePublicList') . '?contract_type=' . RealEstateContractTypeEnum::kiado);
    }

    /**
     * @param RealEstate $realEstate
     * @return Application|Factory|View
     */
    public function realEstatePublicDatapage(RealEstate $realEstate)
    {
        return view('layouts.public.homex.property_single_1', [
            'realEstate' => $realEstate,
        ]);
    }

    /**
     * @param Client $client
     * @return Application|Factory|View
     */
    public function clientProfile(Client $client)
    {
        return view('layouts.public.homex.client-datapage', [
            'record' => $client,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateClientProfile(Request $request, $id)
    {
        $client = Client::find($id);
        $client->phone_1 = $request->phone_1;
        $client->phone_2 = $request->phone_2;
        $client->save();
        return redirect(route('clientProfile', $client));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function realEstatePublicMarkasfavorite(Request $request)
    {
        $realEstateId = $request->post('id');
        if ($realEstateId == null) {
            throw new \Exception('realEstatePublicMarkasfavorite: nincs realEstateId');
        }
        $realEstate = RealEstate::find($realEstateId);
        $message = '';
        $status = '';

        $obj = DB::table('real_estate_short_list')
            ->select('id')
            ->where('real_estate_id', '=', $realEstateId)
            ->where('client_id', '=', Auth::user()->client->id)
            ->first();
        if ($obj != null && $obj->id > 0) {
            DB::table('real_estate_short_list')->delete($obj->id);
            $realEstate->web_interestes--;
            $status = 'del';
            $message = "{$obj->id} record deleted from real_estate_short_list";
        } else {
            DB::table('real_estate_short_list')
                ->insert(
                    ['real_estate_id' => $realEstateId, 'client_id' => Auth::user()->client->id]
                );
            $realEstate->web_interestes++;
            $status = 'set';
            $message = "Record inserted to real_estate_short_list [real_estate_id=$realEstateId, client_id=" . Auth::user()->client->id . "]";
        }
        $realEstate->save();

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function myRequirements(Request $request)
    {
        $clients = array();
        $coWorkers = Client::all();
        foreach ($coWorkers as $item) {
            if (optional($item->user)->type_enum == UserTypeEnum::ugyfel) {
                $clients[] = $item;
            }
        }

        $client = Client::find(Auth::user()->client->id);
        $clientRequirement = ClientRequirement::where('client_id', '=', $client->id)->first();
        if ($clientRequirement == null) {
            $clientRequirement = new ClientRequirement();
            $clientRequirement->client_id = $client->id;
            $clientRequirement->price_currency_id = 1;  // HUF
            $clientRequirement->status_enum = ClientRequirementStatusEnum::nemAktualis; // doksi: "2.3.	Vételi/bérlési igények kezelése" c. fejezet
        }

        // load kitchen_types
        $temp = DB::table('client_requirement_kitchen_types')
            ->where('client_requirement_id', '=', $clientRequirement->id)
            ->get();
        $selectedKitchenTypes = [];
        foreach ($temp as $item) {
            $selectedKitchenTypes[] = $item->kitchen_type_enum;
        }

        $statuses = RealEstateStatusEnum::toSelectValueSet([old('status_enum', $clientRequirement->status_enum)]);
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([old('contract_type_enum', $clientRequirement->contract_type_enum)]);
        $realEstateTypes = RealEstateType::all()->sortBy('name');
        $kitchenTypes = RealEstateKitchenTypeEnum::toSelectValueSet($selectedKitchenTypes);
        $currencies = Currency::all()->sortBy('iso_code');

        return view('layouts.public.homex.requirements', [
            'record' => $clientRequirement,
            'client' => $client,
            'statuses' => $statuses,
            'contract_types' => $contractTypes,
            'real_estate_types' => $realEstateTypes,
            'clients' => $clients,
            'kitchenTypes' => $kitchenTypes,
            'currencies' => $currencies,
        ]);
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function updateMyRequirements(Request $request)
    {
        $client = Client::find(Auth::user()->client->id);
        $clientRequirement = ClientRequirement::where('client_id', '=', $client->id)->first();
        if ($clientRequirement == null) {
            $clientRequirement = new ClientRequirement();
            $clientRequirement->client_id = $client->id;
            $clientRequirement->price_currency_id = 1;  // HUF
            $clientRequirement->status_enum = ClientRequirementStatusEnum::nemAktualis; // doksi: "2.3.	Vételi/bérlési igények kezelése" c. fejezet
        }

        $rules = ClientRequirement::validationRules();
        $request->validate($rules);

        $data = $request->only($clientRequirement->getFillable());

        foreach ($clientRequirement->checkboxes as $checkbox) {
            if ($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) $data[$checkbox] = null;
        }
        $clientRequirement->fill($data);

        // ez a mezo mass filles, hogy legyen adat a betoltesnel, de kezzel mentjuk, mert az enum nincs az adatbazisban
        $kitchenTypeEnums = $clientRequirement->kitchen_type_enums;
        unset($clientRequirement->kitchen_type_enums);

        $clientRequirement->save();

        if (is_array($kitchenTypeEnums) && count($kitchenTypeEnums)) {
            DB::table('client_requirement_kitchen_types')->where('client_requirement_id', '=', $clientRequirement->id)->delete();
            foreach ($kitchenTypeEnums as $id) {
                DB::table('client_requirement_kitchen_types')->insert([
                    'client_requirement_id' => $clientRequirement->id,
                    'kitchen_type_enum' => $id
                ]);
            }
        }

        //  TODO:
        /*
        $mail = new ClientRequirementUpdatedMail($clientRequirement);
        $from = env('MAIL_FROM_ADDRESS', 'MAIL_FROM_ADDRESS missing from env');
        */
        /*
                // mail to admins...
                $adminUsers = User::role('administrators')->get();
                $to = array();
                foreach ($adminUsers as $user){
                    $to[] = $user->email;
                }*/
        /*
        $subject = env('APP_URL', 'weboldal') . ' - Kliens elképzelés változás';
        $to = SiteParameter::getParameterValue('EmailRegisterRequirement', null);
        $mail->from($from)->bcc($to)->subject($subject);
        Mail::send($mail);
        */
        //  sikeres mentes uzenet
        $request->session()->flash('message', trans('messages.my_requirements_updated_successful'));

        return redirect()->back();
    }

    /**
     * @return Factory|View
     */
    public function PostList()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('layouts.public.homex.blog-index', [
            'posts' => $posts
        ]);
    }

    /**
     * @return Factory|View
     */
    public function postPublicDatapage(Post $post)
    {
        /*
         *  Getting last 5 post
         */
        $lastFivePost = Post::orderByDesc('id')->limit(5)->get();
        /*
         *  Define meta tags
         */
        $metaDesc = "Testing";
        $ogTitle = "Testing";
        $ogDescription = "Testing";
        $ogUrl = "Testing";
        $ogType = "Testing";
        $fbAppId = "Testing";
        $ogSiteName = "Testing";
        $ogImage = "Testing";
        $ogImageSecureUrl = "Testing";
        $ogImageType = "Testing";
        $ogImageWidth = "Testing";
        $ogImageHeight = "Testing";
        $ogImageAlt = "Testing";

        return view('layouts.public.homex.blog-datapage', [
            'post' => $post,
            'lastFivePost' => $lastFivePost
        ], compact(
            [
            'metaDesc',
            'ogTitle',
            'ogDescription',
            'ogUrl',
            'ogType',
            'fbAppId',
            'ogSiteName',
            'ogImage',
            'ogImageSecureUrl',
            'ogImageType',
            'ogImageWidth',
            'ogImageHeight',
            'ogImageAlt'
            ]
        ));
    }

}
