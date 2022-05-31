<?php

namespace Yadahan\WhatsAppNotificationChannel;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class WhatsAppChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/99digital.php', '99digital');

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('whatsapp', function ($app) {
                return new Channels\WhatsAppTemplateChannel(
                    $app->make(HttpClient::class),
                    $app['config']['99digital.api_url'],
                    $app['config']['99digital.api_key'],
                    $app['config']['99digital.from']
                );
            });
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/99digital.php' => $this->app->configPath('99digital.php'),
            ], '99digital');
        }
    }
}
