<?php

namespace App\Providers;

use App\Models\Articulo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
        
        Gate::define('edit-article', function ($user, Articulo $articulo) {
            return $user->id === $articulo->user_id;
        });
        Gate::define('delete-article', function ($user, Articulo $articulo) {
            return $user->id === $articulo->user_id;
        });
    }
}
