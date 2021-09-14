<?php

namespace App\Providers;

use App\Models\Banner;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use \App\Models\Category;
use \App\Cart;

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
        // Global Data - Sharing Data With All Views

        view()->composer('*', function ($view) {
            $view->with([
                'bannerShop' => Banner::where('status', 1)->first(),
                'parentCategories' => Category::where(['parent_id' => 0, 'status' => 1])->get(),
                'cart' => new Cart(),
            ]);
        });

    }
}
