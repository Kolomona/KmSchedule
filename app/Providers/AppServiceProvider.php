<?php

namespace App\Providers;
use Illuminate\Database\Schema\Builder; // Import Builder where defaultStringLength method is defined
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Solves SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long;
        Builder::defaultStringLength(191); // Update defaultStringLength

        

    }
}
