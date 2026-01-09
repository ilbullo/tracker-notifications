# Tracker Notifications 🚀

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ilbullo/tracker-notifications.svg?style=flat-square)](https://packagist.org/packages/ilbullo/tracker-notifications)
[![Total Downloads](https://img.shields.io/packagist/dt/ilbullo/tracker-notifications.svg?style=flat-square)](https://packagist.org/packages/ilbullo/tracker-notifications)
[![License](https://img.shields.io/packagist/l/ilbullo/tracker-notifications.svg?style=flat-square)](https://packagist.org/packages/ilbullo/tracker-notifications)

Un sistema di notifiche **High-Visibility** ed elegante per Laravel Livewire 3, progettato con i principi SOLID e pronto all'uso.



## Caratteristiche
- ✅ **Plug & Play**: installazione rapida e minima configurazione.
- 🎨 **Modern UI**: Design scuro (Slate/Amber) con animazioni fluide via AlpineJS.
- ⚡ **Event Driven**: Utilizza gli eventi del browser per performance ottimali.
- 🧩 **SOLID**: Disaccoppiamento totale tra logica di business e interfaccia utente.

## Installazione

Puoi installare il pacchetto tramite composer:

```bash
composer require ilbullo/tracker-notifications
```

### Registrazione Service Provider

Se utilizzi una versione di Laravel precedente alla 11 senza auto-discovery, aggiungi il Service Provider in `config/app.php`:

PHP

```
'providers' => [
    // ...
    Ilbullo\TrackerNotifications\TrackerNotificationsServiceProvider::class,
],

```

----------

## 🚀 Guida all'uso

### 1. Inserimento nel Layout

Aggiungi il componente `<x-tracker-toaster />` nel tuo file di layout principale (es. `app.blade.php`), appena prima della chiusura del tag `</body>`.

HTML

```
    <x-tracker-toaster />
    
    @livewireScripts
</body>
</html>

```

### 2. Preparazione del Componente Livewire

Nel componente Livewire dove desideri attivare le notifiche, importa e utilizza il Trait `HasNotifications`.

PHP

```
namespace App\Livewire;

use Livewire\Component;
use Ilbullo\TrackerNotifications\Traits\HasNotifications;

class MyComponent extends Component
{
    use HasNotifications;

    public function submit()
    {
        // Logica di business...
        
        $this->notify('Operazione riuscita con successo!');
    }
}

```

----------

## 🎨 Funzionalità e Stati

Il metodo `notify` è versatile e supporta diversi livelli di urgenza visiva:

### Notifica di Successo (Default)

Perfetta per conferme di salvataggio o creazione.

PHP

```
$this->notify('Salvataggio completato!');
// oppure
$this->notify('Salvataggio completato!', 'success');

```

### Notifica di Avviso (Warning)

Ideale per segnalare discrepanze nei dati o azioni che richiedono attenzione.

PHP

```
$this->notify('Attenzione: i KM inseriti sono elevati', 'warning');

```

### Notifica di Errore (Error)

Da utilizzare in caso di eccezioni o fallimenti delle procedure.

PHP

```
$this->notify('Errore: impossibile connettersi al database', 'error');

```

----------

## ⚙️ Personalizzazione Avanzata

### Pubblicazione delle Viste

Se desideri cambiare i colori Tailwind, la posizione del Toaster o le animazioni AlpineJS, puoi pubblicare i file Blade:

Bash

```
php artisan vendor:publish --tag="tracker-notifications-views"

```

I file saranno disponibili in `resources/views/vendor/tracker-notifications/`.

### Requisiti di Sistema

-   **PHP**: ^8.1
    
-   **Laravel**: ^10.0 | ^11.0
    
-   **Livewire**: ^3.0
    
-   **TailwindCSS**: Necessario per lo styling predefinito.
    

----------

## 📄 Licenza

Distribuito sotto licenza MIT. Vedi il file `LICENSE` per ulteriori informazioni.

----------

Creato con ❤️ da [Ilbullo](https://www.google.com/search?q=https://github.com/ilbullo)