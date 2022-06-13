<?php

namespace App\Providers;

use App\Nova\Country;
use App\Nova\Currency;
use App\Nova\GeoZone;
use App\Nova\Language;
use App\Nova\Manufacturer;
use App\Nova\Store;
use App\Nova\Tax;
use App\Nova\User;
use App\Nova\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->registerCustomNavigationMenu();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function registerCustomNavigationMenu() {
        Nova::mainMenu(function(Request $request) {
            return [
                MenuSection::make('Catalog', [
                    MenuItem::resource(Manufacturer::class),
                ]),
                MenuSection::make('Settings', [
                    MenuItem::resource(Country::class),
                    MenuItem::resource(Language::class),
                    MenuItem::resource(Currency::class),
                    MenuItem::resource(Zone::class),
                    MenuItem::resource(GeoZone::class),
                    MenuItem::resource(Tax::class),
                    MenuItem::resource(Store::class),
                    MenuItem::resource(User::class),
                ])->icon('cog'),
            ];
        });
    }
}
