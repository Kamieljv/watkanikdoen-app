<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Throwable;
use Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment() === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }
        $this->setSchemaDefaultLength();

        Voyager::addAction(\App\Actions\ApproveAanmelding::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    private function setSchemaDefaultLength(): void
    {
        try {
            Schema::defaultStringLength(191);
        } catch (Throwable $exception) {
        }
    }
}
