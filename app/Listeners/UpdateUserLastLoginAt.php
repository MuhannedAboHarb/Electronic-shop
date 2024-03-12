<?php

namespace App\Listeners;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UpdateUserLastLoginAt
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
     * @param  \Illuminate\Auth\Events\Login;  $event
     * @return void
     */
    public function handle(Login $event): void
    {
        $user = $event->user ;

        $user->forceFill([
            'last_login_at' => Carbon::now()
        ])->save();
    }
}
