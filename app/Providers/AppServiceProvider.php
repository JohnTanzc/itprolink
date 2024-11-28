<?php

namespace App\Providers;
use App\Models\Course;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; // For user authentication

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
        // Enable Bootstrap for pagination
        Paginator::useBootstrap();

        // Composer for layouts.main
        View::composer('layouts.main', function ($view) {
            $view->with('courses', Course::all());
        });

        // Composer for pages.nav
        View::composer('pages.nav', function ($view) {
            $view->with('user', Auth::user());
        });

        // Composer for dashnav.blade.php
        View::composer('dash.dashnav', function ($view) {
            $view->with('user', Auth::user());
        });
    }




}
