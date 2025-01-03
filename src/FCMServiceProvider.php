<?php

namespace Meunee\LaraFcm;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Meunee\LaraFcm\Sender\FCMGroup;
use Meunee\LaraFcm\Sender\FCMSender;

class FCMServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        if (Str::contains($this->app->version(), 'Lumen')) {
            $this->app->configure('fcm');
        } else {
            $this->publishes([
                __DIR__.'/../config/fcm.php' => config_path('fcm.php'),
            ]);
        }
    }

    public function register()
    {
        if (!Str::contains($this->app->version(), 'Lumen')) {
            $this->mergeConfigFrom(__DIR__.'/../config/fcm.php', 'fcm');
        }

        $this->app->singleton('fcm.client', function ($app) {
            return (new FCMManager($app))->driver();
        });

        $this->app->bind('fcm.group', function ($app) {
            $client = $app[ 'fcm.client' ];
            $url = $app[ 'config' ]->get('fcm.fcm_api_group_url');

            return new FCMGroup($client, $url);
        });

        $this->app->bind('fcm.sender', function ($app) {
            $client = $app[ 'fcm.client' ];
            $url = $app[ 'config' ]->get('fcm.fcm_api_send_url');

            return new FCMSender($client, $url);
        });
    }

    public function provides()
    {
        return ['fcm.client', 'fcm.group', 'fcm.sender'];
    }
}