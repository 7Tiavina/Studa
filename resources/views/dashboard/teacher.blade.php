<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('faviconStuda.png') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Studa | Dashboard Professeur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Syne", "sans-serif"],
                    },
                    colors: {
                        "blue": {
                            "50": "#f0f5ff",
                            "100": "#e0ebff",
                            "200": "#c0d7ff",
                            "300": "#90b8ff",
                            "400": "#5b93ff",
                            "500": "#1b55db",
                            "600": "#1b55db",
                            "700": "#123fa3",
                            "800": "#133580",
                            "900": "#152e66",
                            "950": "#0e1b3d"
                        },
                        "sky": {
                            "50": "#f0f9ff",
                            "100": "#e0f2fe",
                            "200": "#bae6fd",
                            "300": "#7dd3fc",
                            "400": "#38bdf8",
                            "500": "#38bdf8",
                            "600": "#0284c7",
                            "700": "#0369a1",
                            "800": "#075985",
                            "900": "#0c4a6e",
                            "950": "#082f49"
                        },
                        "primary": "var(--primary)",
                        "background": "var(--background)",
                        "surface": "var(--surface)",
                        "surface-container": "var(--surface-container)",
                        "surface-container-high": "var(--surface-container-high)",
                        "surface-container-low": "var(--surface-container-low)",
                        "on-background": "var(--on-background)",
                        "on-surface": "var(--on-surface)",
                        "on-surface-variant": "var(--on-surface-variant)",
                        "outline": "var(--outline)",
                        "outline-variant": "var(--outline-variant)",
                        "secondary": "var(--secondary)",
                        "tertiary": "var(--tertiary)",
                        "error": "var(--error)",
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary: #1b55db; 
            --background: #f8fafc; 
            --surface: #ffffff;
            --surface-container: #ffffff; 
            --surface-container-high: #f1f5f9; 
            --surface-container-low: #f8fafc;
            --on-background: #0f172a; 
            --on-surface: #0f172a;
            --on-surface-variant: #475569; 
            --outline: #94a3b8;
            --outline-variant: #e2e8f0; 
            --secondary: #38bdf8; 
            --tertiary: #f59e0b; 
            --error: #ef4444; 
        }
        .dark {
            --primary: #38bdf8;
            --background: #0c1322;
            --surface: #0c1322;
            --surface-container: #191f2f;
            --surface-container-high: #232a3a;
            --surface-container-low: #141b2b;
            --on-background: #dce2f7;
            --on-surface: #dce2f7;
            --on-surface-variant: #c2c6d6;
            --outline: #8c909f;
            --outline-variant: #424754;
            --secondary: #1b55db;
            --tertiary: #ffb95f;
            --error: #ffb4ab;
        }

        body { font-family: 'Syne', sans-serif; }

        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        [x-cloak] { display: none !important; }
        
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        html.dark ::-webkit-scrollbar-track {
            background: #0c1322;
        }
        html:not(.dark) ::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
        html:not(.dark) ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        @keyframes slide-in {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .animate-slide-in {
            animation: slide-in 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && !window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        setInterval(() => {
            fetch('/users/heartbeat', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
        }, 30000);

        window.addEventListener('beforeunload', function() {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            navigator.sendBeacon('/users/offline', formData);
        });
    </script>
</head>
<body class="bg-background text-on-background font-sans antialiased transition-colors duration-200" 
      x-data="{ 
        activeTab: '{{ request()->query('tab', 'dashboard') }}', 
        showMessenger: false, 
        openChats: [],
        userStatuses: {
            @foreach($students as $s) {{ $s->id }}: {{ $s->is_online ? 'true' : 'false' }}, @endforeach
        },
        unreadMessagesCount: 0,
        unreadMessagesBySender: {},
        notifications: [],
        unreadNotificationsCount: 0,
        toasts: [],
        fetchNotifications() {
            fetch('{{ route('notifications.index') }}')
                .then(res => res.json())
                .then(data => {
                    let newNotifications = data.notifications.filter(n => {
                        return !n.is_read && !this.notifications.some(existing => existing.id === n.id);
                    });
                    if (this.notifications.length > 0 && newNotifications.length > 0) {
                        newNotifications.forEach(n => {
                            if (n.type !== 'new_message') {
                                this.showToast(n);
                            }
                        });
                    }
                    this.notifications = data.notifications;
                    this.unreadNotificationsCount = data.unread_count;
                    this.unreadMessagesCount = data.unread_messages_count;
                    this.unreadMessagesBySender = data.unread_messages_by_sender;

                    this.openChats.forEach(chat => {
                        if (!chat.minimized && (this.unreadMessagesBySender[chat.id] || 0) > 0) {
                            this.markMessagesAsRead(chat.id);
                        }
                    });
                });
        },
        showToast(n) {
            let id = Date.now() + Math.random();
            this.toasts.push({ id, title: n.title, message: n.message, type: n.type, action_url: n.action_url, sender_id: n.sender_id, sender: n.sender });
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 5000);
        },
        markNotificationAsRead(n) {
            fetch(`/notifications/${n.id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                this.fetchNotifications();
                if (n.action_url) {
                    window.location.href = n.action_url;
                }
            });
        },
        markAllNotificationsAsRead() {
            fetch('{{ route('notifications.read-all') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                this.fetchNotifications();
            });
        },
        markMessagesAsRead(senderId) {
            // Mise à jour optimiste locale pour une réactivité instantanée
            const count = this.unreadMessagesBySender[senderId] || 0;
            if (count > 0) {
                this.unreadMessagesBySender[senderId] = 0;
                this.unreadMessagesCount = Math.max(0, this.unreadMessagesCount - count);
            }
            fetch(`/notifications/messages/read/${senderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                this.fetchNotifications();
            });
        },
        updateAllStatuses() {
            let ids = [...new Set([
                ...Object.keys(this.userStatuses),
                ...this.openChats.map(c => c.id)
            ])];
            if (ids.length === 0) return;
            
            let url = new URL('/users/statuses', window.location.origin);
            ids.forEach(id => url.searchParams.append('ids[]', id));
            
            fetch(url)
                .then(r => r.json())
                .then(statuses => { this.userStatuses = statuses; });
        }
      }"
      x-init="
        updateAllStatuses();
        setInterval(() => { updateAllStatuses(); }, 8000);
        fetchNotifications();
        setInterval(() => { fetchNotifications(); }, 8000);
      ">

    <div class="fixed bottom-0 right-4 flex gap-3 z-50 items-end pointer-events-none">
        <template x-for="chat in openChats" :key="chat.id">
            <div class="w-96 bg-white dark:bg-slate-900 rounded-t-xl shadow-2xl flex flex-col overflow-hidden text-slate-800 dark:text-slate-100 pointer-events-auto border border-slate-200 dark:border-slate-800 transition-colors">
                <div class="bg-slate-50 dark:bg-slate-950 p-3 flex justify-between items-center border-b border-slate-200 dark:border-slate-800 cursor-pointer shadow-sm transition-colors"
                     @click="chat.minimized = !chat.minimized; if(!chat.minimized) { markMessagesAsRead(chat.id); }">
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <div class="w-8 h-8 rounded-full bg-blue-500/20 text-blue-500 dark:text-blue-400 flex items-center justify-center font-bold text-[10px]"
                                 x-text="chat.name.charAt(0)"></div>
                            <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full border-2 border-slate-50 dark:border-slate-950"
                                 :class="userStatuses[chat.id] ? 'bg-secondary' : 'bg-error'"></div>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-sm text-slate-800 dark:text-slate-200" x-text="chat.name"></span>
                            <span class="text-[9px] uppercase tracking-tighter" :class="userStatuses[chat.id] ? 'text-secondary' : 'text-error'" x-text="userStatuses[chat.id] ? 'En ligne' : 'Hors ligne'"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <button @click.stop="chat.minimized = !chat.minimized; if(!chat.minimized) { markMessagesAsRead(chat.id); }"
                                class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-full flex items-center justify-center text-slate-500 dark:text-slate-400">
                            <span class="material-symbols-outlined text-[16px]">remove</span>
                        </button>
                        <button @click.stop="openChats = openChats.filter(c => c.id !== chat.id)"
                                class="p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-full flex items-center justify-center text-slate-500 dark:text-slate-400">
                            <span class="material-symbols-outlined text-[16px]">close</span>
                        </button>
                    </div>
                </div>

                <div x-show="!chat.minimized"
                     class="h-96 overflow-y-auto p-4 bg-white dark:bg-slate-900 flex flex-col gap-3 custom-scrollbar transition-colors"
                     x-init="
                        chat.loading = true;
                        fetch(`/messages/${chat.conversation_id}`)
                            .then(r => r.json())
                            .then(data => {
                                chat.messages = data;
                                chat.loading = false;
                                $nextTick(() => { $el.scrollTop = $el.scrollHeight; });
                            })
                            .catch(() => { chat.loading = false; });
                        setInterval(() => {
                            if (!chat.minimized) {
                                fetch(`/messages/${chat.conversation_id}`)
                                    .then(r => r.json())
                                    .then(data => {
                                        if (data.length !== chat.messages.length) {
                                            chat.messages = data;
                                            $nextTick(() => { $el.scrollTop = $el.scrollHeight; });
                                            markMessagesAsRead(chat.id);
                                        }
                                    });
                            }
                        }, 4000);
                     ">
                    <!-- Animation de chargement des messages -->
                    <template x-if="chat.loading">
                        <div class="flex flex-col gap-3 w-full">
                            <div class="self-start max-w-[75%] w-2/3 animate-pulse">
                                <div class="bg-slate-100 dark:bg-slate-800 h-10 rounded-2xl"></div>
                            </div>
                            <div class="self-end max-w-[75%] w-1/2 animate-pulse">
                                <div class="bg-blue-600/30 h-10 rounded-2xl"></div>
                            </div>
                            <div class="self-start max-w-[75%] w-3/4 animate-pulse">
                                <div class="bg-slate-100 dark:bg-slate-800 h-12 rounded-2xl"></div>
                            </div>
                        </div>
                    </template>

                    <template x-for="msg in chat.messages" :key="msg.id">
                        <div x-data="{ showPicker: false }" 
                             :class="msg.user_id === {{ Auth::id() }} ? 'self-end' : 'self-start'" 
                             class="max-w-[85%] group relative">
                            
                            <div :class="msg.user_id === {{ Auth::id() }} ? 'bg-blue-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200'"
                                 class="p-3 rounded-2xl text-sm shadow-sm transition-colors">
                                <span x-text="msg.body"></span>
                            </div>
                            
                            <div x-show="msg.reactions && Object.keys(msg.reactions).length > 0" class="flex flex-wrap gap-1 mt-1" :class="msg.user_id === {{ Auth::id() }} ? 'justify-end' : 'justify-start'">
                                <template x-for="(userIds, emoji) in msg.reactions" :key="emoji">
                                    <button @click="
                                        if (msg.user_id !== {{ Auth::id() }}) {
                                            fetch(`/messages/${msg.id}/react`, {
                                                method: 'POST',
                                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                body: JSON.stringify({ emoji: emoji })
                                            })
                                            .then(r => r.json())
                                            .then(updatedMsg => { msg.reactions = updatedMsg.reactions; })
                                        }
                                    "
                                    :disabled="msg.user_id === {{ Auth::id() }}"
                                    :class="[
                                        userIds.includes({{ Auth::id() }}) ? 'bg-blue-500/30 border-blue-500/50' : 'bg-slate-100 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200',
                                        msg.user_id === {{ Auth::id() }} ? 'cursor-default' : 'hover:scale-110 transition-transform'
                                    ]"
                                    class="flex items-center gap-1 px-1.5 py-0.5 rounded-full border text-[10px] transition-colors">
                                        <span x-text="emoji"></span>
                                        <span class="font-bold" x-text="userIds.length"></span>
                                    </button>
                                </template>
                            </div>

                            <div x-show="msg.user_id !== {{ Auth::id() }}" 
                                 class="absolute top-0 transition-opacity z-10"
                                 :class="[
                                    msg.user_id === {{ Auth::id() }} ? 'right-full mr-2' : 'left-full ml-2',
                                    showPicker ? 'opacity-100' : 'opacity-0 group-hover:opacity-100'
                                 ]">
                                
                                <button @click="showPicker = !showPicker" 
                                        class="p-1 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full text-slate-500 dark:text-slate-400 hover:text-primary hover:scale-110 transition-all shadow-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[14px]">add_reaction</span>
                                </button>

                                <div x-show="showPicker" 
                                     @click.away="showPicker = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-90"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute top-full mt-2 flex bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full shadow-2xl p-1 z-20"
                                     :class="msg.user_id === {{ Auth::id() }} ? 'right-0' : 'left-0'">
                                    <template x-for="emoji in ['👍', '❤️', '😂', '😮', '😢', '🔥']" :key="emoji">
                                        <button @click="
                                            fetch(`/messages/${msg.id}/react`, {
                                                method: 'POST',
                                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                body: JSON.stringify({ emoji: emoji })
                                            })
                                            .then(r => r.json())
                                            .then(updatedMsg => { msg.reactions = updatedMsg.reactions; showPicker = false; })
                                        " class="hover:scale-125 transition-transform px-1.5 py-1 text-lg" x-text="emoji"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="!chat.minimized" class="p-3 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 flex items-center gap-2 transition-colors">
                    <form @submit.prevent="
                        fetch(`/messages/${chat.conversation_id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ body: chat.newMessage })
                        })
                        .then(r => r.json())
                        .then(msg => {
                            if(msg.id) {
                                chat.messages.push(msg);
                                chat.newMessage = '';
                                $nextTick(() => {
                                    const container = $el.closest('.w-96').querySelector('.overflow-y-auto');
                                    if (container) {
                                        container.scrollTop = container.scrollHeight;
                                    }
                                });
                            }
                        })
                        .catch(e => console.error(e));
                    " class="flex w-full gap-2">
                        <input type="text"
                               x-model="chat.newMessage"
                               placeholder="Écrire..."
                               class="flex-1 text-sm px-4 py-2 bg-white dark:bg-slate-900 text-slate-800 dark:text-white rounded-full border border-slate-300 dark:border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
                        <button type="submit" class="text-blue-500 dark:text-blue-400 p-1 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined">send</span>
                        </button>
                    </form>
                </div>
            </div>
        </template>
    </div>

    <aside class="flex flex-col h-screen fixed z-50 bg-white dark:bg-slate-950 w-[260px] border-r border-slate-200 dark:border-slate-800 transition-colors">
        <a href="/" class="px-6 py-8 block">
            <img src="{{ asset('logoStuda.png') }}" alt="Studa" class="h-8 w-auto">
        </a>

        <div class="px-6 mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full overflow-hidden bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-500 font-bold border border-primary/20 shadow-sm">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                @else
                    {{ substr(Auth::user()->name, 0, 1) }}
                @endif
            </div>
            <div>
                <p class="font-bold text-sm text-slate-800 dark:text-slate-100 truncate max-w-[140px]">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Professeur</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <button @click="activeTab = 'dashboard'; window.history.pushState({}, '', '?tab=dashboard')"
                    :class="activeTab === 'dashboard' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tableau de bord</span>
            </button>
            <button @click="activeTab = 'content'; window.history.pushState({}, '', '?tab=content')"
                    :class="activeTab === 'content' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">menu_book</span>
                <span>Mes Contenus</span>
            </button>
            <button @click="activeTab = 'subjects'; window.history.pushState({}, '', '?tab=subjects')"
                    :class="activeTab === 'subjects' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">school</span>
                <span>Mes Spécialités</span>
            </button>
            <button @click="activeTab = 'students'; window.history.pushState({}, '', '?tab=students')"
                    :class="activeTab === 'students' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">group</span>
                <span>Étudiants</span>
            </button>
            <button @click="activeTab = 'live'; window.history.pushState({}, '', '?tab=live')"
                    :class="activeTab === 'live' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">video_call</span>
                <span>Live Courses</span>
            </button>
            <button @click="activeTab = 'analytics'; window.history.pushState({}, '', '?tab=analytics')"
                    :class="activeTab === 'analytics' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">insights</span>
                <span>Analytics</span>
            </button>
            <button @click="activeTab = 'settings'; window.history.pushState({}, '', '?tab=settings')"
                    :class="activeTab === 'settings' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">settings</span>
                <span>Paramètres</span>
            </button>
        </nav>

        <div class="p-6 border-t border-slate-200 dark:border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2 text-error hover:text-red-500 w-full text-left text-sm font-medium">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="ml-[260px] min-h-screen flex flex-col">

        <header class="flex items-center justify-between px-8 h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-colors">
            <h2 class="font-bold text-slate-800 dark:text-slate-100"
                x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></h2>
            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors focus:outline-none flex items-center justify-center">
                    <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
                </button>
                <button @click="showMessenger = !showMessenger"
                        class="p-2 text-slate-500 dark:text-slate-400 hover:text-primary transition-colors relative">
                    <span class="material-symbols-outlined">chat</span>
                    <template x-if="unreadMessagesCount > 0">
                        <span class="absolute top-1 right-1 w-2 h-2 bg-blue-500 rounded-full animate-ping"></span>
                    </template>
                    <template x-if="unreadMessagesCount > 0">
                        <span class="absolute top-1 right-1 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </template>
                </button>
                <!-- Composant de Notification Alpine.js -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="p-2 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-100 relative focus:outline-none flex items-center justify-center">
                        <span class="material-symbols-outlined">notifications</span>
                        <template x-if="unreadNotificationsCount > 0">
                            <span class="absolute top-1 right-1 min-w-[16px] h-[16px] px-1 bg-error text-slate-900 text-[9px] font-extrabold rounded-full flex items-center justify-center border border-white dark:border-slate-900" x-text="unreadNotificationsCount"></span>
                        </template>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-cloak
                         class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-xl shadow-2xl z-50 overflow-hidden text-slate-800 dark:text-slate-100 transition-colors">
                        
                        <div class="px-4 py-3 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center bg-slate-50 dark:bg-slate-900/50">
                           <h4 class="font-bold text-xs uppercase tracking-wider text-slate-700 dark:text-slate-300">Notifications</h4>
                           <template x-if="unreadNotificationsCount > 0">
                               <button @click="markAllNotificationsAsRead()" class="text-[10px] text-blue-600 dark:text-blue-400 hover:underline font-bold">Tout lire</button>
                           </template>
                        </div>
                        
                        <div class="max-h-80 overflow-y-auto custom-scrollbar divide-y divide-slate-100 dark:divide-slate-800/50">
                            <template x-for="n in notifications" :key="n.id">
                                <div @click="markNotificationAsRead(n); open = false" 
                                     :class="n.is_read ? 'opacity-60' : 'bg-blue-600/5 font-semibold'" 
                                     class="p-4 hover:bg-slate-50 dark:hover:bg-slate-900/50 cursor-pointer transition-colors flex gap-3 text-left">
                                    
                                    <div class="flex-shrink-0 mt-0.5">
                                        <template x-if="n.type === 'meeting_booked' || n.type === 'meeting_cancelled' || n.type === 'meeting_deleted'">
                                            <span class="material-symbols-outlined text-tertiary text-lg">video_call</span>
                                        </template>
                                        <template x-if="n.type === 'course_approved' || n.type === 'new_course'">
                                            <span class="material-symbols-outlined text-secondary text-lg">check_circle</span>
                                        </template>
                                        <template x-if="n.type === 'course_rejected' || n.type === 'course_suspended'">
                                            <span class="material-symbols-outlined text-error text-lg">block</span>
                                        </template>
                                        <template x-if="n.type === 'new_follower' || n.type === 'new_subscription'">
                                            <span class="material-symbols-outlined text-blue-500 text-lg">person_add</span>
                                        </template>
                                        <template x-if="n.type === 'account_status'">
                                            <span class="material-symbols-outlined text-indigo-500 text-lg">manage_accounts</span>
                                        </template>
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-slate-800 dark:text-slate-100 truncate" x-text="n.title"></p>
                                        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5 leading-relaxed" x-text="n.message"></p>
                                        <span class="text-[8px] text-outline mt-1 block" x-text="new Date(n.created_at).toLocaleString('fr-FR', {dateStyle: 'short', timeStyle: 'short'})"></span>
                                    </div>
                                </div>
                            </template>
                            <template x-if="notifications.length === 0">
                                <p class="p-6 text-center text-xs text-outline italic">Aucune notification pour le moment.</p>
                            </template>
                        </div>
                    </div>

                    <!-- Global Toast Container (Fixed bottom left) -->
                    <div class="fixed bottom-4 left-4 z-50 flex flex-col gap-2 pointer-events-none max-w-sm">
                        <template x-for="t in toasts" :key="t.id">
                            <div @click="markNotificationAsRead(t)"
                                 class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-2xl flex items-start gap-3 pointer-events-auto cursor-pointer transform hover:scale-105 transition-all duration-300 border-l-4 border-l-blue-600 animate-slide-in">
                                <div class="flex-shrink-0">
                                    <span class="material-symbols-outlined text-blue-500">notifications_active</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-100" x-text="t.title"></p>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5" x-text="t.message"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800"></div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ Auth::user()->name }}</p>
                        <p class="text-[9px] text-outline truncate max-w-[150px]">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-blue-500/10 border border-outline-variant/50">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-blue-500 text-[10px] font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- =========================================================== -->
        <div x-show="showMessenger"
             x-cloak
             class="fixed right-0 top-16 h-[calc(100vh-64px)] w-[260px] bg-slate-950 border-l border-slate-800 z-50 flex flex-col shadow-2xl"
             @click.away="showMessenger = false">
            <div class="p-4 border-b border-slate-800">
                <h4 class="font-bold text-sm text-slate-100">Mes Étudiants</h4>
                <p class="text-[10px] text-outline mt-0.5">Cliquez pour ouvrir un chat</p>
            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @forelse($students as $student)
                <button
                    @click="
                        showMessenger = false;
                        markMessagesAsRead({{ $student->id }});
                        fetch('/messages/start/{{ $student->id }}')
                            .then(r => r.json())
                            .then(conv => {
                                let existingChat = openChats.find(c => c.id === {{ $student->id }});
                                if(!existingChat) {
                                    openChats.push({
                                        id: {{ $student->id }},
                                        name: {{ json_encode($student->name) }},
                                        minimized: false,
                                        conversation_id: conv.id,
                                        is_online: conv.partner_is_online,
                                        messages: [],
                                        newMessage: '',
                                        loading: true
                                    });
                                } else {
                                    existingChat.minimized = false;
                                }
                            })
                    "
                    class="w-full p-3 hover:bg-slate-900 flex items-center gap-3 border-b border-slate-800/40 transition-colors">
                    <div class="relative flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-secondary/20 text-secondary flex items-center justify-center font-bold text-xs border border-secondary/20">
                            @if($student->avatar)
                                <img src="{{ asset('storage/' . $student->avatar) }}" alt="" class="w-full h-full object-cover">
                            @else
                                {{ substr($student->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-slate-950"
                             :class="userStatuses[{{ $student->id }}] ? 'bg-secondary' : 'bg-error'"></div>
                    </div>
                    <div class="text-left flex-1 min-w-0">
                        <div class="flex justify-between items-center gap-2">
                            <span class="text-sm font-semibold text-slate-200 block truncate">{{ $student->name }}</span>
                            <template x-if="(unreadMessagesBySender[{{ $student->id }}] || 0) > 0">
                                <span class="bg-blue-600 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full" x-text="unreadMessagesBySender[{{ $student->id }}]"></span>
                            </template>
                        </div>
                        <p class="text-[10px] text-outline truncate">
                            @if($student->last_message)
                                <span class="text-blue-400 font-bold">{{ $student->last_message->user_id === Auth::id() ? 'Vous : ' : '' }}</span>
                                {{ $student->last_message->body }}
                            @else
                                {{ $student->email }}
                            @endif
                        </p>
                    </div>
                </button>
                @empty
                <p class="p-6 text-xs text-outline text-center italic">Aucun étudiant.</p>
                @endforelse
            </div>
        </div>

        <!-- =========================================================== -->
        <!-- CONTENU PRINCIPAL                                           -->
        <!-- =========================================================== -->
        <div class="p-8 max-w-6xl mx-auto w-full">

            @if(session('success'))
            <div class="mb-6 p-4 bg-secondary/10 border border-secondary text-secondary rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
            @endif

            <!-- DASHBOARD -->
            <div x-show="activeTab === 'dashboard'" x-cloak class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">Total Contenus</p>
                        <p class="text-3xl font-black">{{ $stats['total_courses'] }}</p>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">Publiés</p>
                        <p class="text-3xl font-black text-secondary">{{ $stats['published_courses'] }}</p>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">En attente</p>
                        <p class="text-3xl font-black text-tertiary">{{ $stats['pending_courses'] }}</p>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">Étudiants</p>
                        <p class="text-3xl font-black">{{ $students->count() }}</p>
                    </div>
                </div>

                <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                    <h3 class="text-xl font-bold mb-6">Activités Récentes</h3>
                    <div class="space-y-4">
                        @forelse($recentCourses as $course)
                        <div class="flex items-center justify-between p-4 bg-background rounded-xl border border-outline-variant/30">
                            <div class="flex items-center gap-4">
                                @if($course->thumbnail_path)
                                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-outline-variant/30">
                                        <img src="{{ asset('storage/' . $course->thumbnail_path) }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center border border-outline-variant/30">
                                        <span class="material-symbols-outlined text-blue-500">article</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-sm">{{ $course->title }}</p>
                                    <p class="text-[10px] text-outline">{{ $course->subject->name }} • {{ $course->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button data-url="{{ asset('storage/' . $course->file_path) }}"
                                        data-title="{{ $course->title }}"
                                        @click="$dispatch('open-preview', { url: $el.dataset.url, title: $el.dataset.title })"
                                        class="p-2 text-outline hover:text-secondary transition-colors" title="Aperçu">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                </button>
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $course->status === 'published' ? 'bg-secondary/10 text-secondary' : ($course->status === 'rejected' ? 'bg-error/10 text-error' : 'bg-tertiary/10 text-tertiary') }}">
                                    {{ $course->status }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-outline italic py-8">Aucune activité pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- MES CONTENUS -->
            <div x-show="activeTab === 'content'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Mes Contenus Pédagogiques</h3>
                    <button @click="$dispatch('open-modal', 'upload-course')"
                            class="bg-primary text-slate-900 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:opacity-90">
                        <span class="material-symbols-outlined">add</span> Envoyer un cours
                    </button>
                </div>

                <!-- FILTRES DE COURS -->
                <form action="{{ route('teacher.dashboard') }}" method="GET" class="bg-surface-container-low p-4 rounded-xl border border-outline-variant/30 flex flex-wrap gap-4 items-end">
                    <input type="hidden" name="tab" value="content">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-semibold text-outline mb-1.5 uppercase">Matière</label>
                        <select name="subject_id" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-slate-200 text-xs">
                            <option value="">Toutes mes matières</option>
                            @foreach($mySubjects as $s)
                                <option value="{{ $s->id }}" {{ request('subject_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-semibold text-outline mb-1.5 uppercase">Niveau</label>
                        <select name="level_id" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-slate-200 text-xs">
                            <option value="">Tous les niveaux</option>
                            @foreach($myLevels as $l)
                                <option value="{{ $l->id }}" {{ request('level_id') == $l->id ? 'selected' : '' }}>{{ $l->name }} ({{ $l->category }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-primary text-slate-900 px-4 py-2 rounded-xl text-xs font-bold hover:opacity-90 transition-opacity">
                            Filtrer
                        </button>
                        @if(request('subject_id') || request('level_id'))
                            <a href="{{ route('teacher.dashboard', ['tab' => 'content']) }}" class="bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-700 transition-colors">
                                Réinitialiser
                            </a>
                        @endif
                    </div>
                </form>

                <div class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden shadow-lg transition-colors">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low text-[10px] uppercase text-outline font-black border-b border-outline-variant/30">
                            <tr>
                                <th class="px-6 py-4">Aperçu</th>
                                <th class="px-6 py-4">Détails du cours</th>
                                <th class="px-6 py-4">Matière & Niveau</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4">Date d'envoi</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/20">
                            @forelse($myCourses as $course)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-12 h-12 rounded-xl overflow-hidden border border-outline-variant/30 flex items-center justify-center shadow-sm bg-white dark:bg-slate-950">
                                        @if($course->thumbnail_path)
                                            <img src="{{ asset('storage/' . $course->thumbnail_path) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-red-500/10 text-red-500 dark:text-red-400">
                                                <span class="material-symbols-outlined text-2xl">picture_as_pdf</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 min-w-[200px]">
                                    <button data-url="{{ asset('storage/' . $course->file_path) }}"
                                            data-title="{{ $course->title }}"
                                            @click="$dispatch('open-preview', { url: $el.dataset.url, title: $el.dataset.title })"
                                            class="font-bold text-sm text-slate-800 dark:text-white hover:text-primary dark:hover:text-secondary transition-colors text-left truncate max-w-xs block focus:outline-none">
                                        {{ $course->title }}
                                    </button>
                                    <p class="text-[11px] text-outline truncate max-w-xs mt-0.5" title="{{ $course->description }}">{{ $course->description ?: 'Aucune description fournie' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1 items-start">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20">
                                            {{ $course->subject->name }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-slate-500/10 text-slate-600 dark:text-slate-400 border border-slate-500/20">
                                            {{ $course->level ? $course->level->name : 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($course->type === 'course')
                                        <span class="px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20">
                                            Cours
                                        </span>
                                    @elseif($course->type === 'sujet_type')
                                        <span class="px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/20">
                                            Sujet Type
                                        </span>
                                    @elseif($course->type === 'correction')
                                        <span class="px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-teal-500/10 text-teal-600 dark:text-teal-400 border border-teal-500/20">
                                            Corrigé
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-slate-500/10 text-slate-600 dark:text-slate-400 border border-slate-500/20">
                                            {{ $course->type }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($course->status === 'published')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-secondary/15 text-secondary border border-secondary/35">
                                            <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                            Publié
                                        </span>
                                    @elseif($course->status === 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-error/15 text-error border border-error/35">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error"></span>
                                            Rejeté
                                        </span>
                                    @elseif($course->status === 'suspended')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-amber-500/15 text-amber-500 border border-amber-500/35">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Suspendu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-extrabold uppercase bg-tertiary/15 text-tertiary border border-tertiary/35">
                                            <span class="w-1.5 h-1.5 rounded-full bg-tertiary animate-pulse"></span>
                                            En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-outline font-semibold">
                                    {{ $course->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button data-url="{{ asset('storage/' . $course->file_path) }}"
                                                data-title="{{ $course->title }}"
                                                @click="$dispatch('open-preview', { url: $el.dataset.url, title: $el.dataset.title })"
                                                class="w-8 h-8 rounded-lg border border-outline-variant/30 flex items-center justify-center text-slate-500 hover:text-secondary hover:bg-secondary/10 hover:border-secondary/35 transition-all"
                                                title="Aperçu rapide">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </button>
                                        <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank"
                                           class="w-8 h-8 rounded-lg border border-outline-variant/30 flex items-center justify-center text-slate-500 hover:text-primary hover:bg-primary/10 hover:border-primary/35 transition-all"
                                           title="Télécharger">
                                            <span class="material-symbols-outlined text-[18px]">download</span>
                                        </a>
                                        @if($course->status === 'published')
                                            <button data-course-id="{{ $course->id }}"
                                                    data-course-title="{{ $course->title }}"
                                                    @click="$dispatch('open-create-meeting', { courseId: $el.dataset.courseId, courseTitle: $el.dataset.courseTitle })"
                                                    class="w-8 h-8 rounded-lg border border-outline-variant/30 flex items-center justify-center text-slate-500 hover:text-tertiary hover:bg-tertiary/10 hover:border-tertiary/35 transition-all"
                                                    title="Créer une réunion live">
                                                <span class="material-symbols-outlined text-[18px]">video_call</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-outline italic">Aucun cours trouvé.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MES SPÉCIALITÉS -->
            <div x-show="activeTab === 'subjects'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Mes Spécialités</h3>
                        <p class="text-outline text-sm">Gérez les matières que vous enseignez.</p>
                    </div>
                    <button @click="$dispatch('open-modal', 'add-subject')"
                            class="bg-slate-800 border border-slate-700 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-slate-700">
                        <span class="material-symbols-outlined">add</span> Ajouter une matière
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($mySubjects as $subject)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl">{{ $subject->icon ?: 'school' }}</span>
                            </div>
                            <div>
                                <p class="font-bold">{{ $subject->name }}</p>
                                <p class="text-[10px] text-outline uppercase tracking-wider">{{ $subject->level ? $subject->level->name : 'N/A' }}</p>
                            </div>
                        </div>
                        <form action="{{ route('teacher.subjects.remove', $subject->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-2 text-error opacity-0 group-hover:opacity-100 transition-opacity hover:bg-error/10 rounded-full"
                                    onclick="return confirm('Retirer cette matière ?')">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- ÉTUDIANTS -->
            <div x-show="activeTab === 'students'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Mes Étudiants</h3>
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-bold">
                        {{ $students->count() }} étudiants
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($students as $student)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center font-bold">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-sm">{{ $student->name }}</p>
                                <p class="text-xs text-outline">{{ $student->email }}</p>
                            </div>
                        </div>
                        <!-- Bouton chat direct depuis la carte étudiant -->
                        <button
                            @click="
                                markMessagesAsRead({{ $student->id }});
                                fetch('/messages/start/{{ $student->id }}')
                                    .then(r => r.json())
                                    .then(conv => {
                                        if(!openChats.find(c => c.id === {{ $student->id }})) {
                                            openChats.push({
                                                id: {{ $student->id }},
                                                name: {{ json_encode($student->name) }},
                                                minimized: false,
                                                conversation_id: conv.id,
                                                messages: [],
                                                newMessage: ''
                                            })
                                        }
                                    })
                            "
                            class="p-2 text-outline hover:text-secondary hover:bg-secondary/10 rounded-full transition-colors"
                            title="Envoyer un message">
                            <span class="material-symbols-outlined text-sm">chat</span>
                        </button>
                    </div>
                    @empty
                    <div class="col-span-3 bg-surface-container rounded-xl border border-outline-variant p-12 text-center text-outline italic">
                        Aucun étudiant ne vous suit pour le moment.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- LIVE COURSES -->
            <div x-show="activeTab === 'live'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Live Courses</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($meetings as $meeting)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex flex-col group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center">
                                    <span class="material-symbols-outlined">video_camera_front</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm">{{ $meeting->course->title }}</h4>
                                    <p class="text-[10px] text-outline uppercase font-black">{{ $meeting->course->subject->name }} • {{ $meeting->course->level->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 mb-6">
                            <p class="text-xs text-slate-300 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-outline">calendar_month</span>
                                <span>{{ \Carbon\Carbon::parse($meeting->start_at)->translatedFormat('l d F Y') }}</span>
                            </p>
                            <p class="text-xs text-slate-300 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-outline">schedule</span>
                                <span>{{ \Carbon\Carbon::parse($meeting->start_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($meeting->end_at)->format('H:i') }}</span>
                            </p>
                            <p class="text-xs flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-outline">person</span>
                                @if($meeting->student)
                                    <span class="text-secondary font-semibold">Réservé par {{ $meeting->student->name }}</span>
                                @else
                                    <span class="text-tertiary">Créneau libre / Non réservé</span>
                                @endif
                            </p>
                        </div>
                        <div class="mt-auto pt-4 border-t border-outline-variant/20 flex gap-4">
                            <a href="{{ route('meetings.join', $meeting->id) }}" target="_blank" class="flex-1 text-center py-2.5 bg-primary text-slate-900 text-xs font-bold rounded-xl hover:opacity-90 transition-opacity">
                                Rejoindre le Live
                            </a>
                            <form action="{{ route('teacher.meetings.destroy', $meeting->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette réunion ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-error hover:bg-error/10 rounded-xl transition-colors border border-outline-variant/30">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 bg-surface-container rounded-xl border border-outline-variant p-12 text-center">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">video_call</span>
                        <p class="text-outline italic">Vous n'avez créé aucune visioconférence pour le moment.</p>
                        <p class="text-outline text-sm mt-1">Vous pouvez en créer une à partir de la liste de vos cours dans l'onglet "Mes Contenus".</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- ANALYTICS -->
            <div x-show="activeTab === 'analytics'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Statistiques & Analytics</h3>
                    <span class="text-xs text-outline">Mis à jour en temps réel</span>
                </div>

                <!-- KPI Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-6 flex flex-col justify-between shadow-lg">
                        <div class="flex items-center justify-between text-outline mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider">Abonnés</span>
                            <span class="material-symbols-outlined text-secondary text-2xl">group</span>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-white mb-1">{{ $stats['total_students'] }}</p>
                            <p class="text-[10px] text-outline">Élèves qui vous suivent</p>
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-6 flex flex-col justify-between shadow-lg">
                        <div class="flex items-center justify-between text-outline mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider">Visioconférences</span>
                            <span class="material-symbols-outlined text-primary text-2xl">video_call</span>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-white mb-1">{{ $stats['total_meetings'] }}</p>
                            <p class="text-[10px] text-outline">Créneaux créés au total</p>
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-6 flex flex-col justify-between shadow-lg">
                        <div class="flex items-center justify-between text-outline mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider">Taux d'occupation</span>
                            <span class="material-symbols-outlined text-tertiary text-2xl">percent</span>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-white mb-1">{{ $stats['occupancy_rate'] }}%</p>
                            <p class="text-[10px] text-outline">{{ $stats['booked_meetings'] }} sur {{ $stats['total_meetings'] }} réservés</p>
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-6 flex flex-col justify-between shadow-lg">
                        <div class="flex items-center justify-between text-outline mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider">Cours validés</span>
                            <span class="material-symbols-outlined text-green-500 text-2xl">verified</span>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-white mb-1">{{ $stats['published_courses'] }}</p>
                            <p class="text-[10px] text-outline">Sur {{ $stats['total_courses'] }} cours envoyés</p>
                        </div>
                    </div>
                </div>

                <!-- Graphiques -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Graphique répartition matières -->
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-6 shadow-lg flex flex-col">
                        <h4 class="font-bold text-sm mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">pie_chart</span> Répartition des cours par matière
                        </h4>
                        <div class="flex-1 flex items-center justify-center p-4">
                            @if(count($coursesPerSubject) > 0)
                                <div class="w-full max-w-[280px]">
                                    <canvas id="subjectChart"></canvas>
                                </div>
                            @else
                                <p class="text-xs text-outline italic">Aucune donnée disponible</p>
                            @endif
                        </div>
                    </div>

                    <!-- Graphique abonnés par cours -->
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-6 shadow-lg flex flex-col">
                        <h4 class="font-bold text-sm mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">bar_chart</span> Top 5 des cours les plus populaires (abonnés)
                        </h4>
                        <div class="flex-1 flex items-center justify-center p-4">
                            @if(count($subscribersPerCourse) > 0)
                                <canvas id="popularityChart"></canvas>
                            @else
                                <p class="text-xs text-outline italic">Aucun cours publié ou aucun abonné</p>
                            @endif
                        </div>
                    </div>
                </div>

                @if(count($coursesPerSubject) > 0 || count($subscribersPerCourse) > 0)
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Configuration globale de Chart.js pour correspondre au thème Studa
                        Chart.defaults.color = '#8c909f';
                        Chart.defaults.font.family = 'Inter, sans-serif';

                        @if(count($coursesPerSubject) > 0)
                        // Données Matières
                        const subjectLabels = {!! json_encode($coursesPerSubject->pluck('label')) !!};
                        const subjectValues = {!! json_encode($coursesPerSubject->pluck('value')) !!};

                        const ctxSubject = document.getElementById('subjectChart').getContext('2d');
                        new Chart(ctxSubject, {
                            type: 'doughnut',
                            data: {
                                labels: subjectLabels,
                                datasets: [{
                                    data: subjectValues,
                                    backgroundColor: [
                                        'rgba(173, 198, 255, 0.75)', // Primary
                                        'rgba(78, 222, 163, 0.75)',  // Secondary
                                        'rgba(255, 185, 95, 0.75)',  // Tertiary
                                        'rgba(255, 180, 171, 0.75)', // Error
                                        'rgba(202, 188, 255, 0.75)'  // Autre
                                    ],
                                    borderColor: '#191f2f',
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            boxWidth: 12,
                                            padding: 15,
                                            font: { size: 10 }
                                        }
                                    }
                                }
                            }
                        });
                        @endif

                        @if(count($subscribersPerCourse) > 0)
                        // Données Popularité
                        const popLabels = {!! json_encode($subscribersPerCourse->pluck('label')) !!};
                        const popValues = {!! json_encode($subscribersPerCourse->pluck('value')) !!};

                        const ctxPop = document.getElementById('popularityChart').getContext('2d');
                        new Chart(ctxPop, {
                            type: 'bar',
                            data: {
                                labels: popLabels.map(l => l.length > 20 ? l.substring(0, 18) + '...' : l),
                                datasets: [{
                                    label: 'Nombre d\'élèves abonnés',
                                    data: popValues,
                                    backgroundColor: 'rgba(78, 222, 163, 0.75)',
                                    borderColor: '#4edea3',
                                    borderWidth: 1,
                                    borderRadius: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                indexAxis: 'y',
                                plugins: {
                                    legend: { display: false }
                                },
                                scales: {
                                    x: {
                                        grid: { color: 'rgba(66, 71, 84, 0.2)' },
                                        ticks: { precision: 0 }
                                    },
                                    y: {
                                        grid: { display: false }
                                    }
                                }
                            }
                        });
                        @endif
                    });
                </script>
                @endif
            </div>

            <!-- PARAMÈTRES -->
            <div x-show="activeTab === 'settings'" x-cloak class="space-y-8" x-data="{ settingsTab: 'profile' }">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold">Paramètres</h3>
                    <div class="flex bg-surface-container rounded-xl p-1 border border-outline-variant/30">
                        <button @click="settingsTab = 'profile'" 
                                :class="settingsTab === 'profile' ? 'bg-primary text-slate-900 shadow-lg' : 'text-outline hover:text-slate-200'"
                                class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">
                            Profil Public
                        </button>
                        <button @click="settingsTab = 'security'" 
                                :class="settingsTab === 'security' ? 'bg-primary text-slate-900 shadow-lg' : 'text-outline hover:text-slate-200'"
                                class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">
                            Sécurité
                        </button>
                    </div>
                </div>

                <form action="{{ route('teacher.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- SECTION PROFIL -->
                    <div x-show="settingsTab === 'profile'" x-transition class="space-y-6">
                        <div class="bg-surface-container rounded-2xl border border-outline-variant p-8 shadow-xl">
                            <h4 class="text-lg font-bold mb-8 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span>
                                Informations Personnelles
                            </h4>
                            
                            <!-- Section Photo de Profil -->
                            <div class="flex items-center gap-8 mb-10 p-6 bg-background/50 rounded-2xl border border-outline-variant/20">
                                <div class="relative group">
                                    <div class="w-32 h-32 rounded-full overflow-hidden bg-blue-500/10 border-4 border-primary/20 group-hover:border-primary/50 transition-all shadow-2xl">
                                        @if($user->avatar)
                                            <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                                        @else
                                            <div id="avatar-placeholder" class="w-full h-full flex items-center justify-center text-blue-500 text-5xl font-black">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <img id="avatar-preview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                                        @endif
                                    </div>
                                    <label for="avatar-input" class="absolute bottom-1 right-1 p-2 bg-primary text-slate-900 rounded-full cursor-pointer shadow-2xl hover:scale-110 transition-transform border-4 border-surface-container">
                                        <span class="material-symbols-outlined text-base">photo_camera</span>
                                    </label>
                                    <input type="file" id="avatar-input" name="avatar" class="hidden" accept="image/*" 
                                           onchange="const file = this.files[0]; if(file){ const reader = new FileReader(); reader.onload = (e) => { document.getElementById('avatar-preview').src = e.target.result; document.getElementById('avatar-preview').classList.remove('hidden'); const placeholder = document.getElementById('avatar-placeholder'); if(placeholder) placeholder.classList.add('hidden'); }; reader.readAsDataURL(file); }">
                                </div>
                                <div class="space-y-1">
                                    <h5 class="font-bold text-slate-100 text-lg">Photo de profil</h5>
                                    <p class="text-xs text-outline leading-relaxed max-w-xs">Mettez à jour votre photo pour que vos étudiants puissent vous reconnaître plus facilement.</p>
                                    <p class="text-[10px] text-primary uppercase font-black tracking-widest pt-2">JPG, PNG ou GIF • Max 2Mo</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Nom complet</label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                           class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Email professionnel</label>
                                    <input type="email" name="email" value="{{ $user->email }}"
                                           class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Titre professionnel</label>
                                    <input type="text" name="professional_title" value="{{ $user->professional_title }}"
                                           placeholder="Ex: Professeur de Mathématiques"
                                           class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Expérience</label>
                                    <input type="text" name="experience" value="{{ $user->experience }}"
                                           placeholder="Ex: 10 ans d'enseignement"
                                           class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                </div>
                                <div class="md:col-span-2 space-y-2">
                                    <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Biographie</label>
                                    <textarea name="bio" rows="5" 
                                              placeholder="Présentez-vous brièvement à vos futurs étudiants..."
                                              class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4 resize-none">{{ $user->bio }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION SÉCURITÉ -->
                    <div x-show="settingsTab === 'security'" x-transition class="space-y-6">
                        <div class="bg-surface-container rounded-2xl border border-outline-variant p-8 shadow-xl">
                            <h4 class="text-lg font-bold mb-8 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">shield</span>
                                Sécurité du Compte
                            </h4>

                            <div class="max-w-xl space-y-8">
                                <div class="space-y-2">
                                <div class="space-y-2">
                                    <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Mot de passe actuel</label>
                                    <input type="password" name="current_password"
                                           placeholder="••••••••"
                                           class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                    <p class="text-[10px] text-outline italic">Requis pour modifier votre mot de passe.</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                                    <div class="space-y-2">
                                        <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Nouveau mot de passe</label>
                                        <input type="password" name="new_password"
                                               placeholder="Min. 8 caractères"
                                               class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-xs font-black text-outline uppercase tracking-widest ml-1">Confirmation</label>
                                        <input type="password" name="new_password_confirmation"
                                               placeholder="Confirmez"
                                               class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all py-3 px-4">
                                    </div>
                                </div>

                                <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl flex items-start gap-3">
                                    <span class="material-symbols-outlined text-primary text-sm mt-0.5">info</span>
                                    <p class="text-[10px] text-blue-700 dark:text-blue-200 leading-relaxed">Assurez-vous d'utiliser un mot de passe fort et unique pour protéger l'accès à vos contenus pédagogiques et aux données de vos étudiants.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <button type="button" @click="activeTab = 'dashboard'" class="px-8 py-3 text-sm font-bold text-outline hover:text-white transition-colors">
                            Annuler
                        </button>
                        <button type="submit"
                                class="bg-primary text-slate-900 px-12 py-3 rounded-xl font-black text-sm uppercase tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>

        </div><!-- /p-8 -->
    </main>

    <!-- =========================================================== -->
    <!-- MODALS                                                       -->
    <!-- =========================================================== -->

    <!-- Modal Upload Course -->
    <div x-data="{ 
            show: false, 
            fileName: '', 
            isUploading: false, 
            progress: 0,
            reset() {
                this.fileName = '';
                this.isUploading = false;
                this.progress = 0;
            },
            handleFileChange(e) {
                const file = e.target.files[0];
                if (file) {
                    this.fileName = file.name;
                    this.isUploading = true;
                    this.progress = 0;
                    let interval = setInterval(() => {
                        this.progress += Math.floor(Math.random() * 15) + 5;
                        if (this.progress >= 100) {
                            this.progress = 100;
                            clearInterval(interval);
                        }
                    }, 150);
                }
            }
         }"
         x-show="show"
         @open-modal.window="if($event.detail === 'upload-course') { show = true; reset(); }"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm"
         x-cloak>
        <div @click.away="show = false; reset();"
             class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-lg w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Envoyer un nouveau contenu</h2>
            <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-2">Titre du cours</label>
                    <input type="text" name="title" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white" required
                           placeholder="Ex: Introduction à la thermodynamique">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Matière</label>
                        <select name="subject_id" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white" required>
                            @foreach($mySubjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->level ? $s->level->name : 'N/A' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Type</label>
                        <select name="type" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white" required>
                            <option value="course">Cours (PDF/Texte)</option>
                            <option value="sujet_type">Sujets Types</option>
                            <option value="correction">Corrigé</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Miniature (Thumbnail)</label>
                    <input type="file" name="thumbnail"
                           class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-slate-900 hover:file:bg-primary/90"
                           accept="image/*">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Description (optionnel)</label>
                    <textarea name="description" rows="3" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white"></textarea>
                </div>

                <div class="p-8 border-2 border-dashed border-outline-variant rounded-xl text-center hover:border-primary transition-colors bg-background/50 relative overflow-hidden">
                    <input type="file" name="file" id="file" class="hidden" required accept=".pdf,.doc,.docx,.txt" @change="handleFileChange">
                    
                    <template x-if="!fileName">
                        <label for="file" class="cursor-pointer block">
                            <span class="material-symbols-outlined text-4xl text-outline mb-2">upload_file</span>
                            <p class="text-sm font-bold">Cliquez pour choisir un fichier</p>
                            <p class="text-xs text-outline mt-1">PDF, Word ou Texte (Max 10MB)</p>
                        </label>
                    </template>

                    <template x-if="fileName">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center gap-3 mb-4 w-full">
                                <span class="material-symbols-outlined text-3xl text-primary">description</span>
                                <div class="text-left flex-1 min-w-0">
                                    <p class="text-sm font-bold text-slate-800 dark:text-white truncate" x-text="fileName"></p>
                                    <p class="text-[10px] text-outline uppercase tracking-widest" x-text="progress < 100 ? 'Importation en cours...' : 'Fichier prêt'"></p>
                                </div>
                                <button type="button" @click="reset(); document.getElementById('file').value = ''" class="text-error hover:bg-error/10 p-1 rounded-full">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>
                            
                            <!-- Barre de progression -->
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="h-full bg-primary transition-all duration-300" :style="`width: ${progress}%`"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-primary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="isUploading && progress < 100">
                        Envoyer pour validation
                    </button>
                    <button type="button" @click="show = false; reset();" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Subject -->
    <div x-data="{ show: false }"
         x-show="show"
         @open-modal.window="if($event.detail === 'add-subject') show = true"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm"
         x-cloak>
        <div @click.away="show = false"
             class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-md w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Ajouter une spécialité</h2>
            <form action="{{ route('teacher.subjects.add') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Matière à ajouter</label>
                    <select name="subject_id" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white" required>
                        @foreach($allSubjects->groupBy(fn($s) => $s->level->name ?? 'Autre') as $levelName => $levelSubjects)
                            <optgroup label="{{ $levelName }}" class="bg-slate-900 text-primary">
                                @foreach($levelSubjects as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-secondary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Ajouter</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Preview -->
    <div x-data="{ show: false, url: '', title: '' }"
         x-show="show"
         @open-preview.window="show = true; url = $event.detail.url; title = $event.detail.title"
         class="fixed inset-0 z-[70] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant w-full max-w-5xl h-[90vh] flex flex-col shadow-2xl overflow-hidden">
            <div class="p-4 border-b border-outline-variant flex justify-between items-center bg-slate-900">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="material-symbols-outlined text-secondary">visibility</span>
                    <h3 class="font-bold text-lg text-white truncate pr-4" x-text="title"></h3>
                </div>
                <button @click="show = false" class="p-2 hover:bg-slate-800 rounded-full text-outline hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="flex-1 bg-white overflow-hidden">
                <template x-if="url.toLowerCase().endsWith('.pdf')">
                    <iframe :src="url" class="w-full h-full border-none"></iframe>
                </template>
                <template x-if="!url.toLowerCase().endsWith('.pdf')">
                    <div class="w-full h-full flex items-center justify-center bg-slate-950 p-8">
                         <img :src="url" class="max-w-full max-h-full object-contain shadow-2xl">
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Modal Create Meeting -->
    <div x-data="{ show: false, courseId: null, courseTitle: '' }"
         x-show="show"
         @open-create-meeting.window="show = true; courseId = $event.detail.courseId; courseTitle = $event.detail.courseTitle"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm"
         x-cloak>
        <div @click.away="show = false"
             class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-md w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-2">Créer une réunion live</h2>
            <p class="text-outline text-xs mb-6 truncate" x-text="'Pour : ' + courseTitle"></p>
            <form action="{{ route('teacher.meetings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="course_id" :value="courseId">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Date et Heure de début</label>
                    <input type="datetime-local" name="start_at" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Date et Heure de fin</label>
                    <input type="datetime-local" name="end_at" class="w-full bg-background border-outline-variant rounded-xl text-slate-800 dark:text-white" required>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-secondary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Créer le créneau</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

<script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleIcon = document.getElementById('theme-toggle-icon');
    const htmlElement = document.documentElement;

    // Ajuster l'icône au chargement
    if (htmlElement.classList.contains('dark')) {
        themeToggleIcon.textContent = 'dark_mode';
    } else {
        themeToggleIcon.textContent = 'light_mode';
    }

    // Toggle event listener
    themeToggleBtn.addEventListener('click', () => {
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            themeToggleIcon.textContent = 'light_mode';
            localStorage.setItem('theme', 'light');
        } else {
            htmlElement.classList.add('dark');
            themeToggleIcon.textContent = 'dark_mode';
            localStorage.setItem('theme', 'dark');
        }
    });
</script>
</body>
</html>
