<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Role;
use App\Observers\AreaObserver;
use App\Observers\CategoryObserver;
use App\Observers\RoleObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Area::observe(AreaObserver::class);
        Category::observe(CategoryObserver::class);
        Role::observe(RoleObserver::class);

        Schema::defaultStringLength(191);

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
}
