<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\SendVerifyWithQueueNotfication;

class SendVerifyWithQueueNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Обработка события.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->notify(new SendVerifyWithQueueNotfication());
    }
}
