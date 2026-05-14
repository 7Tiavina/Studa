<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Studa | Dashboard Professeur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#adc6ff",
                        "background": "#0c1322",
                        "surface": "#0c1322",
                        "surface-container": "#191f2f",
                        "surface-container-high": "#232a3a",
                        "surface-container-low": "#141b2b",
                        "on-background": "#dce2f7",
                        "on-surface": "#dce2f7",
                        "on-surface-variant": "#c2c6d6",
                        "outline": "#8c909f",
                        "outline-variant": "#424754",
                        "secondary": "#4edea3",
                        "tertiary": "#ffb95f",
                        "error": "#ffb4ab",
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #0c1322; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #424754; border-radius: 10px; }
    </style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-background text-on-background font-sans antialiased" x-data="{ activeTab: 'dashboard', showMessenger: false, openChats: [] }">
    <!-- Chat Windows Area -->
    <div class="fixed bottom-0 right-4 flex gap-3 z-50 items-end pointer-events-none">
        <template x-for="chat in openChats" :key="chat.id">
            <div class="w-80 bg-white rounded-t-xl shadow-2xl flex flex-col overflow-hidden text-slate-800 pointer-events-auto border border-slate-200">
                <div class="bg-white p-3 flex justify-between items-center border-b border-gray-100 cursor-pointer shadow-sm" @click="chat.minimized = !chat.minimized">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-[10px]" x-text="chat.name.charAt(0)"></div>
                        <span class="font-bold text-sm text-slate-800" x-text="chat.name"></span>
                    </div>
                    <div class="flex items-center gap-1">
                        <button @click.stop="chat.minimized = !chat.minimized" class="p-1 hover:bg-gray-100 rounded-full"><span class="material-symbols-outlined text-[16px] text-gray-500">remove</span></button>
                        <button @click.stop="openChats = openChats.filter(c => c.id !== chat.id)" class="p-1 hover:bg-gray-100 rounded-full text-gray-500"><span class="material-symbols-outlined text-[16px]">close</span></button>
                    </div>
                </div>
                <div x-show="!chat.minimized" class="h-80 overflow-y-auto p-4 bg-white flex flex-col gap-3" x-init="fetch(`/messages/${chat.conversation_id}`).then(r => r.json()).then(data => { chat.messages = data; });">
                    <template x-for="msg in chat.messages" :key="msg.id">
                        <div :class="msg.user_id === {{ Auth::id() }} ? 'bg-secondary text-slate-900 self-end' : 'bg-gray-100 text-gray-800 self-start'" class="p-3 rounded-2xl max-w-[85%] text-sm shadow-sm" x-text="msg.body"></div>
                    </template>
                </div>
                <div x-show="!chat.minimized" class="p-3 border-t bg-gray-50 flex items-center gap-2">
                    <form @submit.prevent="fetch(`/messages/${chat.conversation_id}`, { method: 'POST', headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}, body: JSON.stringify({ body: chat.newMessage }) }).then(r => r.json()).then(msg => { if(msg.id) { chat.messages.push(msg); chat.newMessage = ''; } }).catch(e => console.error(e));" class="flex w-full gap-2">
                        <input type="text" x-model="chat.newMessage" placeholder="Écrire..." class="flex-1 text-sm px-4 py-2 bg-white rounded-full border border-gray-200">
                        <button type="submit" class="text-secondary p-1 rounded-full"><span class="material-symbols-outlined">send</span></button>
                    </form>
                </div>
            </div>
        </template>
    </div>

    <!-- Messenger Panel -->
    <div x-show="showMessenger" x-cloak class="fixed right-0 top-16 h-[calc(100vh-64px)] w-[260px] bg-slate-950 border-l border-slate-800 z-50 flex flex-col shadow-2xl">
        <div class="p-4 border-b border-slate-800"><h4 class="font-bold text-sm">Mes Étudiants</h4></div>
        <div class="flex-1 overflow-y-auto">
            @forelse($students as $student)
            <button @click="showMessenger = false; fetch('/messages/start/{{ $student->id }}').then(r => r.json()).then(conv => { if(!openChats.find(c => c.id === {{ $student->id }})) openChats.push({id: {{ $student->id }}, name: '{{ $student->name }}', minimized: false, conversation_id: conv.id, messages: []}) })" class="w-full p-3 hover:bg-slate-900 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-xs">{{ substr($student->name, 0, 1) }}</div>
                <span class="text-sm font-semibold">{{ $student->name }}</span>
            </button>
            @empty
            <p class="p-4 text-xs text-outline text-center italic">Aucun étudiant.</p>
            @endforelse
        </div>
    </div>

    <!-- Sidebar & Main -->
    <aside class="flex flex-col h-screen fixed z-50 bg-slate-950 w-[260px] border-r border-slate-800">
        <div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
        <nav class="flex-1 px-4 space-y-1">
            <button @click="activeTab = 'dashboard'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all text-slate-400 hover:bg-slate-900">Dashboard</button>
            <button @click="activeTab = 'content'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all text-slate-400 hover:bg-slate-900">Contenus</button>
            <button @click="activeTab = 'students'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all text-slate-400 hover:bg-slate-900">Étudiants</button>
        </nav>
    </aside>

    <main class="ml-[260px] min-h-screen flex flex-col">
        <header class="flex items-center justify-between px-8 h-16 w-full sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
            <h2 class="font-bold text-slate-100" x-text="activeTab"></h2>
            <button @click="showMessenger = !showMessenger" class="p-2 text-slate-400 hover:text-primary"><span class="material-symbols-outlined">chat</span></button>
        </header>
        <div class="p-8">
            <!-- Contenu dynamique -->
            <div x-show="activeTab === 'students'">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($students as $student)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">{{ $student->name }}</div>
                    @empty
                    <p>Aucun étudiant.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</body>
</html>',file_path: