<?php

namespace App\Listeners\User;

use App\Events\User\UserRegistered;
use App\Mail\User\wellcome;
use http\Client\Curl\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class sendWelcomeEmail
{
    
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
       Mail::to($event->user)->send(new wellcome($event->user));
    }
}
