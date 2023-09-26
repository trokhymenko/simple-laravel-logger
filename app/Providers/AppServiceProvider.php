<?php

namespace App\Providers;

use App\Http\Middleware\Logger;
use Illuminate\Support\ServiceProvider;
use App\Contracts\LogInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/log.php', 'log'
        );
        $this->bindServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function bindServices(){
        $driver = config('log.driver');

        $this->app->singleton(LogInterface::class ,$driver);
        $this->app->singleton('logger', function ($app) use ($driver){
            return new Logger($app->make($driver));
        });
    }


}
