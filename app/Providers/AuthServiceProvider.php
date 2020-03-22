<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        // Gates for Users
        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['admin', 'manager']);
        });
        
        Gate::define('create-users', function($user){
            return $user->hasAnyRoles(['admin', 'manager']);
        });

        Gate::define('edit-users', function($user){
            return $user->hasAnyRoles(['admin', 'manager']);
        });

        Gate::define('edit-admins', function($user){
            return $user->hasAnyRoles(['admin']);
        });
        
        Gate::define('delete-users', function($user){
            return $user->hasRole('admin');
        });


        // Gates for Schedules
        Gate::define('manage-schedules', function($user){
            return $user->hasAnyRoles(['admin', 'manager']);
        });

        Gate::define('create-schedules', function($user){
            return $user->hasAnyRoles(['admin', 'manager']);
        });

        Gate::define('edit-schedules', function($user){
            return $user->hasAnyRoles(['admin', 'manager']);
        });
        
        Gate::define('delete-schedules', function($user){
            return $user->hasRole('admin');
        });
    }
}
