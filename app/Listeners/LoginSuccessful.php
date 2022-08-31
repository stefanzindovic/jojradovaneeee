<?php

namespace App\Listeners;

use App\Models\UserLogins;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginSuccessful
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // change last login value
        $model = new UserLogins();
        $model->user_id = Auth::user()->id;
        $model->save();
    }
}
