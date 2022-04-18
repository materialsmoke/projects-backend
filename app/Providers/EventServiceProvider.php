<?php

namespace App\Providers;

use App\Entry;
use App\Events\ProjectStartedEvent;
use App\Events\ProjectStoppedEvent;
use App\Listeners\SendStartedProjectNotificationListener;
use App\Listeners\SendStoppedProjectNotificationListener;
use App\Observers\EntryObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProjectStartedEvent::class => [
            SendStartedProjectNotificationListener::class
        ],
        ProjectStoppedEvent::class => [
            SendStoppedProjectNotificationListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Entry::observe(EntryObserver::class);
    }
}
