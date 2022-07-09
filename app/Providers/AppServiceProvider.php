<?php

namespace App\Providers;

use App\Actions\Approve;
use App\Actions\Publish;
use App\Actions\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Actions\ViewAction;
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

        Voyager::addAction(Approve::class);
        Voyager::addAction(Publish::class);
        Voyager::replaceAction(ViewAction::class, View::class);
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
