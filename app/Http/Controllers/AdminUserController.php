<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserPassword;
use App\Models\Client;
use App\Models\Enum\UserTypeEnum;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $users = User::where('type_enum','=', UserTypeEnum::adminuser)->get();
        return view('AdminUser.list', ['records' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|Factory|Application
    {
        $user = new User();
        $client = new Client();
        $client->user = $user;
        $roles = Role::all()->sortBy('name');
        // fejleszto usert csak fejleszto tud letrehozni...
        if (!Auth::user()->hasRole('developers')){
            $roles = $roles->filter(function ($value) {
                return $value->name !== 'developers';
            });
        }
        return view('AdminUser.datapage.create', [
            'record' => $client,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
        ]);
        $validator->validate();
        $creator = Auth::user();
        $selectedRole = Role::findById($request->role);
        $randomPassword = Str::random(8);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($randomPassword);
        $user->type_enum = UserTypeEnum::adminuser;
        $user->syncRoles($selectedRole->name);
        $user->save();
        /*
         * Send mail to user
         */
        SendUserPassword::dispatch($user, $creator, $randomPassword);
        return redirect(route('adminusers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id): Factory|View
    {
        $user = User::find($id);
        $roles = Role::all()->sortBy('name');
        // fejleszto usert csak fejleszto tud letrehozni...
        if (!Auth::user()->hasRole('developers')){
            $roles = $roles->filter(function ($value) {
                return $value->name !== 'developers';
            });
        }
        return view('AdminUser.datapage.edit', [
            'record' => $user,
            'roles' => $roles,
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id): Redirector|RedirectResponse
    {
        $request->validate(User::validationRules());

        // roles
        if (Auth::user()->hasRole('developers|administrators')){
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $selectedRole = Role::findById($request->role);
            $user->syncRoles( $selectedRole->name );
            $user->save();
            return redirect(route('adminusers.index'));
        }

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id): Redirector|RedirectResponse
    {
        // a usert kell torolni, mert a model szerint a userhez tartozik a kliens
        $user = User::findOrFail($id);
        //  ez törli a törlendő userhez tartozó role-okat
        $user->syncRoles([]);
        $user->delete();
        return redirect(route('adminusers.index'));
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function userProfile(User $user): Factory|View
    {
        if (!Auth::user()->id == $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::all()->sortBy('name');
        return view('AdminUser.datapage.edit', [
            'record' => $user,
            'roles' => $roles,
        ]);
    }


    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function showChangePasswordForm(): \Illuminate\Contracts\View\View|Factory|Application
    {
        return view('AdminUser.changepassword');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePassword(Request $request): RedirectResponse
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", __('messages.change_password_err_bad_current_password') );
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error", __('messages.change_password_err_new_pass_same_current_password') );
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required', //|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", __('messages.change_password_msg_success') );
    }

}
