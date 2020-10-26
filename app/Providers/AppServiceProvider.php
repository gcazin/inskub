<?php

namespace App\Providers;

use App\Observers\ProjectObserver;
use App\Project;
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
        setlocale(LC_TIME, 'fr_FR.utf8');

        Project::observe(ProjectObserver::class);
    }
}
