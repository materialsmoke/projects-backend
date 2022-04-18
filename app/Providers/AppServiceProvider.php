<?php

namespace App\Providers;

use App\Services\SMS\Services\TwilioSmsService;
use App\Services\SMS\SmsInterface;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SmsInterface::class, TwilioSmsService::class);
    }
}
