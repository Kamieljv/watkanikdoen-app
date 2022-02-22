<?php

namespace App\Providers;

use App\Listeners\AddImageRecord;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use TCG\Voyager\Events\BreadDataChanged;
use TCG\Voyager\Events\MediaFileAdded;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MediaFileAdded::class => [
            AddImageRecord::class,
        ],
        BreadDataChanged::class => [
            AddImageRecord::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
