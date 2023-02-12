<?php

namespace App\Listeners;

use Mail;
use App\Events\UserRegistered;
use App\Mail\UserNotifyRegisteredMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserNotifyRegisterdListener implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CompanyRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::send(new UserNotifyRegisteredMailable($event->user));
    }

}
