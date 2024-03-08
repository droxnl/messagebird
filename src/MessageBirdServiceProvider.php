<?php

declare(strict_types=1);

namespace Droxnl\Messagebird;

use Illuminate\Support\ServiceProvider;

class MessageBirdServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/messagebird.php' => config_path('messagebird.php'),
        ]);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('messagebird', function($app){
            $client = new \MessageBird\Client($app['config']['messagebird']['api_key']);
            return new Messagebird($client);
        });
    }
}