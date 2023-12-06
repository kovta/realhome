<?php

namespace App\Http\Controllers;

use App;
use App\Http\Traits\FilterableListTrait;
use App\Jobs\SendRealEstateRouteEmailJob;
use App\Models\Client;
use App\Models\Enum\UserTypeEnum;
use App\Models\RealEstateOffer;
use App\Models\Route;
use App\Models\RouteComponent;
use App\Models\RouteMailSenderData;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;
use Yajra\DataTables\DataTables;

class RealEstateRouteController extends Controller
{
    use FilterableListTrait;

    public bool $filterSavedToSession = false;
    public string $filterSessionKey = 'RouteListFilter';
    public array $filterFields = [
        'client_id',
    ];
    public array $numberFilterFields = [];

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request): Factory|View
    {
        $clients = Client::all();
        $notused = new Collection();
        $filters = $this->processFilters($notused, $request);
        return view('Route.list', [
            'filters' => $filters,
            'clients' => $clients,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param Route $route
     * @return Response
     */
    public function show(Route $route): Response
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Route $route
     * @return Application|Factory|ContractsView
     */
    public function edit(Route $route): ContractsView|Factory|Application
    {
        // TODO ITT TARTOK:
        $clients = array();
        $coWorkers = array();
        $clientAll = Client::all();
        foreach($clientAll as $item)
        {
            if(optional($item->user)->type_enum === UserTypeEnum::ugyfel)
            {
                $clients[] = $item;
            }
            if(optional($item->user)->type_enum === UserTypeEnum::adminuser)
            {
                $coWorkers[] = $item;
            }
        }
        return view('Route.datapage.edit', [
            'record' => $route,
            'clients' => $clients,
            'coWorkers' => $coWorkers,
            'noClient' => $route->client,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Route $route
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Route $route)
    {
        $rules = Route::validationRules();
        $request->validate($rules);

        $entity = $route;
        $data = $request->only($entity->getFillable());
        $entity->fill($data);
        $entity->save();

        if (is_array($request->componentId) && count($request->componentId) > 0){
            foreach ($request->componentId as $componentId){
                DB::table('route_components')->where('id', '=', $componentId)
                    ->update([
                        'visit_time' => $request->component_visit_time[$componentId],
                        'comment' => $request->component_comment[$componentId],
                        ]);
            }
        }

        return redirect(route('realEstateRoutes.index'));

    }
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $entity = Route::find($id);
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
        $q = Route::query()->with('offer','client');
        $tableColumnName = 'updated_at';
        $direction = 'desc';
        if (!empty($request->order) && $request->has('order')) {
            // több sorbarendezés is beállítható (a foreach ezért van)
            foreach($request->order as $tableColumnKey => $orderSettings) {
                if($tableColumnKey === 1) {
                    $tableColumnName = 'offer_name';
                }
                if($tableColumnKey === 2) {
                    $tableColumnName = '';
                }
                if($tableColumnKey === 3) {
                    $tableColumnName = 'updated_at';
                }
                if(!empty($request->order[$tableColumnKey]['dir'])) {
                    $direction = $request->order[$tableColumnKey]['dir'];
                }
                $q->orderBy($tableColumnName, $direction);
            }
        }
        if (request()->has('filter')) {
            try {
                $filters = collect(request()->get('filter'));
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                dd($e->getMessage());
            }
            $this->processFilters($filters, $request);
            if($filters->get('client_id') !== null){
                // $q = Route::query()->with('offer','client')->where('client_id', '=', $filters->get('client_id'));
                $q->where('client_id', '=', $filters->get('client_id'));
            }
        }
        return DataTables::of($q)
            ->addColumn('name_url', function(Route $rec){ return route('realEstateRoutes.edit', [$rec->id]);} )
            ->addColumn('offer_name', function(Route $rec){ return !is_null($rec->offer) ? $rec->offer->name : '-';} )
            ->addColumn('client_name', function(Route $rec){ return !is_null($rec->client) ? $rec->client->name : '-';} )
            ->addColumn('created_at', function(Route $rec){ return !is_null($rec->created_at) ? $rec->created_at : '-';} )
            ->make(true);
    }
    /**
     * @param Route $route
     * @return Factory|View
     */
    public function routeItemList(Route $route)
    {
        $route->load(['routeComponents' => function ($q) {
            $q->orderBy('position', 'asc');
        }]);
        return view('Route.datapage.datapage-route-item-list', [
            'record' => $route,
        ]);
    }
    /**
     * @param Request $request
     * @param Route $route
     * @return JsonResponse
     */
    public function deleteItems(Request $request, Route $route): JsonResponse
    {
        $ids = $request->post('ids');
        if (!$ids){
            return response()->json([
                'status' => 'error',
                'message' => __('messages.crud_no_selection_warning_text'),
            ]);
        }
        $idArray = explode(',', $ids);
        DB::table('route_components')
            ->where('route_id', '=', $route->id)
            ->whereIn('id', $idArray)->delete();

        Route::reindexItems($route->id);

        return response()->json([
            'status' => 'ok',
            'message' => "$ids are deleted"
        ]);
    }
    /**
     * @param Request $request
     * @param Route $route
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function addItem(Request $request, Route $route)
    {
        $realEstateIds = $request->post('ids', null);
        if (!$realEstateIds){
            return response()->json([
                'status' => 'error',
                'message' => __('There are no $realEstateIds for add item.'),
            ]);
        }

        // berakjuk az elemeket a legnagyobb poz utanira....
        $maxPosition = DB::table('route_components')
                            ->where('route_id', '=', $route->id)
                            ->max('position');

        $idArray = explode(',', $realEstateIds);
        foreach ($idArray as $id) {
            $routeComponent = new RouteComponent();
            $routeComponent->route_id = $route->id;
            $routeComponent->real_estate_id = $id;
            $routeComponent->position = ++$maxPosition;
            $route->routeComponents->push($routeComponent);
        }
        $route->push();

        Route::reindexItems($route->id);

        return redirect(route('realEstateRoutes.edit', [$route->id]));
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dragReorderItems(Request $request): JsonResponse
    {
        $routeId = $request->post('routeId', null);
        $routeComponentId = $request->post('itemId', null);
        $oldIndex = $request->post('oldIndex', null);
        $newIndex = $request->post('newIndex', null);
        if ($oldIndex == null || $newIndex == null){
            return response()->json([
                'status' => 'error',
                'message' => __('id, oldIndex and newIndex required for sortItems'),
            ]);
        }

        // mivel ez felhuzza az osszes elemet egy rendezett kulcsu collectionbe, rendbe is teszi az indexeket
        // de hozzaadasnal es torlesnel reindexalni kell!
        $route = Route::find($routeId)->load(['routeComponents' => function ($q) {
            $q->orderBy('position', 'asc');
        }]);
        //  ha a route
        if ($route === null){
            return response()->json([
                'status' => 'error',
                'message' => __('no route found'),
            ]);
        }
        //  0 vagy 1 route komponens eseten nincs mit atrendezni (500-as hibara futna)
        if (!is_array($route->routeComponents) && count($route->routeComponents) < 2) {
            return response()->json([
                'status' => 'error',
                'message' => __('not able to reorder only one route component'),
            ]);
        }
        // csak a ket erintett elemhez nyulunk
        $item_1 = $route->routeComponents->pull($oldIndex);
        $item_2 = $route->routeComponents->pull($newIndex);
        $route->routeComponents->put($newIndex, $item_1);
        $route->routeComponents->put($oldIndex, $item_2);
        $item_1->position = $newIndex+1;
        $item_1->save();
        $item_2->position = $oldIndex+1;
        $item_2->save();

        return response()->json([
            'status' => 'ok',
            'message' => "$routeComponentId item moved to $oldIndex -> $newIndex position."
        ]);
    }
    /**
     * @param int $routeId
     * @return JsonResponse
     */
    public function reindexItems(int $routeId): JsonResponse
    {
        if (Route::reindexItems($routeId)) {
            return response()->json([
                'status' => 'ok',
                'message' => "Route($routeId) items are reindexed."
            ]);
        }
    }
    /**
     * "útiterv nyomtatás": pdf gyártás
     *
     * @param Request $request
     * @param Route $route
     * @return Application|ContractsView|Factory|Response|string
     * @throws Throwable
     */
    public function printableDatapage(Request $request, Route $route): Factory|ContractView|Response|string|Application
    {
        $route = Route::find($route->id);
        $route->load(['routeComponents' => function ($q) {
            $q->orderBy('position', 'asc');
        }]);
        $route->load('client');
        if ($route->routeComponents->count() < 1){
            return view('PrintableDatapages.errorPage', [
                'message' => 'There are no items in the route! Unable to print the document.',
            ]);
        }
        // Ezzel modosithato ideiglenesen a pdf nyelve (az ajanlat nyelve mas, mint a weboldal aktualis nyelve)
        // $pdf_language = $route->language_enum === 1 ? 'en' : 'hu';
        // App::setLocale($pdf_language);
        // Response HTML
        if($request->has('preview')) {
            return view('Route.printableDatapage.printableDatapage', [
                'route' => $route,
                'locale' => 'hu',
            ])->render();
        }
        // If file exists delete it
        if (file_exists('route-' . $route->id . '.pdf')) {
            unlink('route-' . $route->id . '.pdf');
        }
        //
        // TODO:
        //  Alábbi view-ra nincs speciálisan elrendezett és üf által felülvizsgált, megfelelő pdf
        //  Ezért majd ezeket egyeztetni kell és csinálni belőle egy új blade fajlt.
        //  ehhez létrehoztam már egyet, a többi mellett ".bak" kiterjesztéssel
        //
        $htmlforpdf = view('Route.printableDatapage.printableDatapage', [
            'route' => $route,
            'locale' => 'hu',
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
        $snappy->generateFromHtml($htmlforpdf, 'route-' . $route->id . '.pdf');
        return new Response(
            $snappy->getOutputFromHtml($htmlforpdf),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="route-' . $route->id . '.pdf"'
            )
        );
    }
    /**
     * TODO: szerintem ezt már semmi sem használja (mert máshol van megvalósítva
     * "ajánlatként nyomtatás" pdf generálás:
     *
     * @param Request $request
     * @param Route $route
     * @return Application|ContractsView|Factory|StreamedResponse|string
     * @throws Throwable
    public function printableDatapageRealEstate(Request $request, Route $route) {
        $route = Route::find($route->id)->load('routeComponents')->load('client');
        if ($route->routeComponents->count() < 1){
            return view('printableDatapageRealEstate.errorPage', [
                'message' => 'There are no items in the route! Unable to print the document.',
            ]);
        }

        $html = view('Route.printableDatapage.printableDatapageRealEstate', [
            'route' => $route,
            'locale' => 'hu',
        ])->render();

        if($request->has('preview')) {
            return $html;
        }
        return response()->streamDownload(function() use($html) {
            echo app('snappy.pdf')->getOutputFromHtml($html);
        }, 'datapages-route-'.$route->id.'.pdf', ['Content-Type' => 'application/pdf']);
    }
    */

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function clearFilters(Request $request): Redirector|RedirectResponse|Application
    {
        $this->clearFiltersFromSession();
        return redirect(route('realEstateRoutes.index'));
    }

    /**
     * Generalunk egy temporary url-t amit a usernek kikuldunk majd.
     *
     * @param $realEstateRouteId
     * @param $pdf
     * @return string
     * @throws Exception
     */
    public static function generateTemporaryUrl($realEstateRouteId, $pdf): string
    {
        /*
         * Egyedi azonosito 10 tagu + utana az egyedi vedett url
         */
        $bytes = random_bytes(10);
        $unique_id = (bin2hex($bytes));
        /*
         * adatbazisba elmentjuk a friss 10 tagu egyedi azonositot az  offer_id-hoz
         */
        DB::table('real_estate_routes_temporary_url')->updateOrInsert(
            [
                'route_id' => $realEstateRouteId,
                'pdf' => $pdf
            ],
            [
                'route_id' => $realEstateRouteId,
                'unique_id' => $unique_id,
                'pdf' => $pdf
            ]
        )
        ;
        /*
         * URL generalasa
         */
        return URL::temporarySignedRoute("validaterealestaterouteurl", now()->addDays(10), ['uniqueId' => $unique_id]);
    }
    /**
     * @param int $route
     * @return Application|Factory|ContractView|RedirectResponse
     */
    public function sendmailPage(int $route): ContractView|Factory|RedirectResponse|Application
    {
        $realEstateRoute = Route::find($route);
        // kötelező adat: az útvonalhoz kapcsolt kliens, enélkül nem mehet a küldés:
        if(is_null($realEstateRoute->client_id)) {
            return redirect()->back()->withErrors(['msg' => 'No client selected.']);
        }
        $mailSenderData = new RouteMailSenderData();
        $mailSenderData->route_id = $route;
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
        $mailSenderData->target = $realEstateRoute->client->contact_email || '';
        $mailSenderData->subject = 'Real Home - ' . __('messages.sendmail_route_subject_snippet') . ' ' . date('Y-m-d');
        // $mailFormats = ['HTML'];
        return view('Route.mail.routeMailSender', [
            'record' => $mailSenderData,
            'senderCheck' => $senderCheck,
            // 'mailFormats' => $mailFormats,
        ]);
    }

    /**
     * Ha valid url keres erkezik be (temporary) akkor kiszolgaljuk az ugyfelet
     * @param $unique
     * @return string|StreamedResponse|void
     */
    public function validateUrl($unique)
    {
        // A unique_id-hez tartozo route lekerdezese
        $routeTemporary = DB::table('real_estate_routes_temporary_url')->where('unique_id', $unique)->first();

        if(!empty($routeTemporary)) {
            // $realEstateOffer = RealEstateOffer::find($routeTemporary->route_id)->load('realEstates');
            $route = Route::find($routeTemporary->route_id);
            $route->load(['routeComponents' => function ($q) {
                $q->orderBy('position', 'asc');
            }]);
            $route->load('client');
            if ($route->routeComponents->count() < 1){
                return view('PrintableDatapages.errorPage', [
                    'message' => 'There are no items in the route! Unable to print the document.',
                ]);
            }

            // pdf vagy html kell kimenetre?
            // HTML generálása view:
            if($routeTemporary->pdf !== 1) {
                return view('Route.printableDatapage.printableDatapage', [
                    'route' => $route,
                    'locale' => 'hu',
                ])->render();
            }
            // PDF generalasa es a pdf letöltés indítása
            // If file exists delete it
            if (file_exists('route-' . $route->id . '.pdf')) {
                unlink('route-' . $route->id . '.pdf');
            }
            // TODO: ha már lesz saját pdf blade/view-ja, akkor átírni arra:
            $htmlforpdf = view('Route.printableDatapage.printableDatapage', [
                'route' => $route,
                'locale' => 'hu',
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
            $snappy->generateFromHtml($htmlforpdf, 'route-' . $route->id . '.pdf');
            return new Response(
                $snappy->getOutputFromHtml($htmlforpdf),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="route-' . $route->id . '.pdf"'
                )
            );
        }
    }

    /**
     * @param Request $request
     * @param $realEstateRouteId
     * @return Application|RedirectResponse|Redirector
     */
    public function sendmail(Request $request, $realEstateRouteId): Redirector|RedirectResponse|Application
    {
        SendRealEstateRouteEmailJob::dispatch($request->all(), $realEstateRouteId, $request->getHttpHost())->onQueue('sendEmail');
        return redirect(route('realEstateRoutes.edit', [$realEstateRouteId]))->with('success', __('E-mail created successfully.'));
    }

}
