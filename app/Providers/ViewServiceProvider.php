<?php

namespace App\Providers;

use App\Models\KriteriaModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Bagikan data ke sidebar view
        View::composer('layouts.sidebar', function ($view) {
            $view->with('kriterias', KriteriaModel::all());
        });
    }
}
