<?php

namespace App\Listeners;

use App\Models\AuthAttempt;
use App\Models\IpAddress;
use App\Models\UserAgent;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FailedListener
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
     * @param  \Illuminate\Auth\Events\Failed $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $ipAddress = IpAddress::firstOrCreate(['ip_address' => request()->ip()]);
        $userAgent = UserAgent::firstOrCreate(['user_agent' => request()->userAgent()]);
        $username = ($event->user ? $event->user->username : '-') . ' | ' . implode(' ', $event->credentials);
        $guard = $event->guard;

        AuthAttempt::create([
            'ip_address_id' => $ipAddress->id,
            'user_agent_id' => $userAgent->id,
            'username' => $username,
            'event' => 'Failed: ' . $guard,
        ]);
    }
}
