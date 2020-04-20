<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use App\Product;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addDay());
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(5));
        Passport::personalAccessTokensExpireIn(
            Carbon::now()->addWeeks(2)
        );

        Gate::define('change-role', function ($user) {
            return $user->isAdmin();
        });
    }
}
