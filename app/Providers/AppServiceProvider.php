<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Pagination\Paginator;


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

        Paginator::useBootstrap();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        if (!App::runningInConsole()) {
            $pengaturan = Pengaturan::first();

            view()->share('pengaturan', $pengaturan);
        }
    }
}
