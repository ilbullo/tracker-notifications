<?php

namespace Ilbullo\TrackerNotifications\Traits;

trait HasNotifications
{
    public function notify(string $message, string $type = 'success'): void
    {
        $this->dispatch('notify', [
            'message' => $message,
            'type'    => $type
        ]);
    }
}