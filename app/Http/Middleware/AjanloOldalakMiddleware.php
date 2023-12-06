<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Guard;
use Closure;

class AjanloOldalakMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $offerPage = ($request->input('offerPage', null)*1);
        if ( (\Request::route()->getName() == 'realEstatePublicList') && ($offerPage != null) && (Auth::user() == null) ){
            return abort(403,'Az ajánló oldalakhoz be kell jelentkezned!');
        }
        return $next($request);
    }
}
