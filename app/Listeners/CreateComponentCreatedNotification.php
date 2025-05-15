<?php

namespace App\Listeners;

use App\Events\ComponentCreated;

class CreateComponentCreatedNotification
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
    public function handle(ComponentCreated $event): void
    {
        // Create a new notification for the component
        $event->component->notifications()->create();
    }
}
