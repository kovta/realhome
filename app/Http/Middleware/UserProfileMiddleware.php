<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Guard;
use Closure;

class UserProfileMiddleware
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
        if (Auth::user() == null ) {
            return redirect(route('login'));
        }

        $id = (is_object($request->user)) ? $request->user->id : ($request->user*1);
        if (Auth::user()->id != $id) {
            abort(403, 'Ez nem a Te profilod!');
        }

        return $next($request);
    }
}
