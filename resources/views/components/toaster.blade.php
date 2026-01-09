<div 
    x-data="{ 
        notifications: [], 
        add(event) {
            // Estrae i dati correttamente da Livewire 3 (event.detail)
            const payload = event.detail ? event.detail : event;
            
            const id = Date.now();
            this.notifications.push({
                id: id,
                message: payload.message || 'Messaggio di sistema',
                type: payload.type || 'success'
            });

            // Auto-rimozione dopo 5 secondi
            setTimeout(() => {
                this.notifications = this.notifications.filter(n => n.id !== id);
            }, 5000);
        }
    }" 
    @notify.window="add($event)" 
    class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 w-full max-w-sm"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div 
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8"
            class="relative p-4 rounded-lg shadow-xl border-l-4 flex items-center justify-between"
            :class="{
                'bg-slate-900 border-emerald-500 text-emerald-400': notification.type === 'success',
                'bg-slate-900 border-amber-500 text-amber-400': notification.type === 'warning',
                'bg-slate-900 border-red-500 text-red-400': notification.type === 'error'
            }"
        >
            <div class="flex items-center gap-3">
                <template x-if="notification.type === 'success'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </template>
                <template x-if="notification.type === 'warning'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </template>
                <template x-if="notification.type === 'error'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </template>

                <p class="text-sm font-bold tracking-wide" x-text="notification.message"></p>
            </div>

            <button @click="notifications = notifications.filter(n => n.id !== notification.id)" class="ml-4 opacity-70 hover:opacity-100">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </template>
</div>