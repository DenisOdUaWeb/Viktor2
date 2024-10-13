<?php

namespace App\Listeners;

//use App\Providers\NewCustomerHasRegitredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\NewCustomerHasRegistredEvent;

class RegisterCustomerToNewsletter
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewCustomerHasRegistredEvent $event): void
    
    {
        echo "ToNewsletter !";
        dump("ToNewsletter!!!");
        
    }
}
