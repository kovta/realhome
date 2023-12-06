<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserPassword;
use App\Models\Client;
use App\Models\Enum\ClientPreferredContactEnum;
use App\Models\Enum\ClientStatusEnum;
use App\Models\Enum\UserTypeEnum;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class ClientUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $record = array();
        $coWorkers = Client::all();
        foreach($coWorkers as $item) {
            if(optional($item->user)->type_enum == UserTypeEnum::ugyfel) {
                $record[] = $item;
            }
        }
        return view('ClientUser.list', ['records' => $record]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = new User();
        $user->roles->put(0, Role::findByName('clients'));
        $entity = new Client();
        $entity->user = $user;
        $roles = Role::all()->sortBy('name');
        return view('ClientUser.datapage.create', [
            'record' => $entity,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:users',           // required and must be unique in the table
        ]);
        $validator->validate();
        $creator = Auth::user();
        $selectedRole = Role::findByName($request->roles);

        /*
         * Create client
         */
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        if(!empty($request->phone_1)) {
            $client->phone_1 = $request->phone_1;
        }
        if(!empty($request->phone_2)) {
            $client->phone_2 = $request->phone_2;
        }
        $client->broker_id = $creator->id;

        if($request->user_create == "true") {
            /*
             * Create user with clients data
             */
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $randomPassword = Str::random(8);
            $user->password = Hash::make($randomPassword);
            $user->type_enum = UserTypeEnum::ugyfel;
            $user->syncRoles($selectedRole->name);
            $user->save();
            $client->user_id = $user->id;
            /*
             *  Send mail to user
             */
            SendUserPassword::dispatch($user, $creator, $randomPassword)->onQueue('generatedPassword');
        }
        $client->save();

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $client = Client::find($id);
        $roles = Role::all()->sortBy('name');
        return view('ClientUser.datapage.edit', [
            'record' => $client,
            'roles' => $roles,
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $defaultRole = 'clients';

        $client = Client::find($id);
        $client->phone_1 = $request->phone_1;
        $client->phone_2 = $request->phone_2;
        $client->save();

        // roles
        $user = User::find($client->user->id);
        $user->roles->put(0, Role::findByName($defaultRole));
        /*
        if (Auth::user()->hasRole('administrators')){
            $selectedRole = Role::findById($request->role);
            $user->syncRoles( $selectedRole->name );
        } else {
            $user->syncRoles($defaultRole);
        }
        */
        $user->save();
        return redirect(route('clientusers.index'));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        // a usert kell torolni, mert a model szerint a userhez tartozik a kliens
        $user = User::find($client->user->id);
        //  ez törli a törlendő userhez tartozó role-okat
        $user->syncRoles([]);
        $user->delete();
        return redirect(route('clientusers.index'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userProfile(User $user)
    {
        if(Auth::user()->id != $user->id) {
            return abort(403, 'Unauthorized action.');
        }

        $client = $user->client;
        $roles = Role::all()->sortBy('name');
        return view('ClientUser.datapage.edit', [
            'record' => $client,
            'roles' => $roles,
        ]);
    }


    public function showChangePasswordForm()
    {
        return view('ClientUser.changepassword');
    }


    public function changePassword(Request $request)
    {
        if(!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", __('messages.change_password_err_bad_current_password'));
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", __('messages.change_password_err_new_pass_same_current_password'));
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required', //|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", __('messages.change_password_msg_success'));
    }

}
