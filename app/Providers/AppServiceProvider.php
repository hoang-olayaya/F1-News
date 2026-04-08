<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Category;             

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
        View::composer('*', function ($view) {
            // Tạm thời lấy TẤT CẢ danh mục ra, bỏ cái điều kiện where đi
            $globalCategories = Category::all();
            
            $view->with('globalCategories', $globalCategories);
        });
    }
}
