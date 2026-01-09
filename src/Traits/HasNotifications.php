<?php

namespace Ilbullo\TrackerNotifications\Traits;

use Illuminate\Support\Facades\Session;

trait HasNotifications
{
    public function notify($message, $type = 'success')
    {
        // Notifica immediata per Livewire
        $this->dispatch('notify', message: $message, type: $type);
        
        // Notifica per il prossimo refresh della pagina (redirect)
        Session::flash('notify', ['message' => $message, 'type' => $type]);
    }
}