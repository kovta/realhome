<?php

namespace App\Providers;

use App\Models\RealEstate;
use App\Models\RealEstateOffer;
use App\Models\Route;
use App\Observers\RealEstateObserver;
use App\Observers\RealEstateOfferObserver;
use App\Observers\RouteObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        RealEstate::observe(RealEstateObserver::class);
        RealEstateOffer::observe(RealEstateOfferObserver::class);
        Route::observe(RouteObserver::class);

        Blade::directive('checked', function ($expression) {
            return "<?php echo ($expression == 1) ? 'checked' : ''; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
