<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
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
        [v-cloak] { display: none; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #0c1322; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #424754; border-radius: 10px; }
    </style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-background text-on-background font-sans antialiased" x-data="{ 
    activeTab: '{{ request()->query('tab', 'dashboard') }}',
    availableIcons: [
        'functions', 'science', 'biotech', 'history_edu', 'translate', 'public', 
        'menu_book', 'calculate', 'psychology', 'auto_stories', 'brush', 'music_note',
        'fitness_center', 'computer', 'account_balance', 'architecture', 'biometry',
        'chemistry', 'draw', 'language', 'microbiology', 'menu_book', 'school'
    ],
    availableCategories: ['Primaire', 'Collégial', 'Lycée', 'Université', 'Autre']
}">
    <aside class="flex flex-col h-screen fixed z-50 bg-slate-950 w-[260px] border-r border-slate-800">
        <div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
        <div class="flex-1 px-4 space-y-2">
            <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tableau de bord</span>
            </button>
            <button @click="activeTab = 'users'" :class="activeTab === 'users' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">group</span>
                <span>Utilisateurs</span>
            </button>
            <button @click="activeTab = 'levels'" :class="activeTab === 'levels' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">layers</span>
                <span>Niveaux</span>
            </button>
            <button @click="activeTab = 'subjects'" :class="activeTab === 'subjects' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">category</span>
                <span>Matières</span>
            </button>
        </div>
        <div class="p-6 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2 text-error hover:text-red-400 w-full text-left text-sm">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="ml-[260px] min-h-screen flex flex-col">
        <header class="flex items-center justify-between px-6 h-16 w-full sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
            <div class="flex items-center gap-3 ml-auto">
                <div class="text-right">
                    <p class="font-bold text-sm text-slate-100">{{ Auth::user()->name }}</p>
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
</body>
</html>
