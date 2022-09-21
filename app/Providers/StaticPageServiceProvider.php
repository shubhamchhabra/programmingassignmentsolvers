<?php

namespace App\Providers;

use App\Models\StaticPages;
use Illuminate\Support\ServiceProvider;

class StaticPageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public $staticPages;

    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->staticPages = StaticPages::all();

        view()->composer('layouts.app', function($view) {
            $view->with(['staticPages' => $this->staticPages]);
        });
    }
}
