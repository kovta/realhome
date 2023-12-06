<?php

namespace App\Observers;

use App\Models\Route;
use Illuminate\Support\Facades\Auth;

class RouteObserver
{
    /**
     * Handle the real estate "created" event.
     *
     * @param  Route  $route
     * @return void
     */
    public function creating(Route $route)
    {
        $route->created_by_id = Auth::user()->id;
    }

    /**
     * Handle the real estate "updated" event.
     *
     * @param  Route  $route
     * @return void
     */
    public function updating(Route $route)
    {
        //
    }

    /**
     * Handle the real estate "deleted" event.
     *
     * @param  Route  $route
     * @return void
     */
    public function deleted(Route $route)
    {
        //
    }

    /**
     * Handle the real estate "restored" event.
     *
     * @param  Route  $route
     * @return void
     */
    public function restored(Route $route)
    {
        //
    }

    /**
     * Handle the real estate "force deleted" event.
     *
     * @param  Route  $route
     * @return void
     */
    public function forceDeleted(Route $route)
    {
        //
    }
}
