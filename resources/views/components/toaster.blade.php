<div x-data="{ 
    notifications: [],
    add(e) {
        const id = Date.now();
        this.notifications.push({ id, type: e.detail[0].type, message: e.detail[0].message });
        setTimeout(() => this.notifications = this.notifications.filter(n => n.id !== id), 4000);
    }
}" @notify.window="add($event)" class="fixed top-6 right-6 z-[110] flex flex-col gap-3 w-full max-w-sm">
    <template x-for="n in notifications" :key="n.id">
        <div x-transition class="p-4 rounded-2xl shadow-xl font-bold text-xs uppercase border-2 border-white/10"
             :class="{
                'bg-emerald-500 text-black': n.type === 'success',
                'bg-red-500 text-white': n.type === 'error',
                'bg-amber-400 text-black': n.type === 'warning'
             }">
            <span x-text="n.message"></span>
        </div>
    </template>
</div>