<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
use Carbon\Carbon;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(function ($router) {
            $router->forAccessTokens();
        });
        Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(1));
//        Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(30));
//        Passport::personalAccessTokensExpireIn(Carbon::now()->addSecond(5));
//        Passport::refreshTokensExpireIn(Carbon::now()->addSecond(5));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(1));
//        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
