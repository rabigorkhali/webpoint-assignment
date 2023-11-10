<?php

namespace App\Providers;

use App\Events\UserSaved;
use App\Listeners\UserSavedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    // protected $listen = [
    //     UserSaved::class => [
    //         UserSavedListener::class,
    //     ],
    // ];

    protected $listen = [
        'App\Events\UserSaved' => [
            'App\Listeners\SaveUserDetailsListener',
        ],
        // other events and listeners...
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