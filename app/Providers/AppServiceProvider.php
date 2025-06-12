<?php

namespace App\Providers;

use App\Models\KriteriaModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function ($view) {
            $view->with('kriteriaList', KriteriaModel::all());
        });
    }
}
