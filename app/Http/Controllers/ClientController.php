<?php

namespace App\Http\Controllers;

use App\Http\Traits\FilterableListTrait;
use App\Models\Client;
use App\Models\Enum\ClientPreferredContactEnum;
use App\Models\Enum\ClientRequiredSchoolEnum;
use App\Models\Enum\ClientSourceEnum;
use App\Models\Enum\ClientStatusEnum;
use App\Models\Enum\UserTypeEnum;
use App\Models\Enum\RealEstateStatusEnum;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{

    use FilterableListTrait;

    public $filterSavedToSession = false;
    public $filterSessionKey = 'ClientListFilter';
    public $filterFields = [
        'name',
        'client_id',
        'partner',
        'status'
    ];
    public $numberFilterFields = [];


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $notused = new Collection();
        $filters = $this->processFilters($notused, $request);
        $clients = Client::all();
        return view('Client.list', [
            'filters' => $filters,
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
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

        $entity = new Client();
        $user = new User();
        $entity->user = $user;

        $statuses = ClientStatusEnum::toSelectValueSet([ old('status_enum', $entity->status_enum) ]);
        $preferredContacts = ClientPreferredContactEnum::toSelectValueSet([ old('preferred_contact_enum', $entity->preferred_contact_enum) ]);
        $sources = ClientSourceEnum::toSelectValueSet([ old('source_enum', $entity->source_enum) ]);
        $requiredSchools = ClientRequiredSchoolEnum::toSelectValueSet([ old('required_school_enum', $entity->required_school_enum) ]);
        return view('Client.datapage.create', [
            'record' => $entity,
            'statuses' => $statuses,
            'preferredContacts' => $preferredContacts,
            'sources' => $sources,
            'coWorkers' => $record,
            'requiredSchools' => $requiredSchools,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $rules = Client::validationRules();
        $request->validate($rules);

        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->broker_id = Auth::user()->id;
        $data = $request->only($client->getFillable());
        $client->fill($data);
        $client->push();
        //  TODO Ugyfelnek ki kell kuldeni a jelszot emailben.
//        $user->password = 'x';
        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return void
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Application|Factory|View
     */
    public function edit(Client $client)
    {
        $record = array();
        $coWorkers = User::all();
        foreach($coWorkers as $item)
        {
            if($item->type_enum == UserTypeEnum::adminuser)
            {
                $record[] = $item;
            }
        }
        $statuses = ClientStatusEnum::toSelectValueSet([ old('status_enum', $client->status_enum) ]);
        $preferredContacts = ClientPreferredContactEnum::toSelectValueSet([ old('preferred_contact_enum', $client->preferred_contact_enum) ]);
        $sources = ClientSourceEnum::toSelectValueSet([ old('source_enum', $client->source_enum) ]);
        $requiredSchools = ClientRequiredSchoolEnum::toSelectValueSet([ old('required_school_enum', $client->required_school_enum) ]);
        return view('Client.datapage.edit', [
            'record' => $client,
            'statuses' => $statuses,
            'preferredContacts' => $preferredContacts,
            'sources' => $sources,
            'coWorkers' => $record,
            'requiredSchools' => $requiredSchools,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Client $client)
    {
        $rules = Client::validationRules($client->id);
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect(route('clients.edit', [$client->id]))->withErrors($validator)->withInput();
        }
        $request->validate($rules);

        $entity = $client->load('user');
        $data = $request->only($entity->getFillable());
        $entity->fill($data);

        $entity->name = $request->name;
        $entity->email = $request->email;
        $entity->broker_id = $request->broker_id;

        $entity->push();
        return redirect(route('clients.view', [$client->id]));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request)
    {
        if (!empty($request->id)) {
            DB::table('clients')->where('id', $request->id)->delete();
        }
        return redirect(route('clients.index'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function tableDataLoader(Request $request)
    {
        $q = Client::query();
        if(request()->has('filter')){
            $filters = collect(request()->get('filter'));
            $this->processFilters($filters, $request);

            if($filters->get('client_id') !== null){
                $q = $q->where('id', '=', ($filters->get('client_id')*1) );
            }

            if($filters->get('partner') !== null){
                $q = $q->where('partner', 'like', '%'.$filters->get('partner').'%');
            }

            if($filters->get('name') !== null){
                $q = $q->where('name', 'like', '%'.$filters->get('name').'%');
            }

            if($filters->get('status') == '1'){
                $q = $q->where('status_enum', '=', RealEstateStatusEnum::aktualis);
            }
        }
        return DataTables::of($q)
            ->addColumn('name_url', function(Client $rec){ return route('clients.view', [$rec->id]);} )
            ->addColumn('name', function(Client $rec){ return ($rec) ? $rec->name : '-';} )
            ->addColumn('email', function(Client $rec){ return ($rec->email) ? $rec->email : '-';} )
            ->make(true);
    }

    public function clearFilters(Request $request){
        $this->clearFiltersFromSession();
        return redirect(route('clients.index'));
    }

}
