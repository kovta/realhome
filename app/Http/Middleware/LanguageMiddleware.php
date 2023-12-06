<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('language')){
            $language = Session::get('language', Config::get('app.locale'));
        } else {
            $language = 'hu';
        }
        App::setLocale($language);

        Session::put('editedLanguage', $language);

        return $next($request);
    }
}
