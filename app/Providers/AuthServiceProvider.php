<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('categories', [UserPolicy::class, 'categories']);;
        Gate::define('attributes', [UserPolicy::class, 'attributes']);
        Gate::define('jobs', [UserPolicy::class, 'jobs']);
        Gate::define('locations', [UserPolicy::class, 'locations']);
        Gate::define('users', [UserPolicy::class, 'users']);
        Gate::define('authAttempts', [UserPolicy::class, 'authAttempts']);
        Gate::define('ipAddresses', [UserPolicy::class, 'ipAddresses']);
        Gate::define('userAgents', [UserPolicy::class, 'userAgents']);
        Gate::define('contacts', [UserPolicy::class, 'contacts']);
    }
}
