<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;

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
    public function boot(): void
    {
        $services = Service::all();
    
        // Bind the data to the parent view using a view composer
        View::composer('layouts.website-main', function ($view) use ($services) {
            $view->with(compact('services'));
        });
    }
}
