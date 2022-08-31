<?php

namespace App\Listeners;

use App\Models\UserLogins;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
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
     * @param Login $event
     *
     */
    public function handle(Login $event)
    {
        // if user is student
        if(Auth::user()->role_id == 3) {
            Auth::logout();
            Session::flush();
            return abort(401);
        }
        // change last login value
        $model = new UserLogins();
        $model->user_id = Auth::user()->id;
        $model->save();
    }
}
