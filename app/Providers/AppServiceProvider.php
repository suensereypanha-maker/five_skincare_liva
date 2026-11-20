<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\ProductService;
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
    public function boot(): void
    {
        View::composer(['partials.header', 'partials.humberger', 'partials.hero', 'layouts.master'], function ($view): void {
            $view->with([
                'globalCartCount' => CartService::getCount(),
                'globalCartSubtotal' => CartService::getSubtotal(),
                'departments' => ProductService::getDepartments(),
                'categories' => ProductService::getCategories(),
            ]);
        });
    }
}
