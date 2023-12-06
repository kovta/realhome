<?php

namespace App\Http\Controllers;

use App;
use App\Http\Traits\FilterableListTrait;
use App\Jobs\SendRealEstateOfferEmailJob;
use App\Models\RealEstate;
use App\User;
use App\Models\Client;
use App\Models\Enum\UserTypeEnum;
use App\Models\Enum\LanguageEnum;
use App\Models\Enum\RealEstateOfferStatusEnum;
use App\Models\OfferMailSenderData;
use App\Models\RealEstateOffer;
use App\Models\RouteComponent;
use App\Models\Route;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class RealEstateOfferController extends Controller
{

    use FilterableListTrait, DispatchesJobs;

    public bool $filterSavedToSession = false;
    public string $filterSessionKey = 'RealEstateOfferListFilter';
    public array $filterFields = [
        'client_id',
    ];
    public array $numberFilterFields = [];


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|ContractView|void
     */
    public function index(Request $request)
    {
        $clients = Client::all();
        $selectableItems = $request->input('selection', null);    // kiválasztós üzemmód
        $nextRouteName = $request->input('nextStep', null);       // a kiválasztást követő route neve
        $entityId = $request->input('entityId', null);            // a kiválasztást 'megrendelő' entitás azonosítója
        if($selectableItems === 1 && (!$nextRouteName || !$entityId)) {
            return abort(400, 'Kivalasztos uzemmodban a tablanak tobb parameter kell!');
        }

        $notused = new Collection();
        $filters = $this->processFilters($notused, $request);
        return view('RealEstateOffer.list', [
            'selectableItems' => $selectableItems,
            'nextRouteName' => $nextRouteName,
            'entityId' => $entityId,

            'filters' => $filters,
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Request $request): Factory|View|Application
    {
        $clients = array();
        $coWorkers = Client::all();
        foreach($coWorkers as $item) {
            if(optional($item->user)->type_enum == UserTypeEnum::ugyfel) {
                $clients[] = $item;
            }
        }
        $coWorkers = array();
        $coWorkersAll = Client::all();
        foreach($coWorkersAll as $item) {
            if(optional($item->user)->type_enum == UserTypeEnum::adminuser) {
                $coWorkers[] = $item;
            }
        }

        $notused = new Collection();
        $filters = $this->processFilters($notused, $request);

        $entity = new RealEstateOffer();
        $entity->created_by_id = Auth::user()->id;
        if($filters['client_id']) {
            $entity->client_id = $filters['client_id'];
        }
        /*
         *
         */
        $user = new User();
        $user->roles->put(0, Role::findByName('clients'));
        $entityuser = new Client();
        // $entityuser->user = $user;
//        dd($user, $entity, $entityuser);
        return view('RealEstateOffer.datapage.create', [
            'method' => 'create',
            'record' => $entity,
            'statuses' => RealEstateOfferStatusEnum::toSelectValueSet([old('offer_status_enum', $entity->offer_status_enum)]),
            'clients' => $clients,
            'coWorkers' => $coWorkers,
            'languages' => LanguageEnum::toSelectValueSet([old('language_enum', $entity->language_enum)]),
            'entityuser' => $user,
            'roles' => Role::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $rules = RealEstateOffer::validationRules();
        $request->validate($rules);

        $entity = new RealEstateOffer();
        $data = $request->only($entity->getFillable());

        foreach($entity->checkboxes as $checkbox) {
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) {
                $data[$checkbox] = null;
            }
        }
        $entity->fill($data);

        $entity->save();
        return redirect(route('realEstateOffers.edit', [$entity->id]));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeWithClient(Request $request): Redirector|RedirectResponse|Application
    {
        $rules = RealEstateOffer::validationRules();
        $request->validate($rules);

        $entity = new RealEstateOffer();
        $data = $request->only($entity->getFillable());

        if(
            is_null($request->client_id)
            && !is_null($request->client_name)
            && !is_null($request->client_email)
        ) {
            $client = new Client();
            $client->name = $request->client_name;
            $client->email = $request->client_email;
            if(!empty($request->client_phone_1)) {
                $client->phone_1 = $request->client_phone_1;
            }
            if(!empty($request->client_phone_2)) {
                $client->phone_2 = $request->client_phone_2;
            }
            $client->save();
            $data['client_id'] = $client->id;
            if($request->user_create == "true") {
                $creator = Auth::user();
                $user = new User();
                $user->name = $request->client_name;
                $user->email = $request->client_email;
                $randomPassword = Str::random(8);
                $user->password = Hash::make($randomPassword);
                $user->type_enum = UserTypeEnum::ugyfel;
                $user->roles->put(0, Role::findByName('clients'));
                $user->save();
                $client->user_id = $user->id;
                $client->save();
                /*
                * Send mail to user
                */
//                SendUserPassword::dispatch($user->id, $creator->name, $creator->email, $randomPassword);
            }
        }
        foreach($entity->checkboxes as $checkbox) {
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) $data[$checkbox] = null;
        }
        $entity->fill($data);
        $entity->save();
        return redirect(route('realEstateOffers.edit', [$entity->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param RealEstateOffer $realEstateOffer
     * @return void
     */
    public function show(RealEstateOffer $realEstateOffer): void
    {
        return;
    }

    /**
     * @param RealEstateOffer $realEstateOffer
     * @return Factory|View
     */
    public function edit(RealEstateOffer $realEstateOffer): Factory|View
    {
        $clients = Client::all();
        $coWorkers = array();
        $coWorkersAll = Client::all();
        foreach($coWorkersAll as $item) {
            if(optional($item->user)->type_enum === UserTypeEnum::adminuser) {
                $coWorkers[] = $item;
            }
        }
        $statuses = RealEstateOfferStatusEnum::toSelectValueSet([old('offer_status_enum', $realEstateOffer->offer_status_enum)]);
        $languages = LanguageEnum::toSelectValueSet([old('language_enum', $realEstateOffer->language_enum)]);
        return view('RealEstateOffer.datapage.edit', [
            'method' => 'edit',
            'record' => $realEstateOffer,
            'statuses' => $statuses,
            'clients' => $clients,
            'coWorkers' => $coWorkers,
            'languages' => $languages,
            'noClient' => $realEstateOffer->client_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RealEstateOffer $realEstateOffer
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, RealEstateOffer $realEstateOffer): Redirector|RedirectResponse|Application
    {
        $rules = RealEstateOffer::validationRules();
        $request->validate($rules);

        $entity = $realEstateOffer;
        $data = $request->only($entity->getFillable());

        foreach($entity->checkboxes as $checkbox) {
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) {
                $data[$checkbox] = null;
            }
        }
        $entity->fill($data);

        $entity->save();
        return redirect(route('realEstateOffers.edit', [$entity->id]));
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(Request $request): JsonResponse|RedirectResponse
    {
        if($request->input('referer') && $request->input('referer') === "clientview") {
            $offerId = (int)$request->input('offer_id');
            $entity = RealEstateOffer::find($request->input('offer_id'));
            $entity->delete();
            return redirect()->route('clients.view', $request->input('client_id'));
        }
        $id = $request->post('id');
        $entity = RealEstateOffer::find($id);
        $entity->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "id=$id deleted"
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function tableDataLoader(Request $request): mixed
    {
        $q = RealEstateOffer::query()->with('realEstates')->where('client_id', '=', null);
        if(request()->has('filter')) {
            $filters = collect(request()->get('filter'));
            $this->processFilters($filters, $request);
            if($filters->get('client_id') !== null) {
                $q = RealEstateOffer::query()->with('realEstates')->where('client_id', '!=', null);
                $q = $q->where('client_id', '=', $filters->get('client_id'));
            }
        }
        return Datatables::of($q)
            ->addColumn('name_url', function (RealEstateOffer $rec) {
                return route('realEstateOffers.edit', [$rec->id]);
            })
            ->addColumn('client_name', function (RealEstateOffer $rec) {
                return $rec->client->name ?? '';
            })
            ->addColumn('status', function (RealEstateOffer $rec) {
                return RealEstateOfferStatusEnum::getDescription($rec->offer_status_enum);
            })
            ->addColumn('realestates', function (RealEstateOffer $rec) {
                return $rec->realEstates->implode('code', ', ');
            })
            ->make(true)
            ;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function offerItemList(Request $request): mixed
    {
        $realEstateOffer = RealEstateOffer::find($request->input('offer_id'));
        return DataTables::of($realEstateOffer->realEstates)
            // Picture + Gallery
            ->addColumn('first_image', function(RealEstate $rec) {
                return ($rec->getMedia('images')->first() !== null) ? $rec->getMedia('images')->first()->getUrl('admin-thumb') : '';
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
            // ID
            ->addColumn('id', function(RealEstate $rec) {
                return route('realEstates.edit', [$rec->id]);
            })
            // ID CODE
            ->addColumn('id_code', function(RealEstate $rec) {
                return $rec->id;
            })
            // CODE
            ->addColumn('code', function(RealEstate $rec) {
                return $rec->code;
            })
            // Megbizas
            ->addColumn('commission', function(RealEstate $rec) {
                return   (!empty($rec->commission) && $rec->commission == 1) ? __('messages.something_exists') : __('messages.something_not_exists');
            })
            // Kerulet
            ->addColumn('location_town_district_id', function(RealEstate $rec) {
                return $rec->locationTownDistrict->name ?? $rec->location_town_district_id;
            })
            // Utca
            ->addColumn('street_address', function(RealEstate $rec) {
                if (!empty($rec->street_address_1)) {
                    return $rec->street_address_1;
                } elseif (!empty($rec->street_address_2)) {
                    return $rec->street_address_2;
                } else {
                    return $rec->street_address_3;
                }
            })
            // Emelet
            ->addColumn('floor', function(RealEstate $rec) {
                return $rec->floor;
            })
            // negyzetmeter
            ->addColumn('base_area_gross', function(RealEstate $rec) {
                return $rec->base_area_gross;
            })
            // Brutto
            ->addColumn('offer_price', function(RealEstate $rec) {
                return $rec->priceFormatterToDataTables($rec->offer_price) ." ". ( ($rec->currency !== null) ? $rec->currency->iso_code : 'HUF');
            })
            // Ar min
            ->addColumn('limit_price', function(RealEstate $rec) {
                return $rec->priceFormatterToDataTables($rec->limit_price) ." ". ( ($rec->currency !== null) ? $rec->currency->iso_code : 'HUF');
            })
            // Pontszam
            ->addColumn('score', function(RealEstate $rec) {
                return $rec->score;
            })
            // Epitve
            ->addColumn('build_year', function(RealEstate $rec) {
                return $rec->build_year;
            })
            // Felujitva
            ->addColumn('renovation_year', function(RealEstate $rec) {
                return (!empty($rec->renovation_year) && isset($rec->renovation_year)) ? $rec->renovation_year : '?';
            })
            // Felujitva
            ->addColumn('details', function(RealEstate $rec) {
                $details = array();
                $details['code'] = $rec->code;
                $details['commission'] = ($rec->commission == 1) ? __('messages.something_exists') : __('messages.something_not_exists');
                $details['locationTownDistrict'] = ($rec->locationTownDistrict) ? $rec->locationTownDistrict->name : '';
                $details['street_address_1'] = $rec->street_address_1 ." ". $rec->street_address_2;
                $details['street_address_3'] = $rec->street_address_3;
                $details['base_area_gross'] = $rec->base_area_gross;
                $details['offer_price'] = $rec->offer_price;
                $details['comment'] = $rec->comment;
                $details['owner_name'] = $rec->owner_name;
                $details['owner_phone_1'] = $rec->owner_phone_1;
                $details['owner_phone_2'] = $rec->owner_phone_2;
                $details['owner_contact_name'] = $rec->owner_contact_name;
                $details['owner_contact_phone'] = $rec->owner_contact_phone;
                $details['owner_keys'] = $rec->owner_keys;
                $details['score'] = $rec->score;
                return $details;
            })
            ->setRowClass(function (RealEstate $rec) {
                return $rec->web_status_enum == 2 ? 'inactive-realEstate' : '';
            })
//            // ennek alapbol HUF-nak kell lennie, kulonben nem muxik a JS szam formazo
//            ->addColumn('price_currency_code', function(RealEstate $rec){
//                return !empty($rec->currency) ? $rec->currency->iso_code : 'HUF';
//            })
            ->toJson();
    }

    /**
     * @param Request $request
     * @param RealEstateOffer $realEstateOffer
     * @return JsonResponse
     */
    public function deleteItems(Request $request, RealEstateOffer $realEstateOffer): JsonResponse
    {
        $ids = $request->post('ids');
        if(!$ids) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.crud_no_selection_warning_text'),
            ]);
        }
        $idArray = explode(',', $ids);
        DB::table('real_estate_offer_components')
            ->where('offer_id', '=', $realEstateOffer->id)
            ->whereIn('real_estate_id', $idArray)->delete()
        ;
        return response()->json([
            'status' => 'ok',
            'message' => "$ids are deleted"
        ]);
    }

    /**
     * @param Request $request
     * @param RealEstateOffer $realEstateOffer
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function addItem(Request $request, RealEstateOffer $realEstateOffer): JsonResponse|Redirector|RedirectResponse
    {
        $ids = $request->post('ids', null);
        if(!$ids) {
            return response()->json([
                'status' => 'error',
                'message' => __('There are no ids for add item.'),
            ]);
        }
        $idArray = explode(',', $ids);
        foreach($idArray as $id) {
            DB::table('real_estate_offer_components')->insert([
                'offer_id' => $realEstateOffer->id,
                'real_estate_id' => $id
            ])
            ;
        }
        return redirect(route('realEstateOffers.edit', [$realEstateOffer->id]));
    }

    /**
     * @param Request $request
     * @return Application|JsonResponse|Redirector|RedirectResponse
     */
    public function createWithItems(Request $request): JsonResponse|Redirector|RedirectResponse|Application
    {
        $ids = $request->post('ids', null);
        if(!$ids) {
            return response()->json([
                'status' => 'error',
                'message' => __('There are no ids for createWithItems.'),
            ]);
        }

        // megkeruljuk a sajat validalasi szabajainkat es szandekosan mentunk kliens es nyelv nelkul
        $realEstateOffer = new RealEstateOffer();
        $realEstateOffer->created_by_id = Auth::user()->id;
        $realEstateOffer->offer_status_enum = RealEstateOfferStatusEnum::vazlat;
        $realEstateOffer->name = 'Created from real estate selection';
        $realEstateOffer->client_id = null;
        $realEstateOffer->language_enum = null;
        $realEstateOffer->save();

        // add items
        $idArray = explode(',', $ids);
        foreach($idArray as $id) {
            DB::table('real_estate_offer_components')->insert([
                'offer_id' => $realEstateOffer->id,
                'real_estate_id' => $id
            ])
            ;
        }

        return redirect(route('realEstateOffers.edit', [$realEstateOffer->id]));
    }

    /**
     * @param int $offerId
     * @return RedirectResponse|Redirector
     */
    public function clone(int $offerId): Redirector|RedirectResponse
    {
        $clone = RealEstateOffer::deepClone($offerId);
        return redirect(route('realEstateOffers.edit', [$clone->id]));
    }

    /**
     * @param RealEstateOffer $realEstateOffer
     * @return RedirectResponse|Redirector
     */
    public function createRouteFromOffer(RealEstateOffer $realEstateOffer): Redirector|RedirectResponse
    {
        $realEstateOffer->load('realEstates');
        $route = new Route();

        $route->offer_id = $realEstateOffer->id;
        $route->client_id = $realEstateOffer->client_id;
        $route->presenter_id = $realEstateOffer->created_by_id;

        $route->save();
        $itemIndex = 1;
        foreach($realEstateOffer->realEstates as $realEstate) {
            $routeComponent = new RouteComponent();
            $routeComponent->route_id = $route->id;
            $routeComponent->real_estate_id = $realEstate->id;
            $routeComponent->position = $itemIndex++;
            $route->routeComponents->push($routeComponent);
        }
        $route->push();
        return redirect(route('realEstateRoutes.edit', [$route->id]));
    }

    /**
     *  HTML and PDF offer generate
     *
     * @param Request $request
     * @param RealEstateOffer $realEstateOffer
     * @param $pdf
     * @return Application|Factory|ContractView|Response|string
     * @throws Throwable
     */
    public function printableDatapage(Request $request, RealEstateOffer $realEstateOffer, $pdf): ContractView|Factory|Response|string|Application
    {
        // RealEstateOffer
        $realEstateOffer = RealEstateOffer::find($realEstateOffer->id)->load('realEstates');
        if($realEstateOffer->realEstates->count() < 1) {
            return view('PrintableDatapages.errorPage', [
                'message' => 'There are no items in the offer! Unable to print the document.',
            ]);
        }
        // Ezzel modosithato ideiglenesen a pdf nyelve (az ajanlat nyelve mas, mint a weboldal aktualis nyelve)
        $pdf_language = $realEstateOffer->language_enum === 1 ? 'en' : 'hu';
        App::setLocale($pdf_language);
        // Response HTML
        if($pdf === "0") {
            return view('RealEstateOffer.printableDatapage.printableDatapageRealEstateOfferForHtml', [
                'realestateoffer' => $realEstateOffer,
                'locale' => $pdf_language,
            ])->render();
        }
        // If file exists delete it
        if (file_exists('offers' . $realEstateOffer->id . '.pdf')) {
            unlink('offers' . $realEstateOffer->id . '.pdf');
        }
        $htmlforpdf = view('RealEstateOffer.printableDatapage.printableDatapageRealEstateOfferForPdfGeneration', [
            'realestateoffer' => $realEstateOffer,
            'locale' => $pdf_language,
        ])->render();
        // Generate PDF and response it
        $snappy = App::make('snappy.pdf');
        $snappy->setTemporaryFolder(storage_path('tmp'));
        $snappy->setOption('enable-local-file-access', true);
        $snappy->setOption('dpi', 72);
        $snappy->setOption('disable-smart-shrinking', true);
        $snappy->setOption('page-size', 'A4');
        $snappy->setOption('zoom', 1);
        $snappy->setOption('margin-top', '8mm');
        $snappy->setOption('margin-left', '8mm');
        $snappy->setOption('margin-right', '8mm');
        $snappy->setOption('margin-bottom', '8mm');
        // $pdf->setOption('header-html', $header);
        // $pdf->setOption('footer-html', $footer);
        $snappy->generateFromHtml($htmlforpdf, 'offers' . $realEstateOffer->id . '.pdf');
        return new Response(
            $snappy->getOutputFromHtml($htmlforpdf),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="offers' . $realEstateOffer->id . '.pdf"'
            )
        );
    }

    /**
     * Generalunk egy temporary url-t amit a usernek kikuldunk majd.
     *
     * @param $realEstateOfferId
     * @param $pdf
     * @return string
     * @throws Exception
     */
    public static function generateTemporaryUrl($realEstateOfferId, $pdf): string
    {
        /*
         * Egyedi azonosito 10 tagu + utana az egyedi vedett url
         */
        $bytes = random_bytes(10);
        $unique_id = (bin2hex($bytes));
        /*
         * adatbazisba elmentjuk a friss 10 tagu egyedi azonositot az  offer_id-hoz
         */
        DB::table('real_estate_offers_temporary_url')->updateOrInsert(
            [
                'offer_id' => $realEstateOfferId,
                'pdf' => $pdf
            ],
            [
                'offer_id' => $realEstateOfferId,
                'unique_id' => $unique_id,
                'pdf' => $pdf
            ]
        )
        ;
        /*
         * URL generalasa
         */
        return URL::temporarySignedRoute("validaterealestateofferurl", now()->addDays(10), ['uniqueId' => $unique_id]);
    }

    /**
     * @param int $offerId
     * @return Application|Factory|ContractView|RedirectResponse
     */
    public function sendmailPage(int $offerId)
    {
        $realEstateOffer = RealEstateOffer::find($offerId);
        // kötelező adat: az ajánlathoz kapcsolt kliens, enélkül nem mehet a küldés:
        if(is_null($realEstateOffer->client_id)) {
            return redirect()->back()->withErrors(['msg' => 'No client selected.']);
        }
        $mailSenderData = new OfferMailSenderData();
        $mailSenderData->offerId = $offerId;
        // alábbiak default értékek, melyeket felül lehet bírálni bizonyos mértékig a form oldalon:
        // A feladót nem lehet csak úgy változtatgatni (email küldési szabályok, spam, stb)
        $mailSenderData->sender = Auth::user()->email ?? env('MAIL_FROM_ADDRESS');
        // Feladó kizárólag @realhome.hu -ról küldhet e-mailt
        $senderCheck = true;
        $mailArray = explode('@', $mailSenderData->sender);
        $domain = array_pop($mailArray);
        if($domain !== '@realhome.hu') {
            $senderCheck = false;
        }
        $mailSenderData->cc = '';
        $mailSenderData->target = $realEstateOffer->client->contact_email || '';
        $mailSenderData->subject = 'Real Home - ' . __('messages.sendmail_offer_subject_snippet') . ' ' . date('Y-m-d');
        // $mailFormats = ['HTML'];
        return view('RealEstateOffer.mail.offerMailSender', [
            'record' => $mailSenderData,
            'senderCheck' => $senderCheck,
            // 'mailFormats' => $mailFormats,
        ]);
    }

    /**
     * @param Request $request
     * @param $realEstateOfferId
     * @return Application|RedirectResponse|Redirector
     */
    public function sendmail(Request $request, $realEstateOfferId)
    {
        SendRealEstateOfferEmailJob::dispatch($request->all(), $realEstateOfferId, $request->getHttpHost())->onQueue('sendEmail');
        return redirect(route('realEstateOffers.edit', [$realEstateOfferId]));
    }

    /**
     * Add client to offer
     * @param Request $request
     * @return RedirectResponse
     */
    public function addClientToOffer(Request $request): RedirectResponse
    {
        try {
            $offer = RealEstateOffer::findOrFail($request->offerId);
            $offer->client_id = $request->client_id;
            $offer->push();
        } catch (ModelNotFoundException $exception) {
            echo $exception->getMessage();
        }
        return redirect()->back();
    }

    /**
     * Ha valid url keres erkezik be (temporary) akkor kiszolgaljuk az ugyfelet
     * @param $unique
     * @return string|StreamedResponse|void
     */
    public function validateUrl($unique)
    {
        // A unique_id-hez tartozo offer lekerdezese
        $offerTemporary = DB::table('real_estate_offers_temporary_url')->where('unique_id', $unique)->first();

        if(!empty($offerTemporary)) {
            $realEstateOffer = RealEstateOffer::find($offerTemporary->offer_id)->load('realEstates');
            if($realEstateOffer->realEstates->count() < 1) {
                return view('PrintableDatapages.errorPage', [
                    'message' => 'There are no items in the offer! Unable to print the document.',
                ]);
            }
            // Ezzel modosithato ideiglenesen a pdf nyelve (az ajanlat nyelve mas, mint a weboldal aktualis nyelve)
            $pdf_language = $realEstateOffer->language_enum === 1 ? 'en' : 'hu';
            App::setLocale($pdf_language);
            // Response HTML
            if($offerTemporary->pdf !== 1) {
                return view('RealEstateOffer.printableDatapage.printableDatapageRealEstateOfferForHtml', [
                    'realestateoffer' => $realEstateOffer,
                    'locale' => $pdf_language,
                ])->render();
            }
            // If file exists delete it
            if (file_exists('offers' . $realEstateOffer->id . '.pdf')) {
                unlink('offers' . $realEstateOffer->id . '.pdf');
            }
            $htmlforpdf = view('RealEstateOffer.printableDatapage.printableDatapageRealEstateOfferForPdfGeneration', [
                'realestateoffer' => $realEstateOffer,
                'locale' => $pdf_language,
            ])->render();
            // Generate PDF and response it
            $snappy = App::make('snappy.pdf');
            $snappy->setTemporaryFolder(storage_path('tmp'));
            $snappy->setOption('enable-local-file-access', true);
            $snappy->setOption('dpi', 72);
            $snappy->setOption('disable-smart-shrinking', true);
            $snappy->setOption('page-size', 'A4');
            $snappy->setOption('zoom', 1);
            $snappy->setOption('margin-top', '8mm');
            $snappy->setOption('margin-left', '8mm');
            $snappy->setOption('margin-right', '8mm');
            $snappy->setOption('margin-bottom', '8mm');
            // $pdf->setOption('header-html', $header);
            // $pdf->setOption('footer-html', $footer);
            $snappy->generateFromHtml($htmlforpdf, 'offers' . $realEstateOffer->id . '.pdf');
            return new Response(
                $snappy->getOutputFromHtml($htmlforpdf),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="offers' . $realEstateOffer->id . '.pdf"'
                )
            );
        }
    }

    public function clearFilters(Request $request){
        $this->clearFiltersFromSession();
        return redirect(route('realEstateOffers.index'));
    }
}
