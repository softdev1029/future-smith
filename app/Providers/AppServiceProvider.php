<?php

namespace App\Providers;

use App\Models\Discussion;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191); //Solved by increasing StringLength

        // discussions table's discussionable type
        Relation::morphMap([
            Discussion::TYPE_TRIBE => 'App\Models\Tribe',
            Discussion::TYPE_PROJECT => 'App\Models\Project',
        ]);
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
