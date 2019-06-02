<?php
/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2019/6/2
 * Time: 10:42 AM
 */

namespace Myth;


use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Myth\Contracts\SmsBroker;

class SmsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/sms.php', 'sms'
        );

        $this->app->singleton(SmsBroker::class, function ($app) {
            return new SmsBrokerManager($app);
        });
    }

    public function provides()
    {
        return [SmsBroker::class];
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/sms.php' => config_path('sms.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

    }
}
