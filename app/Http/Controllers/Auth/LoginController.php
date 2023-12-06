<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TextContentPage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $page = TextContentPage::where('inner_name', '=', 'login')->first();
        if ($page == null){
            throw new \Exception('There is no TextContentPage record for this page!');
        }
        $title = $page->translate(App::getLocale())->title;
        $content = $page->translate(App::getLocale())->content;
        return view('auth.login', [
            'title' => $title,
            'content' => $content,
        ]);
    }



/*
    public function redirectPath()
    {
        if (Auth::user()->hasRole('clients') ) {
            return '/';
        }
        else {
            return '/admin';
        }
    }
*/
}
