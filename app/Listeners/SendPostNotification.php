<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\NotifyAdmins;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostNotification
{

    public function handle(PostCreated $event)
    {
     
        NotifyAdmins::dispatch($event->post);
    }
}