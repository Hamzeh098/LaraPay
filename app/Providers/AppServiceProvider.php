<?php

namespace App\Providers;

use App\Services\Notification\NotificationService;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('notification', function ($app) {
            return new NotificationService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->langLocale();
    }

    private function langLocale()
    {
        $request = Request::capture();
        $request->has('lang') ? app()->setLocale($request->lang) : 'en';

    }
}
