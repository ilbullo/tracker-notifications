<div 
    x-data="{ 
        notifications: [],
        add(data) {
            const payload = data.detail ? data.detail : data;
            const id = Date.now();
            
            this.notifications.push({
                id: id,
                message: payload.message,
                type: payload.type || 'success',
                duration: {{ config('tracker-notifications.duration', 5000) }},
                remaining: {{ config('tracker-notifications.duration', 5000) }},
            });

            this.initTimer(id);
        },
        initTimer(id) {
            const interval = 50; // Update ogni 50ms
            const timer = setInterval(() => {
                const index = this.notifications.findIndex(n => n.id === id);
                if (index === -1) {
                    clearInterval(timer);
                    return;
                }
                
                this.notifications[index].remaining -= interval;
                
                if (this.notifications[index].remaining <= 0) {
                    this.remove(id);
                    clearInterval(timer);
                }
            }, interval);
        },
        remove(id) {
            this.notifications = this.notifications.filter(n => n.id !== id);
        }
    }" 
    x-init="
        @if(session()->has('notify'))
            add({ detail: @json(session('notify')) });
        @endif
    "
    @notify.window="add($event)" 
    class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 w-full max-w-sm"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div 
            class="relative overflow-hidden p-4 rounded-lg shadow-2xl border border-slate-700 bg-slate-900 flex flex-col"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-12"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-3">
                    <span :class="{
                        'text-emerald-500': notification.type === 'success',
                        'text-amber-500': notification.type === 'warning',
                        'text-red-500': notification.type === 'error'
                    }">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    <p class="text-sm font-semibold text-slate-200" x-text="notification.message"></p>
                </div>
                <button @click="remove(notification.id)" class="text-slate-500 hover:text-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path></svg>
                </button>
            </div>

            <div class="absolute bottom-0 left-0 h-1 bg-slate-700 w-full">
                <div 
                    class="h-full transition-all linear duration-50"
                    :class="{
                        'bg-emerald-500': notification.type === 'success',
                        'bg-amber-500': notification.type === 'warning',
                        'bg-red-500': notification.type === 'error'
                    }"
                    :style="`width: ${(notification.remaining / notification.duration) * 100}%`"
                ></div>
            </div>
        </div>
    </template>
</div>