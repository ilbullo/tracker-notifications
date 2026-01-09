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
            'title'   => $options['title'] ?? config('tracker-notifications.confirm.title'),
            'type'    => $options['type'] ?? 'warning',
            'action'  => $options['action'] ?? null, // Il metodo da chiamare
            'params'  => $options['params'] ?? null, // Eventuali parametri (es. ID)
            'target'  => static::class,              // Il componente che riceverà la conferma
        ]);
    }
}