<div 
    x-data="{ 
        show: false, 
        config: {},
        open(event) {
            this.config = event.detail[0];
            this.show = true;
        },
        proceed() {
            // Invia l'evento al componente originale usando il target salvato
            $wire.dispatchTo(this.config.target, this.config.action, { id: this.config.params });
            this.show = false;
        }
    }"
    x-on:open-tracker-confirm.window="open($event)"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-[110] flex items-center justify-center p-4"
>
    <div class="fixed inset-0 bg-slate-950/90 backdrop-blur-sm" @click="show = false"></div>

    <div 
        class="relative bg-[#1e293b] w-full max-w-md rounded-[2rem] border border-white/10 shadow-2xl p-8 overflow-hidden"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    >
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-amber-400/10 mb-6">
                <svg x-show="config.type === 'warning'" class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <svg x-show="config.type === 'danger'" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <h3 class="text-xl font-black text-white uppercase tracking-tight mb-2" x-text="config.title"></h3>
            <p class="text-slate-400 font-medium mb-8" x-text="config.message"></p>

            <div class="flex gap-3">
                <button @click="show = false" class="flex-1 px-6 py-4 rounded-xl bg-slate-800 text-white font-bold hover:bg-slate-700 transition-all uppercase text-xs tracking-widest">
                    {{ config('tracker-notifications.confirm.cancel_text') }}
                </button>
                <button @click="proceed()" class="flex-1 px-6 py-4 rounded-xl font-bold transition-all uppercase text-xs tracking-widest shadow-lg"
                    :class="config.type === 'danger' ? 'bg-red-500 text-white shadow-red-500/20' : 'bg-amber-400 text-black shadow-amber-400/20'">
                    {{ config('tracker-notifications.confirm.confirm_text') }}
                </button>
            </div>
        </div>
    </div>
</div>