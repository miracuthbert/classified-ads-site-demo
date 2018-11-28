<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Listing;
use App\Policies\AdminPolicy;
use App\Policies\ListingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Listing::class => ListingPolicy::class,
        Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerAdminPolicies();

        Passport::routes();
    }

    public function registerAdminPolicies()
    {
        //admin listing policies
        Gate::define('admin-listings-view', 'App\Policies\ListingAdminPolicy@view');
        Gate::define('admin-listings-create', 'App\Policies\ListingAdminPolicy@create');
        Gate::define('admin-listings-update', 'App\Policies\ListingAdminPolicy@update');
        Gate::define('admin-listings-delete', 'App\Policies\ListingAdminPolicy@delte');
        Gate::define('admin-listings-touch', 'App\Policies\ListingAdminPolicy@touch');
    }

}
