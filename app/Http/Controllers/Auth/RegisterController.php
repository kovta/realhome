<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use App\Models\Enum\ClientSourceEnum;
use App\Models\Enum\UserTypeEnum;
use App\Models\Recapctha;
use App\Models\TextContentPage;
use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = '/mustvalidateemail';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'preferred_contact' => ['required'],
            'acceptTerms' => ['required'],
            'g_recaptcha_response' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User|RedirectResponse
     */
    protected function create(array $data): User|RedirectResponse
    {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->syncRoles('clients');
            $user->type_enum = UserTypeEnum::ugyfel;
            $userSaved = $user->save();
            if ($userSaved) {
                $client = new Client();
                $client->user_id = $user->id;
                $client->name = $data['name'];
                $client->email = $data['email'];
                $client->phone_1 = $data['phone_1'];
                $client->preferred_contact_enum = $data['preferred_contact'];//ClientPreferredContactEnum
                $client->source_enum = ClientSourceEnum::sajatWeb;
                $client->save();
            }
            else {
                return redirect()->back('404');
            }
            return $user;
    }


    /**
     * @return Factory|View|Application
     * @throws Exception
     */
    public function showRegistrationForm(): Factory|View|Application
    {
        $page = TextContentPage::where('inner_name', '=', 'register')->first();
        if ($page == null){
            throw new Exception('There is no TextContentPage record for this page!');
        }
        $title = $page->translate(App::getLocale())->title;
        $content = $page->translate(App::getLocale())->content;
        return view('auth.register', [
            'title' => $title,
            'content' => $content,
        ]);
    }

}
