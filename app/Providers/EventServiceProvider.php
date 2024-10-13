<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
//use App\Providers\NewCustomerHasRegitredEvent; // !!!! ERROR
use App\Events\NewCustomerHasRegistredEvent;
use App\Listeners\WelcomeNewCustomerListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        NewCustomerHasRegistredEvent::class => [
            WelcomeNewCustomerListener::class,
            \App\Listeners\RegisterCustomerToNewsletter::class,
            \App\Listeners\NotifyAdminViaSlack::class,
                
       ],
    ];

  

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
        //Event::listen(
           // NewCustomerHasRegitredEvent::class,
           // [WelcomeNewCustomerListener::class, 'handle']
        //);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
