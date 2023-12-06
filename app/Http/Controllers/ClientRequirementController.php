<?php

namespace App\Http\Controllers;

use App\Http\Traits\FilterableListTrait;
use App\Models\ClientRequirement;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Enum\UserTypeEnum;
use App\Models\Enum\RealEstateContractTypeEnum;
use App\Models\Enum\RealEstateKitchenTypeEnum;
use App\Models\Enum\RealEstateStatusEnum;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientRequirementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function index(Request $request)
    {
        $clientId = $request->input('client', null);
        $client = Client::find($clientId)->load('clientRequirement');
        Session::put('ClientRequirementController-clientId', $clientId);
        $route = ($client->clientRequirement != null) ? route('clientRequirements.edit', [$client->clientRequirement->id]) : route('clientRequirements.create');
        return redirect($route);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $clients = array();
        $coWorkers = Client::all();
        foreach($coWorkers as $item)
        {
            if(optional($item->user)->type_enum == UserTypeEnum::ugyfel)
            {
                $clients[] = $item;
            }
        }

        $clientRequirement = new ClientRequirement();
        $clientRequirement->client_id = Session::get('ClientRequirementController-clientId');
        $client = Client::find($clientRequirement->client_id);

        $statuses = RealEstateStatusEnum::toSelectValueSet([ old('status_enum', $clientRequirement->status_enum) ]);
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([ old('contract_type_enum', $clientRequirement->contract_type_enum) ]);
        $realEstateTypes = RealEstateType::all()->sortBy('name');
        $kitchenTypes = RealEstateKitchenTypeEnum::toSelectValueSet([null]);
        $currencies = Currency::all()->sortBy('iso_code');
        return view('ClientRequirement.datapage.create', [
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
     * Store a newly created ClientReqirement in storage.
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = ClientRequirement::validationRules();
        $request->validate($rules);

        $client_requirement = new ClientRequirement();
        $client_requirement->client_id = Session::get('ClientRequirementController-clientId');

        $data = $request->only($client_requirement->getFillable());

        foreach ($client_requirement->checkboxes as $checkbox){
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) {
                $data[$checkbox] = null;
            }
        }
        $client_requirement->fill($data);

        // ez a mezo mass filles, hogy legyen adat, de vegul kezzel mentjuk
        $kitchenTypeEnums = $client_requirement->kitchen_type_enums;
        unset($client_requirement->kitchen_type_enums);

        $client_requirement->save();

        DB::table('client_requirement_kitchen_types')->where('client_requirement_id', '=', $client_requirement->id)->delete();
        if(!empty($kitchenTypeEnums) && is_array($kitchenTypeEnums) && count($kitchenTypeEnums)>0 ) {
            foreach ($kitchenTypeEnums as $id) {
                DB::table('client_requirement_kitchen_types')->insert([
                    'client_requirement_id' => $client_requirement->id,
                    'kitchen_type_enum' => $id
                ]);
            }
        }

        return redirect(route('clients.edit', [$client_requirement->client->id]));
        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param ClientRequirement $clientRequirement
     * @return Response
     */
    public function show(ClientRequirement $clientRequirement)
    {
        //
    }

    /**
     * @param ClientRequirement $clientRequirement
     * @return Factory|\Illuminate\View\View
     */
    public function edit(ClientRequirement $clientRequirement)
    {
        $clients = array();
        $coWorkers = Client::all();
        foreach($coWorkers as $item)
        {
            if(optional($item->user)->type_enum == UserTypeEnum::ugyfel)
            {
                $clients[] = $item;
            }
        }

        $clientRequirement->load('client');
        // load kitchen_types
        $temp = DB::table('client_requirement_kitchen_types')
            ->where('client_requirement_id', '=', $clientRequirement->id)
            ->get();
        $selectedKitchenTypes = [];
        foreach ($temp as $item){
            $selectedKitchenTypes[] = $item->kitchen_type_enum;
        }

        $statuses = RealEstateStatusEnum::toSelectValueSet([$clientRequirement->status_enum]);
        $contractTypes = RealEstateContractTypeEnum::toSelectValueSet([$clientRequirement->contract_type_enum]);
        $realEstateTypes = RealEstateType::all()->sortBy('name');
        $kitchenTypes = RealEstateKitchenTypeEnum::toSelectValueSet($selectedKitchenTypes);
        $currencies = Currency::all()->sortBy('iso_code');
        return view('ClientRequirement.datapage.edit', [
            'record' => $clientRequirement,
            'client' => $clientRequirement->client,
            'statuses' => $statuses,
            'contract_types' => $contractTypes,
            'real_estate_types' => $realEstateTypes,
            'clients' => $clients,
            'kitchenTypes' => $kitchenTypes,
            'currencies' => $currencies,
        ]);
    }

    /**
     * @param Request $request
     * @param ClientRequirement $clientRequirement
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, ClientRequirement $clientRequirement)
    {
        $rules = ClientRequirement::validationRules();
        $request->validate($rules);

        $entity = $clientRequirement;
        $data = $request->only($entity->getFillable());

        foreach ($entity->checkboxes as $checkbox){
            if($request->input($checkbox) == FilterableListTrait::$threeSwitchIndifferent) {
                $data[$checkbox] = null;
            }
        }
        $entity->fill($data);

        // ez a mezo mass filles, hogy legyen adat a betoltesnel, de kezzel mentjuk, mert az enum nincs az adatbazisban
        $kitchenTypeEnums = $entity->kitchen_type_enums;
        unset($entity->kitchen_type_enums);

        $entity->save();

        if (is_array($kitchenTypeEnums) && count($kitchenTypeEnums)) {
            DB::table('client_requirement_kitchen_types')->where('client_requirement_id', '=', $entity->id)->delete();
            foreach ($kitchenTypeEnums as $id) {
                DB::table('client_requirement_kitchen_types')->insert([
                    'client_requirement_id' => $entity->id,
                    'kitchen_type_enum' => $id
                ]);
            }
        }

        return redirect(route('clients.edit', [$clientRequirement->client->id]));
        //return redirect()->back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->post('id');
        $entity = ClientRequirement::find($id);
        $entity->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "id=$id deleted"
        ]);
    }
}
