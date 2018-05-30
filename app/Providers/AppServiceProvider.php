<?php

namespace App\Providers;

use App\Models\TimeFrame;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if(auth()->check()) {
                $view->timeframe = TimeFrame::where([
                    ['user_id', '=', auth()->user()->id],
                    ['timer_started', '!=', NULL],
                    ['timer_finished', '=', NULL]
                ])->with('task')->orderBy('id', 'DESC')->first();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
