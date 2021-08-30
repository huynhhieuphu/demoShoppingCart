<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        view()->composer('*', function ($view) {
            $view->with([
                'parentCategories' => Category::where(['parent_id' => 0, 'status' => 1])->get(),
                'cart' => new Cart(),
            ]);
        });
    }
}
