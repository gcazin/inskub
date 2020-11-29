<?php

namespace App\Providers;

use App\Models\Project;
use App\Observers\ProjectObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

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

        Paginator::useBootstrap();

        Project::observe(ProjectObserver::class);

        Flash::levels([
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'danger',
            'info' => 'info',
        ]);
    }
}
