<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Guard;
use Closure;

class AdminMiddleware
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

        if (Auth::user()->hasRole('clients') ) {
            abort(403, 'A kért oldal tiltott az ügyfél felhasználóknak!');
        }

        return $next($request);
    }
}
