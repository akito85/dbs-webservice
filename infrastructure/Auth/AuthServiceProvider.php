<?php

namespace Infrastructure\Auth;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
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
            // Uncomment for allowing personal access tokens
            // $router->forPersonalAccessTokens();
            $router->forTransientTokens();
        });
        
        /*
         * 0 -> Developer
         * 1 -> Administrator
         * 2 -> Manager
         * 3 -> Staff
         * 4 -> Driver
         */
        
        Passport::tokensCan([
            'Developer' => 'le me',
            'Administrator' => 'All scope',
            'Manager' => 'Manager scope',
            'Staff' => 'Staff scope',
            'Driver' => 'Driver scope'
        ]);

        Passport::tokensExpireIn(Carbon::now()->addYears(10));

        Passport::refreshTokensExpireIn(Carbon::now()->addYears(10));
    }
}