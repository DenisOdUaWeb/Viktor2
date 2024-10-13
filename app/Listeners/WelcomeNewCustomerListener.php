<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewCustomerHasRegitredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\NewCustomerHasRegistredEvent;

class WelcomeNewCustomerListener implements ShouldQueue // ADD SOME JOBS IN TO THE QUEUE
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
    public function handle(NewCustomerHasRegistredEvent $event)
    
    {
        echo "ECHO PLEASE ! EVENTS EVENTS LISTENER 1 then 2 and 3 but after this finish ";
        echo "to make it unsync USE THE QUEUEs ";
        dump("sdfsfdsfd!!!");
        dump($event->customer->email);
        Mail::to( $event->customer->email)->send(new WelcomeNewUserMail());
        dump("sdfsfdsfd!!!");
        return redirect('/');
    }
}
