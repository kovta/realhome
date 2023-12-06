<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserPassword;
use App\Models\Client;
use App\Models\Enum\UserTypeEnum;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class ClientRoleController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $client = Client::find($request->id);
        return view('Client.datapage.role.edit',['client' => $client]);
    }

    /**
     *  Update user password than send new password with email
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        /*
         *  Define variable
         */
        $creator = Auth::user();
        $user = User::where('id', '=', $request->user_id)->first();
        /*
         *  Create new password
         */
        $randomPassword = Str::random(8);
        $user->password = Hash::make($randomPassword);
        $user->save();
        /*
        *  Send mail to user
        */
        SendUserPassword::dispatch($user, $creator, $randomPassword)->onQueue('resetpassword');

        return redirect(route('clients.view',[$user->client->id]));
    }

    /**
     * Create new user, than send new password with email
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        /*
         *  Define variable
         */
        $creator = Auth::user();
        $client = Client::where('id', '=', $request->client_id)->first();
        $selectedRole = Role::findByName('clients');
        /*
         *  Create new user
         */
        $user = new User();
        $user->name = $client->name;
        $user->email = $client->email;
        $randomPassword = Str::random(8);
        $user->password = Hash::make($randomPassword);
        $user->type_enum = UserTypeEnum::ugyfel;
        $user->syncRoles($selectedRole->name);
        $user->save();
        /*
         *  Create client user relationship
         */
        $client->user_id = $user->id;
        $client->save();
        /*
         *  Send mail to user
         */
        SendUserPassword::dispatch($user, $creator, $randomPassword)->onQueue('resetpassword');

        return redirect(route('clients.view',[$request->client_id]));
    }
}
