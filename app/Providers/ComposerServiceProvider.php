<?php

namespace App\Providers;

use App\Http\ViewComposers\AreaComposer;
use App\Http\ViewComposers\AreasComposer;
use App\Http\ViewComposers\CategoriesComposer;
use App\Http\ViewComposers\NavigationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', AreaComposer::class);

        //Share navigation
        View::composer('layouts.partials._navigation', NavigationComposer::class);
        View::composer('layouts.messenger.partials._navigation', NavigationComposer::class);

        //Share areas
        View::composer([
            'listings.partials.forms._areas',
        ], AreasComposer::class);

        //Share categories
        View::composer([
            'listings.partials.forms._categories'
        ], CategoriesComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AreaComposer::class);
    }
}
