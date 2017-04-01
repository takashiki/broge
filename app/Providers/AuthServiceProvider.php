<?php

namespace App\Providers;

use App\Extensions\ArrayUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('array', function ($app, array $config) {
            $users = config('users');
            array_walk($users, function (&$user) {
                $user['password'] = Hash::make($user['password']);
            });

            return new ArrayUserProvider($users, app()->make('hash'), app()->make('cache'));
        });
    }
}
