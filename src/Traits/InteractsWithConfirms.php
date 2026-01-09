<?php

namespace Ilbullo\TrackerNotifications\Traits;

trait InteractsWithConfirms
{
    /**
     * Lancia un modale di conferma globale.
     */
    public function confirm(string $message, array $options = []): void
    {
        $this->dispatch('open-tracker-confirm', [
            'message' => $message,
            'title'   => $options['title'] ?? \config('tracker-notifications.confirm.title'),
            'type'    => $options['type'] ?? 'warning',
            'action'  => $options['action'] ?? null,
            'params'  => $options['params'] ?? [], // Array di parametri
            'target'  => static::getName(),       // Metodo Livewire per il nome del componente
        ]);
    }
}