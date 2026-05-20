<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Studa | Dashboard Étudiant</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
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
            --primary: #2563eb; /* Blue 600 */
            --background: #f8fafc; /* Slate 50 */
            --surface: #ffffff;
            --surface-container: #ffffff; 
            --surface-container-high: #f1f5f9; /* Slate 100 */
            --surface-container-low: #f8fafc;
            --on-background: #0f172a; /* Slate 900 */
            --on-surface: #0f172a;
            --on-surface-variant: #475569; /* Slate 600 */
            --outline: #94a3b8;
            --outline-variant: #e2e8f0; /* Slate 200 */
            --secondary: #10b981; /* Emerald 500 */
            --tertiary: #f59e0b; /* Amber 500 */
            --error: #ef4444; /* Red 500 */
        }
        .dark {
            --primary: #adc6ff;
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
            --secondary: #4edea3;
            --tertiary: #ffb95f;
            --error: #ffb4ab;
        }

        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        [x-cloak] { display: none !important; }
        
        /* Scrollbar styles */
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
    </style>
    <script>
        // Initialiser le thème le plus tôt possible pour éviter le flash blanc
        if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && !window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Heartbeat global pour mettre à jour la présence de l'utilisateur
        setInterval(() => {
            fetch('/users/heartbeat', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
        }, 30000); // Toutes les 30 secondes

        // Signaler la déconnexion lors de la fermeture de l'onglet
        window.addEventListener('beforeunload', function() {
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            navigator.sendBeacon('/users/offline', formData);
        });
    </script>
</head>
<body class="bg-background text-on-background font-sans antialiased transition-colors duration-200" 
      x-data="{ 
        activeTab: '{{ request('tab', 'dashboard') }}', 
        showMessenger: false, 
        openChats: [],
        userStatuses: {
            @foreach($followedTeachers as $t) {{ $t->id }}: {{ $t->is_online ? 'true' : 'false' }}, @endforeach
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
        setInterval(() => { updateAllStatuses(); }, 8000);
      ">
    <!-- Sidebar -->
    <aside class="flex flex-col h-screen fixed z-50 bg-white dark:bg-slate-950 w-[260px] border-r border-slate-200 dark:border-slate-800 transition-colors">
        <a href="/" class="text-2xl font-black text-blue-600 dark:text-blue-500 px-6 py-8 block">Studa</a>
        
        <div class="px-6 mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center text-secondary font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <p class="font-bold text-sm text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Étudiant</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tableau de bord</span>
            </button>
            <button @click="activeTab = 'levels'" :class="activeTab === 'levels' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">layers</span>
                <span>Mon Niveau</span>
            </button>
            <button @click="activeTab = 'courses'" :class="activeTab === 'courses' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">menu_book</span>
                <span>Cours</span>
            </button>
            <button @click="activeTab = 'subscriptions'" :class="activeTab === 'subscriptions' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">subscriptions</span>
                <span>Mes Abonnements</span>
            </button>
            <button @click="activeTab = 'teachers'" :class="activeTab === 'teachers' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">school</span>
                <span>Profs</span>
            </button>
            <button @click="activeTab = 'live'" :class="activeTab === 'live' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">video_call</span>
                <span>Live Courses</span>
            </button>
            <button @click="activeTab = 'analytics'" :class="activeTab === 'analytics' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">insights</span>
                <span>Analytics</span>
            </button>
            <button @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
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

    <!-- Main Content -->
    <main class="ml-[260px] min-h-screen flex flex-col">
        <header class="flex items-center justify-between px-8 h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-colors">
            <h2 class="font-bold text-slate-800 dark:text-slate-100" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1).replace('_', ' ')"></h2>
            <div class="flex items-center gap-4">
                <!-- Theme Toggle Button -->
                <button id="theme-toggle" class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors focus:outline-none flex items-center justify-center">
                    <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
                </button>
                <button @click="showMessenger = !showMessenger" class="p-2 text-slate-500 dark:text-slate-400 hover:text-primary transition-colors relative">
                    <span class="material-symbols-outlined">chat</span>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-secondary rounded-full"></span>
                </button>
                <button class="p-2 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-100"><span class="material-symbols-outlined">notifications</span></button>
                <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800"></div>
                <p class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ Auth::user()->name }}</p>
            </div>
        </header>

        <!-- Chat Windows Area (Fixed at bottom right) -->
        <div class="fixed bottom-0 right-4 flex gap-3 z-50 items-end pointer-events-none">
            <template x-for="chat in openChats" :key="chat.id">
                <div class="w-96 bg-slate-900 rounded-t-xl shadow-2xl flex flex-col overflow-hidden text-slate-100 pointer-events-auto border border-slate-800">
                    <!-- Header -->
                    <div class="bg-slate-950 p-3 flex justify-between items-center border-b border-slate-800 cursor-pointer shadow-sm" @click="chat.minimized = !chat.minimized">
                        <div class="flex items-center gap-2">
                            <div class="relative">
                                <div class="w-8 h-8 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold text-[10px]" x-text="chat.name.charAt(0)"></div>
                                <!-- Point de statut -->
                                <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full border-2 border-slate-950"
                                     :class="userStatuses[chat.id] ? 'bg-secondary' : 'bg-error'"></div>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-sm text-slate-200" x-text="chat.name"></span>
                                <span class="text-[9px] uppercase tracking-tighter" :class="userStatuses[chat.id] ? 'text-secondary' : 'text-error'" x-text="userStatuses[chat.id] ? 'En ligne' : 'Hors ligne'"></span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <button @click.stop="chat.minimized = !chat.minimized" class="p-1 hover:bg-slate-800 rounded-full">
                                <span class="material-symbols-outlined text-[16px] text-slate-400">remove</span>
                            </button>
                            <button @click.stop="openChats = openChats.filter(c => c.id !== chat.id)" class="p-1 hover:bg-slate-800 rounded-full text-slate-400">
                                <span class="material-symbols-outlined text-[16px]">close</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Messages Body -->
                    <div x-show="!chat.minimized" 
                         class="h-96 overflow-y-auto p-4 bg-slate-900 flex flex-col gap-3 custom-scrollbar"
                         x-init="fetch(`/messages/${chat.conversation_id}`).then(r => r.json()).then(data => { chat.messages = data; });">
                    <template x-for="msg in chat.messages" :key="msg.id">
                        <div x-data="{ showPicker: false }" 
                             :class="msg.user_id === {{ Auth::id() }} ? 'self-end' : 'self-start'" 
                             class="max-w-[85%] group relative">
                            
                            <div :class="msg.user_id === {{ Auth::id() }} ? 'bg-blue-600 text-white' : 'bg-slate-800 text-slate-200'"
                                 class="p-3 rounded-2xl text-sm shadow-sm">
                                <span x-text="msg.body"></span>
                            </div>
                            
                            <!-- Affichage des réactions -->
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
                                        userIds.includes({{ Auth::id() }}) ? 'bg-blue-500/30 border-blue-500/50' : 'bg-slate-800 border-slate-700',
                                        msg.user_id === {{ Auth::id() }} ? 'cursor-default' : 'hover:scale-110 transition-transform'
                                    ]"
                                    class="flex items-center gap-1 px-1.5 py-0.5 rounded-full border text-[10px]">
                                        <span x-text="emoji"></span>
                                        <span class="font-bold" x-text="userIds.length"></span>
                                    </button>
                                </template>
                            </div>

                            <!-- Icône de réaction au survol (masquée pour ses propres messages) -->
                            <div x-show="msg.user_id !== {{ Auth::id() }}" 
                                 class="absolute top-0 transition-opacity z-10"
                                 :class="[
                                    msg.user_id === {{ Auth::id() }} ? 'right-full mr-2' : 'left-full ml-2',
                                    showPicker ? 'opacity-100' : 'opacity-0 group-hover:opacity-100'
                                 ]">
                                
                                <button @click="showPicker = !showPicker" 
                                        class="p-1 bg-slate-800 border border-slate-700 rounded-full text-slate-400 hover:text-primary hover:scale-110 transition-all shadow-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[14px]">add_reaction</span>
                                </button>

                                <!-- Menu d'emojis (s'affiche au clic) -->
                                <div x-show="showPicker" 
                                     @click.away="showPicker = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-90"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute top-full mt-2 flex bg-slate-800 border border-slate-700 rounded-full shadow-2xl p-1 z-20"
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
                    
                    <!-- Input Area -->
                    <div x-show="!chat.minimized" class="p-3 border-t border-slate-800 bg-slate-950 flex items-center gap-2">
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
                                }
                            })
                            .catch(e => console.error(e));
                        " class="flex w-full gap-2">
                            <input type="text" x-model="chat.newMessage" placeholder="Écrire un message..." class="flex-1 text-sm px-4 py-2 bg-slate-900 text-white rounded-full border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <button type="submit" class="text-blue-400 p-1 hover:bg-slate-800 rounded-full">
                                <span class="material-symbols-outlined">send</span>
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>

        <!-- Messenger Panel (Contacts only) -->
        <div x-show="showMessenger" x-cloak class="fixed right-0 top-16 h-[calc(100vh-64px)] w-[260px] bg-slate-950 border-l border-slate-800 z-40 flex flex-col shadow-2xl">
            <div class="p-4 border-b border-slate-800">
                <h4 class="font-bold text-sm">Contacts</h4>
            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @foreach($followedTeachers as $teacher)
                <button @click="
                    showMessenger = false; 
                    fetch('/messages/start/{{ $teacher->id }}')
                    .then(r => r.json())
                    .then(conv => {
                        if(!openChats.find(c => c.id === {{ $teacher->id }})) {
                            openChats.push({
                                id: {{ $teacher->id }}, 
                                name: {{ json_encode($teacher->name) }}, 
                                minimized: false, 
                                conversation_id: conv.id, 
                                is_online: conv.partner_is_online,
                                messages: []
                            })
                        }                    })" 
                        class="w-full p-3 hover:bg-slate-900 flex items-center gap-3 border-b border-slate-800/40 transition-colors">
                    <div class="relative flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center font-bold text-xs">{{ substr($teacher->name, 0, 1) }}</div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-slate-950"
                             :class="userStatuses[{{ $teacher->id }}] ? 'bg-secondary' : 'bg-error'"></div>
                    </div>
                    <div class="text-left flex-1 min-w-0">
                        <span class="text-sm font-semibold text-slate-200 block truncate">{{ $teacher->name }}</span>
                        <p class="text-[10px] text-outline truncate">
                            @if($teacher->last_message)
                                <span class="text-blue-400 font-bold">{{ $teacher->last_message->user_id === Auth::id() ? 'Vous : ' : '' }}</span>
                                {{ $teacher->last_message->body }}
                            @else
                                {{ $teacher->email }}
                            @endif
                        </p>
                    </div>
                </button>
                @endforeach
            </div>
        </div>

        <div class="p-8 max-w-6xl mx-auto w-full">
            @if(session('success'))
                <div class="mb-6 p-4 bg-secondary/10 border border-secondary text-secondary rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Section Dashboard -->
            <div x-show="activeTab === 'dashboard'" x-cloak class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">Cours suivis</p>
                        <p class="text-3xl font-black">{{ $stats['courses_count'] }}</p>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">Profs suivis</p>
                        <p class="text-3xl font-black text-primary">{{ $stats['teachers_count'] }}</p>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <p class="text-xs text-outline uppercase font-bold tracking-widest mb-2">Activité</p>
                        <p class="text-3xl font-black text-secondary">0</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                        <h3 class="text-xl font-bold mb-6">Continuer à apprendre</h3>
                        <div class="space-y-4">
                            @forelse($subscribedCourses->take(3) as $course)
                            <div class="p-4 bg-background rounded-xl border border-outline-variant/30 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-blue-500">picture_as_pdf</span>
                                    <div>
                                        <p class="font-bold text-sm">{{ $course->title }}</p>
                                        <p class="text-[10px] text-outline">{{ $course->teacher->name }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" class="p-2 text-primary hover:bg-primary/10 rounded-full">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </div>
                            @empty
                            <p class="text-center text-outline italic py-8">Aucun cours suivi pour le moment.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                        <h3 class="text-xl font-bold mb-6">Professeurs recommandés</h3>
                        <div class="space-y-4">
                            <p class="text-center text-outline italic py-8 text-sm">Découvrez des professeurs dans la section "Mon Niveau".</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Courses -->
            <div x-show="activeTab === 'courses'" x-cloak class="space-y-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h3 class="text-2xl font-bold">Liste des Cours</h3>
                    <form method="GET" action="{{ route('student.dashboard') }}" class="flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="bg-surface-container border border-outline-variant rounded-xl px-4 py-2 text-sm w-48">
                        <select name="level_id" class="bg-surface-container border border-outline-variant rounded-xl px-4 py-2 text-sm" onchange="this.form.submit()">
                            <option value="">Tous les niveaux</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ request('level_id') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                            @endforeach
                        </select>
                        <select name="subject_id" class="bg-surface-container border border-outline-variant rounded-xl px-4 py-2 text-sm" onchange="this.form.submit()">
                            <option value="">Toutes les matières</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                    <div class="bg-surface-container rounded-2xl border border-outline-variant p-5 flex flex-col group hover:border-primary transition-all">
                        <div class="h-40 bg-background rounded-xl mb-4 flex items-center justify-center border border-outline-variant/30 relative overflow-hidden">
                            <span class="absolute top-2 left-2 bg-slate-900 text-[10px] px-2 py-0.5 rounded text-primary border border-primary/20">{{ $course->level ? $course->level->name : 'N/A' }}</span>
                            @if($course->thumbnail_path)
                                <img src="{{ asset('storage/' . $course->thumbnail_path) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-4xl text-outline group-hover:text-primary">picture_as_pdf</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-sm mb-1">{{ $course->title }}</h4>
                            <p class="text-xs text-outline mb-4 line-clamp-2">{{ $course->description }}</p>
                        </div>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] bg-slate-800 text-outline px-2 py-1 rounded">{{ $course->subject->name }}</span>
                            @if(in_array($course->id, $subscribedCoursesIds))
                                <button disabled class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold uppercase rounded">Abonné</button>
                            @else
                                <form action="{{ route('student.courses.subscribe', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-primary text-slate-900 text-[10px] font-bold uppercase rounded hover:opacity-90">S'abonner</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{ $courses->links() }}
            </div>

            <!-- Section Levels -->
            <div x-show="activeTab === 'levels'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Choisir mes Niveaux</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($levels as $level)
                    <div class="bg-surface-container rounded-xl border {{ Auth::user()->levels->contains($level->id) ? 'border-secondary' : 'border-outline-variant' }} p-6">
                        <h5 class="font-bold text-lg mb-4">{{ $level->name }}</h5>
                        <form action="{{ route('student.levels.toggle', $level->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 {{ Auth::user()->levels->contains($level->id) ? 'bg-secondary text-slate-900' : 'bg-surface-container-high text-on-background' }} rounded-xl font-bold transition-all">
                                {{ Auth::user()->levels->contains($level->id) ? 'Sélectionné' : 'Sélectionner' }}
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Subscriptions -->
            <div x-show="activeTab === 'subscriptions'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Mes Cours Abonnés</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($subscribedCourses as $course)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex flex-col group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-red-500/10 text-red-500 flex items-center justify-center">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm">{{ $course->title }}</h4>
                                    <p class="text-[10px] text-outline uppercase font-black">{{ $course->subject ? $course->subject->name : 'N/A' }} • {{ $course->level ? $course->level->name : 'N/A' }}</p>
                                </div>
                            </div>
                            <form action="{{ route('student.courses.unsubscribe', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-full transition-colors" title="Se désabonner">
                                    <span class="material-symbols-outlined text-sm">bookmark_remove</span>
                                </button>
                            </form>
                        </div>
                        @php
                            // Obtenir les créneaux libres futurs pour ce cours
                            $freeMeetings = \App\Models\Meeting::where('course_id', $course->id)
                                ->whereNull('student_id')
                                ->where('start_at', '>', now())
                                ->orderBy('start_at')
                                ->get();
                        @endphp
                        
                        <div class="my-4 pt-4 border-t border-outline-variant/10">
                            @if($freeMeetings->isNotEmpty())
                                <p class="text-xs font-bold text-tertiary mb-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">schedule</span> Visios libres :
                                </p>
                                <div class="space-y-2 max-h-32 overflow-y-auto pr-1">
                                    @foreach($freeMeetings as $meeting)
                                        <div class="flex items-center justify-between bg-slate-900/50 p-2 rounded-lg border border-outline-variant/20 text-[10px]">
                                            <span class="text-slate-300">
                                                {{ \Carbon\Carbon::parse($meeting->start_at)->translatedFormat('d M à H:i') }} - {{ \Carbon\Carbon::parse($meeting->end_at)->format('H:i') }}
                                            </span>
                                            <form action="{{ route('student.meetings.book', $meeting->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-2 py-1 bg-secondary text-slate-900 font-bold rounded hover:opacity-90 transition-opacity">
                                                    Réserver
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-[10px] text-outline italic">Aucun créneau de live disponible.</p>
                            @endif
                        </div>

                        <div class="mt-auto flex items-center justify-between pt-4 border-t border-outline-variant/20">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center text-[10px] font-bold">
                                    {{ substr($course->teacher->name, 0, 1) }}
                                </div>
                                <span class="text-[10px] text-slate-300">{{ $course->teacher->name }}</span>
                            </div>
                            <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" class="px-3 py-1 bg-primary text-slate-900 text-[10px] font-bold rounded-lg hover:opacity-90">Lire le cours</a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 bg-surface-container rounded-xl border border-outline-variant p-12 text-center">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">subscriptions</span>
                        <p class="text-outline italic">Vous n'êtes abonné à aucun cours pour le moment.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Section Teachers -->
            <div x-show="activeTab === 'teachers'" x-cloak class="space-y-8" x-data="{ searchQuery: '' }">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Professeurs</h3>
                    <input type="text" x-model="searchQuery" placeholder="Rechercher un professeur..." class="bg-surface-container border border-outline-variant rounded-xl px-4 py-2 text-sm w-64">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($allTeachers as $teacher)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex flex-col items-center text-center group" x-show="'{{ strtolower($teacher->name) }}'.includes(searchQuery.toLowerCase())">
                        <div class="w-20 h-20 rounded-full bg-blue-500/10 text-blue-500 flex items-center justify-center text-2xl font-bold mb-4">
                            {{ substr($teacher->name, 0, 1) }}
                        </div>
                        <h4 class="font-bold">{{ $teacher->name }}</h4>
                        <p class="text-xs text-outline mb-2">{{ $teacher->email }}</p>
                        <div class="flex flex-wrap justify-center gap-1 mb-6">
                            @foreach($teacher->subjects as $subject)
                                <span class="px-2 py-0.5 bg-background rounded text-[8px] font-bold text-slate-400 uppercase tracking-tighter border border-outline-variant/30">{{ $subject->name }}</span>
                            @endforeach
                        </div>
                        
                        @if($followedTeachers->contains($teacher->id))
                            <form action="{{ route('student.teachers.unfollow', $teacher->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2 border border-error text-error text-xs font-bold rounded-xl hover:bg-error/10 transition-colors">Ne plus suivre</button>
                            </form>
                        @else
                            <form action="{{ route('student.teachers.follow', $teacher->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-primary text-slate-900 text-xs font-bold rounded-xl hover:opacity-90 transition-opacity">Suivre</button>
                            </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Live -->
            <div x-show="activeTab === 'live'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Live Courses</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($myMeetings as $meeting)
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
                            <p class="text-xs text-slate-300 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-outline">school</span>
                                <span>Professeur : <strong class="text-primary">{{ $meeting->teacher->name }}</strong></span>
                            </p>
                        </div>
                        <div class="mt-auto pt-4 border-t border-outline-variant/20 flex gap-4">
                            <a href="{{ route('meetings.join', $meeting->id) }}" target="_blank" class="flex-1 text-center py-2.5 bg-primary text-slate-900 text-xs font-bold rounded-xl hover:opacity-90 transition-opacity">
                                Rejoindre le Live
                            </a>
                            <form action="{{ route('student.meetings.cancel', $meeting->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler votre réservation ?')">
                                @csrf
                                <button type="submit" class="p-2.5 text-error hover:bg-error/10 rounded-xl transition-colors border border-outline-variant/30" title="Annuler la réservation">
                                    <span class="material-symbols-outlined text-sm">cancel</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 bg-surface-container rounded-xl border border-outline-variant p-12 text-center">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">video_call</span>
                        <p class="text-outline italic font-bold">Aucun live prévu actuellement.</p>
                        <p class="text-outline text-sm mt-1">Vous pouvez réserver des créneaux de visioconférence libres depuis l'onglet "Mes Abonnements".</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Section Analytics (Placeholder) -->
            <div x-show="activeTab === 'analytics'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Mes Progrès</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                        <h4 class="font-bold mb-4 flex items-center gap-2"><span class="material-symbols-outlined">menu_book</span> Lectures par matière</h4>
                        <div class="h-48 bg-background rounded-xl border border-dashed border-outline-variant flex items-center justify-center text-outline text-xs italic">
                            Graphique d'apprentissage (bientôt disponible)
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                        <h4 class="font-bold mb-4 flex items-center gap-2"><span class="material-symbols-outlined">timer</span> Temps d'étude</h4>
                        <div class="h-48 bg-background rounded-xl border border-dashed border-outline-variant flex items-center justify-center text-outline text-xs italic">
                            Statistiques de temps (bientôt disponible)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Settings -->
            <div x-show="activeTab === 'settings'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Paramètres du Compte</h3>
                <div class="max-w-2xl bg-surface-container rounded-xl border border-outline-variant p-8">
                    <form action="{{ route('student.settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-outline">Nom complet</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-background border-outline-variant rounded-xl text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2 text-outline">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-background border-outline-variant rounded-xl text-white">
                            </div>
                        </div>

                        <hr class="border-outline-variant/30">
                        
                        <p class="text-xs font-bold text-primary uppercase tracking-widest">Sécurité</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-outline">Mot de passe actuel</label>
                                <input type="password" name="current_password" class="w-full bg-background border-outline-variant rounded-xl text-white">
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2 text-outline">Nouveau mot de passe</label>
                                    <input type="password" name="new_password" class="w-full bg-background border-outline-variant rounded-xl text-white">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2 text-outline">Confirmation</label>
                                    <input type="password" name="new_password_confirmation" class="w-full bg-background border-outline-variant rounded-xl text-white">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="bg-secondary text-slate-900 px-8 py-3 rounded-xl font-bold hover:opacity-90 transition-opacity">
                            Mettre à jour mon profil
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

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
