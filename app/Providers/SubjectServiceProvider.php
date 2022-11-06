<?php

namespace App\Providers;

use App\Models\Service;
use Illuminate\Support\ServiceProvider;

class SubjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public $subjects;

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
        $this->subjects = Service::where('is_featured',1)->get();

        view()->composer('layouts.app', function($view) {
            $view->with(['subjects' => $this->subjects]);
        });
    }
}
