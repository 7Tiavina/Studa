<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('faviconStuda.png') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
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
        [x-cloak], [v-cloak] { display: none !important; }
        
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
</head>
<body class="bg-background text-on-background font-sans antialiased transition-colors duration-200" x-data="{ 
    activeTab: '{{ request()->query('tab', 'dashboard') }}',
    availableIcons: [
        'functions', 'science', 'biotech', 'history_edu', 'translate', 'public', 
        'menu_book', 'calculate', 'psychology', 'auto_stories', 'brush', 'music_note',
        'fitness_center', 'computer', 'account_balance', 'architecture', 'biometry',
        'chemistry', 'draw', 'language', 'microbiology', 'menu_book', 'school'
    ],
    availableCategories: ['Primaire', 'Collégial', 'Lycée', 'Université', 'Autre']
}">
    <aside class="flex flex-col h-screen fixed z-50 bg-white dark:bg-slate-950 w-[260px] border-r border-slate-200 dark:border-slate-800 transition-colors">
        <a href="/" class="px-6 py-8 block">
            <img src="{{ asset('logoStuda.png') }}" alt="Studa" class="h-8 w-auto">
        </a>
        <div class="flex-1 px-4 space-y-2">
            <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tableau de bord</span>
            </button>
            <button @click="activeTab = 'users'" :class="activeTab === 'users' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">group</span>
                <span>Utilisateurs</span>
            </button>
            <button @click="activeTab = 'levels'" :class="activeTab === 'levels' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">layers</span>
                <span>Niveaux</span>
            </button>
            <button @click="activeTab = 'subjects'" :class="activeTab === 'subjects' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">category</span>
                <span>Matières</span>
            </button>
            <button @click="activeTab = 'teachers'" :class="activeTab === 'teachers' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">school</span>
                <span>Professeurs</span>
            </button>
            <button @click="activeTab = 'courses'" :class="activeTab === 'courses' ? 'bg-blue-600/10 text-blue-600 dark:text-blue-500 border-r-2 border-blue-600 dark:border-blue-500 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all relative">
                <span class="material-symbols-outlined">check_circle</span>
                <span>Validation Cours</span>
                @if($pendingCourses->count() > 0)
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 bg-error text-slate-900 text-[10px] font-bold rounded-full flex items-center justify-center">
                        {{ $pendingCourses->count() }}
                    </span>
                @endif
            </button>
        </div>
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
        <header class="flex items-center justify-between px-6 h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-colors">
            <div class="flex items-center gap-3 ml-auto">
                <!-- Theme Toggle Button -->
                <button id="theme-toggle" class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors focus:outline-none flex items-center justify-center mr-2">
                    <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
                </button>
                <div class="text-right">
                    <p class="font-bold text-sm text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500 uppercase">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </header>

        <div class="p-8 max-w-[1600px] mx-auto w-full">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500 text-green-500 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500 text-red-500 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section Dashboard -->
            <div x-show="activeTab === 'dashboard'" x-cloak>
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-on-background mb-2">Tableau de bord</h1>
                    <p class="text-on-surface-variant">Aperçu global de l'activité sur la plateforme.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-blue-500/10 text-blue-500 flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl">group</span>
                            </div>
                            <h3 class="font-bold text-outline uppercase text-xs tracking-widest">Utilisateurs</h3>
                        </div>
                        <p class="text-4xl font-black text-on-background">{{ $users->count() }}</p>
                        <p class="text-xs text-outline mt-2">Inscrits sur la plateforme</p>
                    </div>

                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-secondary/10 text-secondary flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl">layers</span>
                            </div>
                            <h3 class="font-bold text-outline uppercase text-xs tracking-widest">Niveaux</h3>
                        </div>
                        <p class="text-4xl font-black text-on-background">{{ $levels->count() }}</p>
                        <p class="text-xs text-outline mt-2">Classes configurées</p>
                    </div>

                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-tertiary/10 text-tertiary flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl">category</span>
                            </div>
                            <h3 class="font-bold text-outline uppercase text-xs tracking-widest">Matières</h3>
                        </div>
                        <p class="text-4xl font-black text-on-background">{{ $subjects->count() }}</p>
                        <p class="text-xs text-outline mt-2">Matières disponibles</p>
                    </div>

                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-error/10 text-error flex items-center justify-center">
                                <span class="material-symbols-outlined text-3xl">pending_actions</span>
                            </div>
                            <h3 class="font-bold text-outline uppercase text-xs tracking-widest">En attente</h3>
                        </div>
                        <p class="text-4xl font-black text-on-background">{{ $users->where('is_validated', false)->count() }}</p>
                        <p class="text-xs text-outline mt-2">Comptes à valider</p>
                    </div>
                </div>

                <!-- Quick actions -->
                <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                    <h2 class="text-xl font-bold mb-6">Actions Rapides</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button @click="activeTab = 'users'" class="p-4 bg-background border border-outline-variant rounded-xl hover:border-primary transition-colors text-left group">
                            <span class="material-symbols-outlined text-primary mb-2">person_add</span>
                            <p class="font-bold group-hover:text-primary transition-colors">Valider les utilisateurs</p>
                            <p class="text-xs text-outline">Gérer les nouvelles inscriptions</p>
                        </button>
                        <button @click="activeTab = 'levels'" class="p-4 bg-background border border-outline-variant rounded-xl hover:border-secondary transition-colors text-left group">
                            <span class="material-symbols-outlined text-secondary mb-2">add_circle</span>
                            <p class="font-bold group-hover:text-secondary transition-colors">Ajouter un niveau</p>
                            <p class="text-xs text-outline">Créer une nouvelle classe</p>
                        </button>
                        <button @click="activeTab = 'subjects'" class="p-4 bg-background border border-outline-variant rounded-xl hover:border-tertiary transition-colors text-left group">
                            <span class="material-symbols-outlined text-tertiary mb-2">library_add</span>
                            <p class="font-bold group-hover:text-tertiary transition-colors">Ajouter une matière</p>
                            <p class="text-xs text-outline">Enrichir le catalogue</p>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Section Utilisateurs -->
            <div x-show="activeTab === 'users'" x-cloak>
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-on-background mb-2">Gestion des Utilisateurs</h1>
                    <p class="text-on-surface-variant">Validez, modifiez ou supprimez les comptes utilisateurs.</p>
                </div>

                <div class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
                    <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-surface-container-high/50">
                        <h2 class="text-lg font-semibold">Liste des Utilisateurs</h2>
                        <span class="text-xs text-secondary bg-secondary-container/10 px-3 py-1 rounded-full">
                            {{ $users->count() }} au total
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-surface-container-low text-xs uppercase text-outline">
                                <tr>
                                    <th class="px-6 py-4">Utilisateur</th>
                                    <th class="px-6 py-4">Rôle</th>
                                    <th class="px-6 py-4">Statut</th>
                                    <th class="px-6 py-4">Inscription</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/30">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-500 font-bold">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $user->name }}</p>
                                                <p class="text-xs text-outline">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $user->role == 'teacher' ? 'bg-purple-500/10 text-purple-400' : 'bg-blue-500/10 text-blue-400' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->is_validated)
                                            <span class="text-xs font-bold text-secondary flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">check_circle</span> Validé
                                            </span>
                                        @else
                                            <span class="text-xs font-bold text-tertiary flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">pending</span> En attente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('admin.users.validate', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 rounded-full hover:bg-slate-700 {{ $user->is_validated ? 'text-tertiary' : 'text-secondary' }}" title="{{ $user->is_validated ? 'Dévalider' : 'Valider' }}">
                                                    <span class="material-symbols-outlined">{{ $user->is_validated ? 'block' : 'check_circle' }}</span>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 rounded-full hover:bg-slate-700 text-primary" title="Modifier">
                                                <span class="material-symbols-outlined">edit</span>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-full hover:bg-slate-700 text-error" title="Supprimer">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Section Niveaux -->
            <div x-show="activeTab === 'levels'" x-cloak>
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h1 class="text-3xl font-bold text-on-background mb-2">Gestion des Niveaux</h1>
                        <p class="text-on-surface-variant">Configurez les niveaux d'études par catégorie et leur ordre d'affichage.</p>
                    </div>
                    <button @click="$dispatch('open-modal', 'add-level')" class="px-5 py-2.5 rounded-lg bg-primary text-slate-900 font-bold hover:opacity-90 transition-opacity flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Ajouter un niveau
                    </button>
                </div>

                <div class="space-y-12">
                    @foreach($levels->groupBy('category') as $category => $categoryLevels)
                    <div class="space-y-6">
                        <h2 class="text-xl font-bold text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined">folder_open</span>
                            {{ $category ?: 'Non classé' }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($categoryLevels as $level)
                            <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex flex-col group hover:border-primary transition-colors">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $level->name }}</h3>
                                        <p class="text-[10px] text-outline uppercase tracking-wider font-bold">Position: {{ $level->position }}</p>
                                    </div>
                                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="$dispatch('open-modal', { name: 'edit-level', level: {{ json_encode($level) }} })" class="p-2 rounded-full hover:bg-blue-500/10 text-primary">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </button>
                                        <form action="{{ route('admin.levels.destroy', $level->id) }}" method="POST" onsubmit="return confirm('Supprimer ce niveau ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-full hover:bg-red-500/10 text-error">
                                                <span class="material-symbols-outlined text-lg">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="mt-auto pt-4 border-t border-outline-variant/30">
                                    <p class="text-xs font-semibold text-outline mb-2">Matières liées ({{ $level->subjects->count() }}) :</p>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($level->subjects as $s)
                                            <span class="px-2 py-1 rounded-md bg-background text-[10px] border border-outline-variant text-on-surface-variant flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[12px]">{{ $s->icon ?: 'book' }}</span>
                                                {{ $s->name }}
                                            </span>
                                        @empty
                                            <span class="text-[10px] italic text-outline">Aucune matière</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Matières -->
            <div x-show="activeTab === 'subjects'" x-cloak>
                <div class="mb-10 flex justify-between items-end">
                    <div>
                        <h1 class="text-3xl font-bold text-on-background mb-2">Gestion des Matières</h1>
                        <p class="text-on-surface-variant">Gérez les matières enseignées par niveau.</p>
                    </div>
                    <button @click="$dispatch('open-modal', 'add-subject')" class="px-5 py-2.5 rounded-lg bg-primary text-slate-900 font-bold hover:opacity-90 transition-opacity flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Ajouter une matière
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($subjects as $subject)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex flex-col items-center text-center group hover:border-secondary transition-colors relative">
                        <div class="absolute top-4 right-4">
                            <span class="px-2 py-0.5 rounded bg-background border border-outline-variant text-[10px] text-outline font-bold uppercase tracking-wider">
                                {{ $subject->level->name ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform mt-4">
                            <span class="material-symbols-outlined text-4xl">{{ $subject->icon ?? 'book' }}</span>
                        </div>
                        <h3 class="text-lg font-bold">{{ $subject->name }}</h3>
                        
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity mt-4">
                            <button @click="$dispatch('open-modal', { name: 'edit-subject', subject: {{ json_encode($subject) }} })" class="p-2 rounded-full hover:bg-blue-500/10 text-primary">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Supprimer cette matière ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-full hover:bg-red-500/10 text-error">
                                    <span class="material-symbols-outlined text-xl">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Professeurs -->
            <div x-show="activeTab === 'teachers'" x-data="{ 
                teacherSubTab: 'list',
                courseSearchQuery: '',
                allCourses: {{ json_encode($allCourses) }}
            }" x-cloak>
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-on-background mb-2">Gestion des Professeurs & Cours</h1>
                    <p class="text-on-surface-variant text-sm">Consultez les informations des enseignants et gérez l'ensemble des cours du site.</p>
                </div>

                <!-- Sous-navigation (Tabs) -->
                <div class="flex gap-6 border-b border-outline-variant mb-8">
                    <button @click="teacherSubTab = 'list'" 
                            :class="teacherSubTab === 'list' ? 'border-b-2 border-primary text-primary font-bold' : 'text-outline hover:text-on-background'" 
                            class="pb-3 text-sm px-1 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">school</span>
                        Liste des Professeurs
                    </button>
                    <button @click="teacherSubTab = 'courses'" 
                            :class="teacherSubTab === 'courses' ? 'border-b-2 border-primary text-primary font-bold' : 'text-outline hover:text-on-background'" 
                            class="pb-3 text-sm px-1 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">menu_book</span>
                        Tous les Cours
                    </button>
                </div>

                <!-- Sous-onglet 1 : Liste des Enseignants -->
                <div x-show="teacherSubTab === 'list'" class="grid grid-cols-1 gap-6">
                    @foreach($teachers as $teacher)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8 flex flex-col md:flex-row gap-8">
                        <div class="flex flex-col items-center gap-4 min-w-[200px]">
                            <div class="w-24 h-24 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-500 text-3xl font-bold">
                                {{ substr($teacher->name, 0, 1) }}
                            </div>
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-on-background">{{ $teacher->name }}</h3>
                                <p class="text-xs text-outline">{{ $teacher->email }}</p>
                            </div>
                             <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $teacher->is_validated ? 'bg-secondary/10 text-secondary' : 'bg-tertiary/10 text-tertiary' }}">
                                {{ $teacher->is_validated ? 'Compte Validé' : 'En attente' }}
                            </span>
                            <button @click="$dispatch('open-modal', { name: 'open-audit', teacher: { id: {{ $teacher->id }}, name: '{{ e(addslashes($teacher->name)) }}' } })"
                                    class="mt-2 flex items-center justify-center gap-2 w-full px-4 py-2 bg-primary/10 text-primary border border-primary/20 hover:bg-primary/20 rounded-xl text-xs font-semibold transition-all">
                                <span class="material-symbols-outlined text-sm">chat</span>
                                Voir les messages
                            </button>
                        </div>

                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">layers</span> Niveaux enseignés
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($teacher->levels as $level)
                                        <span class="px-2 py-1 bg-background border border-outline-variant rounded text-[10px]">{{ $level->name }}</span>
                                    @empty
                                        <span class="text-xs italic text-outline">Aucun niveau lié</span>
                                    @endforelse
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">category</span> Matières
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($teacher->subjects as $subject)
                                        <span class="px-2 py-1 bg-background border border-outline-variant rounded text-[10px]">{{ $subject->name }} ({{ $subject->level ? $subject->level->name : 'N/A' }})</span>
                                    @empty
                                        <span class="text-xs italic text-outline">Aucune matière liée</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">article</span> Cours publiés ({{ $teacher->courses->where('status', 'published')->count() }})
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @forelse($teacher->courses->where('status', 'published')->take(3) as $course)
                                        <div class="p-3 bg-background border border-outline-variant rounded-lg flex items-center gap-3">
                                            <span class="material-symbols-outlined text-blue-500">picture_as_pdf</span>
                                            <div class="truncate">
                                                <p class="text-xs font-bold truncate text-on-background">{{ $course->title }}</p>
                                                <p class="text-[10px] text-outline">{{ $course->subject->name }} - {{ $course->level->name }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-xs italic text-outline col-span-3">Aucun cours publié pour le moment.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Sous-onglet 2 : Tous les Cours -->
                <div x-show="teacherSubTab === 'courses'">
                    <!-- Barre de recherche -->
                    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-surface-container p-4 rounded-xl border border-outline-variant">
                        <div class="relative w-full md:w-80">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-outline">
                                <span class="material-symbols-outlined text-sm">search</span>
                            </span>
                            <input type="text" x-model="courseSearchQuery" placeholder="Rechercher par titre, enseignant, matière..." 
                                   class="w-full pl-9 pr-4 py-2 bg-background border border-outline-variant rounded-xl text-xs text-on-background focus:outline-none focus:border-primary placeholder-outline transition-all">
                        </div>
                        <div class="text-xs text-outline">
                            Total : <span class="font-bold text-primary" x-text="allCourses.length"></span> cours
                        </div>
                    </div>

                    <!-- Liste des cours -->
                    <div class="bg-surface-container border border-outline-variant rounded-xl overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="bg-surface-container-low text-outline font-semibold border-b border-outline-variant">
                                        <th class="p-4">Cours</th>
                                        <th class="p-4">Enseignant</th>
                                        <th class="p-4">Niveau / Matière</th>
                                        <th class="p-4">Type / Statut</th>
                                        <th class="p-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="course in allCourses.filter(c => {
                                        if (!courseSearchQuery) return true;
                                        const query = courseSearchQuery.toLowerCase();
                                        return c.title.toLowerCase().includes(query) ||
                                               c.teacher.name.toLowerCase().includes(query) ||
                                               c.subject.name.toLowerCase().includes(query) ||
                                               c.level.name.toLowerCase().includes(query);
                                    })" :key="course.id">
                                        <tr class="border-b border-outline-variant/50 hover:bg-surface-container-high/40 transition-colors">
                                            <td class="p-4">
                                                <div class="flex items-center gap-3">
                                                    <span class="material-symbols-outlined text-red-500 text-lg">picture_as_pdf</span>
                                                    <div>
                                                        <p class="font-bold text-on-background" x-text="course.title"></p>
                                                        <p class="text-[10px] text-outline truncate max-w-[250px]" x-text="course.description || 'Aucune description'"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-6 h-6 rounded-full bg-blue-500/10 text-blue-500 flex items-center justify-center font-bold text-[10px]" x-text="course.teacher.name.charAt(0)"></div>
                                                    <span class="text-on-background font-medium" x-text="course.teacher.name"></span>
                                                </div>
                                            </td>
                                            <td class="p-4 text-outline">
                                                <span class="bg-background px-2 py-0.5 rounded border border-outline-variant text-[10px]" x-text="course.level.name"></span>
                                                <span class="ml-1" x-text="course.subject.name"></span>
                                            </td>
                                            <td class="p-4">
                                                <div class="flex flex-col gap-1 items-start">
                                                    <span class="text-[9px] uppercase font-bold text-outline" x-text="course.type"></span>
                                                    <!-- Badges statut -->
                                                    <template x-if="course.status === 'published'">
                                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-secondary/10 text-secondary border border-secondary/20">Publié</span>
                                                    </template>
                                                    <template x-if="course.status === 'pending'">
                                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-tertiary/10 text-tertiary border border-tertiary/20">En attente</span>
                                                    </template>
                                                    <template x-if="course.status === 'rejected'">
                                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-error/10 text-error border border-error/20">Rejeté</span>
                                                    </template>
                                                    <template x-if="course.status === 'suspended'">
                                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-slate-500/15 text-slate-400 border border-slate-500/25">Suspendu</span>
                                                    </template>
                                                </div>
                                            </td>
                                            <td class="p-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <!-- Bouton Aperçu -->
                                                    <button @click="$dispatch('open-modal', { name: 'preview-pdf', url: '/storage/' + course.file_path, title: course.title })"
                                                            class="px-2.5 py-1.5 bg-primary/10 text-primary hover:bg-primary/20 rounded-lg font-bold text-[10px] flex items-center gap-1 transition-all">
                                                        <span class="material-symbols-outlined text-[12px]">visibility</span>
                                                        Aperçu
                                                    </button>
                                                    
                                                    <!-- Bouton de suspension -->
                                                    <template x-if="course.status === 'published'">
                                                        <form :action="'/admin/courses/' + course.id + '/suspend'" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="px-2.5 py-1.5 bg-error/10 text-error hover:bg-error/20 rounded-lg font-bold text-[10px] flex items-center gap-1 transition-all">
                                                                <span class="material-symbols-outlined text-[12px]">pause_circle</span>
                                                                Suspendre
                                                            </button>
                                                        </form>
                                                    </template>
                                                    
                                                    <!-- Bouton de publication -->
                                                    <template x-if="course.status === 'suspended' || course.status === 'rejected'">
                                                        <form :action="'/admin/courses/' + course.id + '/approve'" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="px-2.5 py-1.5 bg-secondary/10 text-secondary hover:bg-secondary/20 rounded-lg font-bold text-[10px] flex items-center gap-1 transition-all">
                                                                <span class="material-symbols-outlined text-[12px]">play_circle</span>
                                                                Publier
                                                            </button>
                                                        </form>
                                                    </template>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <!-- Aucun résultat -->
                                    <tr x-show="allCourses.filter(c => {
                                        if (!courseSearchQuery) return true;
                                        const query = courseSearchQuery.toLowerCase();
                                        return c.title.toLowerCase().includes(query) ||
                                               c.teacher.name.toLowerCase().includes(query) ||
                                               c.subject.name.toLowerCase().includes(query) ||
                                               c.level.name.toLowerCase().includes(query);
                                    }).length === 0">
                                        <td colspan="5" class="p-8 text-center text-outline italic">
                                            Aucun cours ne correspond à votre recherche.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Validation Cours -->
            <div x-show="activeTab === 'courses'" x-cloak>
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-on-background mb-2">Validation des Contenus</h1>
                    <p class="text-on-surface-variant">Examinez et approuvez les cours envoyés par les professeurs.</p>
                </div>

                <div class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
                    <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-high/50 flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Attente de publication</h2>
                        <span class="px-3 py-1 rounded-full bg-error/10 text-error text-xs font-bold">
                            {{ $pendingCourses->count() }} à examiner
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-surface-container-low text-xs uppercase text-outline">
                                <tr>
                                    <th class="px-6 py-4">Cours</th>
                                    <th class="px-6 py-4">Professeur</th>
                                    <th class="px-6 py-4">Matière / Niveau</th>
                                    <th class="px-6 py-4">Type</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/30">
                                @forelse($pendingCourses as $course)
                                <tr class="hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded bg-red-500/10 text-red-500 flex items-center justify-center">
                                                <span class="material-symbols-outlined">picture_as_pdf</span>
                                            </div>
                                            <div>
                                                <p class="font-bold">{{ $course->title }}</p>
                                                <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" class="text-[10px] text-primary hover:underline flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-xs">visibility</span> Voir le PDF
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-semibold">{{ $course->teacher->name }}</p>
                                        <p class="text-[10px] text-outline">{{ $course->teacher->email }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded bg-slate-800 text-[10px] font-bold">{{ $course->subject->name }}</span>
                                        <span class="px-2 py-1 rounded bg-slate-900 text-[10px] font-bold text-outline">{{ $course->level->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold uppercase text-outline">
                                        {{ $course->type }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-4 py-2 rounded-lg bg-secondary text-slate-900 text-xs font-bold hover:opacity-90 transition-opacity flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-sm">check</span> Publier
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST" onsubmit="return confirm('Rejeter ce cours ?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-4 py-2 rounded-lg bg-slate-800 text-error text-xs font-bold hover:bg-slate-700 transition-colors flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-sm">close</span> Rejeter
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center italic text-outline">
                                        Aucun cours en attente de validation.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modals -->
    <!-- Modal Add Level -->
    <div x-data="{ show: false }" x-show="show" @open-modal.window="if($event.detail === 'add-level') show = true" class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-md w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Ajouter un Niveau</h2>
            <form action="{{ route('admin.levels.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Catégorie</label>
                    <select name="category" class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-1 focus:ring-primary" required>
                        <option value="">Sélectionner une catégorie</option>
                        <template x-for="cat in availableCategories" :key="cat">
                            <option :value="cat" x-text="cat"></option>
                        </template>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom du niveau (ex: Seconde)</label>
                    <input type="text" name="name" class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-1 focus:ring-primary" required placeholder="Seconde">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Position</label>
                    <input type="number" name="position" class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-1 focus:ring-primary" value="0">
                    <p class="text-[10px] text-outline mt-1">Sert à ordonner les niveaux (ex: 1 pour Seconde, 2 pour Première...). Plus le chiffre est petit, plus il apparaît haut.</p>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-primary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Créer</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Level -->
    <div x-data="{ show: false, level: {} }" x-show="show" @open-modal.window="if($event.detail.name === 'edit-level') { show = true; level = $event.detail.level }" class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-md w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Modifier le Niveau</h2>
            <form :action="'/admin/levels/' + level.id" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Catégorie</label>
                    <select name="category" x-model="level.category" class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-1 focus:ring-primary" required>
                        <template x-for="cat in availableCategories" :key="cat">
                            <option :value="cat" x-text="cat" :selected="level.category == cat"></option>
                        </template>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Nom du niveau</label>
                    <input type="text" name="name" x-model="level.name" class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-1 focus:ring-primary" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Position</label>
                    <input type="number" name="position" x-model="level.position" class="w-full bg-background border-outline-variant rounded-xl text-white focus:border-primary focus:ring-1 focus:ring-primary">
                    <p class="text-[10px] text-outline mt-1">Plus le chiffre est petit, plus il apparaît haut.</p>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-primary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Enregistrer</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Subject -->
    <div x-data="{ show: false, selectedIcon: 'school' }" x-show="show" @open-modal.window="if($event.detail === 'add-subject') show = true" class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-lg w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Ajouter une Matière</h2>
            <form action="{{ route('admin.subjects.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Nom de la matière</label>
                        <input type="text" name="name" class="w-full bg-background border-outline-variant rounded-xl text-white" required placeholder="Ex: Algèbre">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Niveau</label>
                        <select name="level_id" class="w-full bg-background border-outline-variant rounded-xl text-white" required>
                            <option value="">Choisir un niveau</option>
                            @foreach($levels->groupBy('category') as $cat => $catLevels)
                                <optgroup label="{{ $cat ?: 'Non classé' }}" class="bg-slate-900 text-primary">
                                    @foreach($catLevels as $l)
                                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Choisir une icône</label>
                    <input type="hidden" name="icon" x-model="selectedIcon">
                    <div class="grid grid-cols-6 gap-2 p-4 bg-background border border-outline-variant rounded-xl max-h-48 overflow-y-auto custom-scrollbar">
                        <template x-for="icon in availableIcons" :key="icon">
                            <button type="button" @click="selectedIcon = icon" :class="selectedIcon === icon ? 'bg-primary/20 text-primary border-primary' : 'hover:bg-slate-800 border-transparent'" class="w-12 h-12 flex items-center justify-center rounded-lg border-2 transition-all">
                                <span class="material-symbols-outlined text-2xl" x-text="icon"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-secondary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Créer</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Subject -->
    <div x-data="{ show: false, subject: {}, selectedIcon: '' }" x-show="show" @open-modal.window="if($event.detail.name === 'edit-subject') { show = true; subject = $event.detail.subject; selectedIcon = $event.detail.subject.icon }" class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-lg w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Modifier la Matière</h2>
            <form :action="'/admin/subjects/' + subject.id" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Nom de la matière</label>
                        <input type="text" name="name" x-model="subject.name" class="w-full bg-background border-outline-variant rounded-xl text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Niveau</label>
                        <select name="level_id" x-model="subject.level_id" class="w-full bg-background border-outline-variant rounded-xl text-white" required>
                            @foreach($levels->groupBy('category') as $cat => $catLevels)
                                <optgroup label="{{ $cat ?: 'Non classé' }}" class="bg-slate-900 text-primary">
                                    @foreach($catLevels as $l)
                                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Choisir une icône</label>
                    <input type="hidden" name="icon" x-model="selectedIcon">
                    <div class="grid grid-cols-6 gap-2 p-4 bg-background border border-outline-variant rounded-xl max-h-48 overflow-y-auto custom-scrollbar">
                        <template x-for="icon in availableIcons" :key="icon">
                            <button type="button" @click="selectedIcon = icon" :class="selectedIcon === icon ? 'bg-primary/20 text-primary border-primary' : 'hover:bg-slate-800 border-transparent'" class="w-12 h-12 flex items-center justify-center rounded-lg border-2 transition-all">
                                <span class="material-symbols-outlined text-2xl" x-text="icon"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-secondary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Enregistrer</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Preview PDF -->
    <div x-data="{ 
        show: false, 
        pdfUrl: '', 
        pdfTitle: '' 
    }" 
    x-show="show" 
    @open-modal.window="if($event.detail.name === 'preview-pdf') { show = true; pdfUrl = $event.detail.url; pdfTitle = $event.detail.title; }" 
    class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" 
    x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant w-full max-w-4xl h-[85vh] flex flex-col shadow-2xl overflow-hidden transition-colors duration-200">
            <!-- Header -->
            <div class="p-6 border-b border-outline-variant flex justify-between items-center bg-surface-container-high/50">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-2xl">picture_as_pdf</span>
                    <div>
                        <h3 class="font-bold text-lg text-on-background">Aperçu du cours</h3>
                        <p class="text-xs text-outline" x-text="pdfTitle"></p>
                    </div>
                </div>
                <button @click="show = false" class="p-2 hover:bg-surface-container-high rounded-full text-outline hover:text-on-background transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <!-- PDF Viewer Iframe -->
            <div class="flex-grow bg-slate-900 flex items-center justify-center relative">
                <iframe :src="pdfUrl" class="w-full h-full border-0"></iframe>
            </div>
        </div>
    </div>

    <!-- Modal Audit Messages -->
    <div x-data="{
        show: false,
        teacher: { id: null, name: '' },
        conversations: [],
        selectedConversation: null,
        messages: [],
        loadingConversations: false,
        loadingMessages: false,

        initAudit(detail) {
            this.teacher = detail;
            this.show = true;
            this.conversations = [];
            this.selectedConversation = null;
            this.messages = [];
            this.loadConversations();
        },

        loadConversations() {
            this.loadingConversations = true;
            fetch(`/admin/teachers/${this.teacher.id}/conversations`)
                .then(r => r.json())
                .then(data => {
                    this.conversations = data;
                    this.loadingConversations = false;
                })
                .catch(e => {
                    console.error(e);
                    this.loadingConversations = false;
                });
        },

        selectConversation(conv) {
            this.selectedConversation = conv;
            this.loadingMessages = true;
            fetch(`/admin/conversations/${conv.id}/messages`)
                .then(r => r.json())
                .then(data => {
                    this.messages = data;
                    this.loadingMessages = false;
                })
                .catch(e => {
                    console.error(e);
                    this.loadingMessages = false;
                });
        }
    }"
    @open-modal.window="if($event.detail.name === 'open-audit') { initAudit($event.detail.teacher); }"
    x-show="show"
    class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant w-full max-w-5xl h-[85vh] flex flex-col shadow-2xl overflow-hidden transition-colors duration-200">
            <!-- Header -->
            <div class="p-6 border-b border-outline-variant flex justify-between items-center bg-surface-container-high/50">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-2xl">supervisor_account</span>
                    <div>
                        <h3 class="font-bold text-lg text-on-background">Audit des messages</h3>
                        <p class="text-xs text-on-surface-variant">Conversations de <span class="font-semibold text-primary" x-text="teacher.name"></span></p>
                    </div>
                </div>
                <button @click="show = false" class="p-2 hover:bg-surface-container-high rounded-full text-outline hover:text-on-background transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Body split-pane -->
            <div class="flex-grow flex overflow-hidden">
                <!-- Volet Gauche : Liste des conversations (étudiants) -->
                <div class="w-80 border-r border-outline-variant flex flex-col bg-surface-container-low/50">
                    <div class="p-4 border-b border-outline-variant bg-surface-container/20">
                        <span class="text-xs font-bold text-outline uppercase tracking-wider">Discussions (étudiants)</span>
                    </div>
                    <div class="flex-grow overflow-y-auto custom-scrollbar p-2 space-y-1">
                        <template x-if="loadingConversations">
                            <div class="flex justify-center items-center h-32">
                                <span class="animate-spin material-symbols-outlined text-primary">progress_activity</span>
                            </div>
                        </template>
                        <template x-if="!loadingConversations && conversations.length === 0">
                            <div class="p-6 text-center text-xs text-outline italic">
                                Aucune conversation trouvée pour cet enseignant.
                            </div>
                        </template>
                        <template x-for="conv in conversations" :key="conv.id">
                            <button @click="selectConversation(conv)"
                                    :class="selectedConversation && selectedConversation.id === conv.id ? 'bg-primary/10 text-primary border-primary' : 'hover:bg-surface-container-high/60 border-transparent text-on-background'"
                                    class="w-full text-left p-3 rounded-xl border flex items-center gap-3 transition-all">
                                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm shrink-0">
                                    <span x-text="conv.student.name.charAt(0)"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-bold truncate" x-text="conv.student.name"></p>
                                    <p class="text-[10px] text-outline truncate" x-text="conv.last_message"></p>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Volet Droit : Zone de discussion -->
                <div class="flex-1 flex flex-col bg-background/50">
                    <template x-if="!selectedConversation">
                        <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-outline">
                            <span class="material-symbols-outlined text-5xl mb-3 text-outline/40">forum</span>
                            <p class="text-sm">Sélectionnez une discussion pour consulter l'historique des échanges.</p>
                        </div>
                    </template>
                    <template x-if="selectedConversation">
                        <div class="flex-grow flex flex-col overflow-hidden h-full">
                            <!-- En-tête de la discussion -->
                            <div class="px-6 py-3 border-b border-outline-variant bg-surface-container/30 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                    <span x-text="selectedConversation.student.name.charAt(0)"></span>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-on-background" x-text="selectedConversation.student.name"></p>
                                    <p class="text-[9px] text-outline">Rôle : Étudiant</p>
                                </div>
                            </div>

                            <!-- Liste des messages -->
                            <div class="flex-grow overflow-y-auto p-6 space-y-4 custom-scrollbar bg-background/10">
                                <template x-if="loadingMessages">
                                    <div class="flex justify-center items-center h-64">
                                        <span class="animate-spin material-symbols-outlined text-primary text-3xl">progress_activity</span>
                                    </div>
                                </template>
                                <template x-if="!loadingMessages">
                                    <div class="space-y-4">
                                        <template x-for="msg in messages" :key="msg.id">
                                            <div :class="msg.user_id === teacher.id ? 'justify-end' : 'justify-start'" class="flex">
                                                <div :class="msg.user_id === teacher.id ? 'bg-blue-600 text-white rounded-br-none' : 'bg-surface-container text-on-surface rounded-bl-none'"
                                                     class="max-w-[70%] p-3.5 rounded-2xl shadow-sm text-xs border border-outline-variant/30 transition-colors duration-200">
                                                    <!-- Expéditeur -->
                                                    <div class="flex items-center justify-between gap-4 mb-1">
                                                        <span class="font-black text-[9px] uppercase tracking-wider" :class="msg.user_id === teacher.id ? 'text-white/80' : 'text-primary'" x-text="msg.user.name"></span>
                                                        <span class="text-[8px] opacity-60" x-text="new Date(msg.created_at).toLocaleDateString('fr-FR', {hour: '2-digit', minute:'2-digit'})"></span>
                                                    </div>
                                                    <p class="leading-relaxed whitespace-pre-wrap" x-text="msg.body"></p>

                                                    <!-- Réactions en lecture seule -->
                                                    <div x-show="msg.reactions && Object.keys(msg.reactions).length > 0" class="flex flex-wrap gap-1 mt-2">
                                                        <template x-for="(userIds, emoji) in msg.reactions" :key="emoji">
                                                            <div class="flex items-center gap-1 px-1.5 py-0.5 rounded-full border text-[9px] font-semibold"
                                                                 :class="msg.user_id === teacher.id ? 'bg-white/10 border-white/20 text-white' : 'bg-background border-outline-variant text-on-background'">
                                                                <span x-text="emoji"></span>
                                                                <span x-text="userIds.length"></span>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
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
