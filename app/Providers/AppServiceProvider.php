<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Model::preventLazyLoading(!app()->isProduction());

        View::composer('client.app.nav', function ($view) {
            $categories = Category::withCount([
                'jobs' => function ($query) {
                    $query->where('stock', '>', 0);
                    $query->where('is_approved',  1);
                }
            ])
                ->orderBy('sort_order')
                ->orderBy('slug')
                ->get();

            $view->with([
                'categories' => $categories,
            ]);

            $locations = Location::withCount([
                'jobs' => function ($query) {
                    $query->where('stock', '>', 0);
                    $query->where('is_approved',  1);
                }
            ])
                ->orderBy('sort_order')
                ->get();

            $view->with([
                'locations' => $locations,
            ]);
        });
    }
}
