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
<body class="bg-background text-on-background font-sans antialiased" x-data="{ activeTab: 'dashboard', showMessenger: false }">
    <!-- Sidebar -->
    <aside class="flex flex-col h-screen fixed z-50 bg-slate-950 w-[260px] border-r border-slate-800">
        <div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
        
        <div class="px-6 mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-500 font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <p class="font-bold text-sm text-slate-100">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Professeur</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tableau de bord</span>
            </button>
            <button @click="activeTab = 'content'" :class="activeTab === 'content' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">menu_book</span>
                <span>Mes Contenus</span>
            </button>
            <button @click="activeTab = 'subjects'" :class="activeTab === 'subjects' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">school</span>
                <span>Mes Spécialités</span>
            </button>
            <button @click="activeTab = 'students'" :class="activeTab === 'students' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">group</span>
                <span>Étudiants</span>
            </button>
            <button @click="activeTab = 'live'" :class="activeTab === 'live' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">video_call</span>
                <span>Live Courses</span>
            </button>
            <button @click="activeTab = 'analytics'" :class="activeTab === 'analytics' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">insights</span>
                <span>Analytics</span>
            </button>
            <button @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">settings</span>
                <span>Paramètres</span>
            </button>
        </nav>

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

    <!-- Main Content -->
    <main class="ml-[260px] min-h-screen flex flex-col">
        <header class="flex items-center justify-between px-8 h-16 w-full sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
            <h2 class="font-bold text-slate-100" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></h2>
            <div class="flex items-center gap-4">
                <button @click="showMessenger = !showMessenger" class="p-2 text-slate-400 hover:text-primary transition-colors relative">
                    <span class="material-symbols-outlined">chat</span>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-secondary rounded-full"></span>
                </button>
                <button class="p-2 text-slate-400 hover:text-slate-100"><span class="material-symbols-outlined">notifications</span></button>
                <div class="h-8 w-[1px] bg-slate-800"></div>
                <div class="flex items-center gap-2">
                    <p class="text-xs font-bold text-slate-300">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </header>

        <!-- Messenger Panel -->
        <div x-show="showMessenger" x-cloak class="fixed right-0 top-16 h-[calc(100vh-64px)] w-[320px] bg-surface-container-low border-l border-slate-800 z-40 flex flex-col shadow-2xl" @click.away="showMessenger = false">
            <div class="p-4 border-b border-slate-800">
                <h4 class="font-bold text-sm mb-3">Discussions</h4>
                <input type="text" placeholder="Rechercher un contact..." class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-xs">
            </div>
            <div class="flex-1 overflow-y-auto">
                <button class="w-full p-4 hover:bg-slate-800/50 flex items-center gap-3 border-b border-slate-800/50">
                    <div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center font-bold text-secondary">E</div>
                    <div class="text-left flex-1">
                        <p class="text-sm font-bold">Étudiant A.</p>
                        <p class="text-[10px] text-outline truncate">Bonjour monsieur, merci pour le cours.</p>
                    </div>
                </button>
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
                        <p class="text-3xl font-black">0</p>
                    </div>
                </div>

                <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                    <h3 class="text-xl font-bold mb-6">Activités Récentes</h3>
                    <div class="space-y-4">
                        @forelse($recentCourses as $course)
                        <div class="flex items-center justify-between p-4 bg-background rounded-xl border border-outline-variant/30">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-blue-500">article</span>
                                <div>
                                    <p class="font-bold text-sm">{{ $course->title }}</p>
                                    <p class="text-[10px] text-outline">{{ $course->subject->name }} • {{ $course->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $course->status === 'published' ? 'bg-secondary/10 text-secondary' : ($course->status === 'rejected' ? 'bg-error/10 text-error' : 'bg-tertiary/10 text-tertiary') }}">
                                {{ $course->status }}
                            </span>
                        </div>
                        @empty
                        <p class="text-center text-outline italic py-8">Aucune activité pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Section My Content -->
            <div x-show="activeTab === 'content'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Mes Contenus Pédagogiques</h3>
                    <button @click="$dispatch('open-modal', 'upload-course')" class="bg-primary text-slate-900 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:opacity-90">
                        <span class="material-symbols-outlined">add</span> Envoyer un cours
                    </button>
                </div>

                <div class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container-low text-[10px] uppercase text-outline font-black">
                            <tr>
                                <th class="px-6 py-4">Titre</th>
                                <th class="px-6 py-4">Matière</th>
                                <th class="px-6 py-4">Type</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4 text-right">Fichier</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/20">
                            @foreach($user->courses as $course)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4 font-bold text-sm">{{ $course->title }}</td>
                                <td class="px-6 py-4 text-sm">{{ $course->subject->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold uppercase px-2 py-1 bg-slate-800 rounded">{{ $course->type }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold uppercase {{ $course->status === 'published' ? 'text-secondary' : ($course->status === 'rejected' ? 'text-error' : 'text-tertiary') }}">
                                        {{ $course->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-outline">{{ $course->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" class="text-primary hover:underline flex items-center justify-end gap-1 text-xs">
                                        <span class="material-symbols-outlined text-sm">download</span> Télécharger
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section My Subjects -->
            <div x-show="activeTab === 'subjects'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold">Mes Spécialités</h3>
                        <p class="text-outline text-sm">Gérez les matières que vous enseignez.</p>
                    </div>
                    <button @click="$dispatch('open-modal', 'add-subject')" class="bg-slate-800 border border-slate-700 text-white px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 hover:bg-slate-700">
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
                            <button type="submit" class="p-2 text-error opacity-0 group-hover:opacity-100 transition-opacity hover:bg-error/10 rounded-full" onclick="return confirm('Retirer cette matière ?')">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Section Students -->
            <div x-show="activeTab === 'students'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Mes Étudiants</h3>
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-bold">{{ $students->count() }} étudiants</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($students as $student)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center font-bold">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm">{{ $student->name }}</p>
                            <p class="text-xs text-outline">{{ $student->email }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 bg-surface-container rounded-xl border border-outline-variant p-12 text-center text-outline italic">
                        Aucun étudiant ne vous suit pour le moment.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Section Live Courses (Placeholder) -->
            <div x-show="activeTab === 'live'" x-cloak class="space-y-8">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Live Courses</h3>
                    <button class="bg-secondary text-slate-900 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 opacity-50 cursor-not-allowed">
                        <span class="material-symbols-outlined">add</span> Créer une visio
                    </button>
                </div>
                <div class="bg-surface-container rounded-xl border border-outline-variant p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-outline mb-4">video_call</span>
                    <p class="text-outline italic">Le module de visioconférence est en cours de développement.</p>
                </div>
            </div>

            <!-- Section Analytics (Placeholder) -->
            <div x-show="activeTab === 'analytics'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Statistiques & Analytics</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                        <h4 class="font-bold mb-4">Engagement par cours</h4>
                        <div class="h-40 bg-background rounded-lg border border-dashed border-outline-variant flex items-center justify-center text-outline text-xs italic">
                            Graphique d'engagement (bientôt disponible)
                        </div>
                    </div>
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-8">
                        <h4 class="font-bold mb-4">Consultation des PDF</h4>
                        <div class="h-40 bg-background rounded-lg border border-dashed border-outline-variant flex items-center justify-center text-outline text-xs italic">
                            Graphique de consultation (bientôt disponible)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Settings -->
            <div x-show="activeTab === 'settings'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Paramètres du Profil</h3>
                <div class="max-w-2xl bg-surface-container rounded-xl border border-outline-variant p-8">
                    <form action="{{ route('teacher.settings.update') }}" method="POST" class="space-y-6">
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
                        
                        <p class="text-xs font-bold text-primary uppercase tracking-widest">Changer le mot de passe</p>
                        
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
                                    <label class="block text-sm font-medium mb-2 text-outline">Confirmer le mot de passe</label>
                                    <input type="password" name="new_password_confirmation" class="w-full bg-background border-outline-variant rounded-xl text-white">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-colors">
                            Enregistrer les modifications
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Modals -->
    <!-- Modal Upload Course -->
    <div x-data="{ show: false }" x-show="show" @open-modal.window="if($event.detail === 'upload-course') show = true" class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-lg w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Envoyer un nouveau contenu</h2>
            <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-2">Titre du cours</label>
                    <input type="text" name="title" class="w-full bg-background border-outline-variant rounded-xl text-white" required placeholder="Ex: Introduction à la thermodynamique">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Matière</label>
                        <select name="subject_id" class="w-full bg-background border-outline-variant rounded-xl text-white" required>
                            @foreach($mySubjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->level ? $s->level->name : 'N/A' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Type</label>
                        <select name="type" class="w-full bg-background border-outline-variant rounded-xl text-white" required>
                            <option value="course">Cours (PDF/Texte)</option>
                            <option value="sujet_type">Sujets Types</option>
                            <option value="correction">Corrigé</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Miniature (Thumbnail)</label>
                    <input type="file" name="thumbnail" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-slate-900 hover:file:bg-primary/90" accept="image/*">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Description (optionnel)</label>
                    <textarea name="description" rows="3" class="w-full bg-background border-outline-variant rounded-xl text-white"></textarea>
                </div>

                <div class="p-8 border-2 border-dashed border-outline-variant rounded-xl text-center hover:border-primary transition-colors bg-background/50">
                    <input type="file" name="file" id="file" class="hidden" required accept=".pdf,.doc,.docx,.txt">
                    <label for="file" class="cursor-pointer">
                        <span class="material-symbols-outlined text-4xl text-outline mb-2">upload_file</span>
                        <p class="text-sm font-bold">Cliquez pour choisir un fichier</p>
                        <p class="text-xs text-outline mt-1">PDF, Word ou Texte (Max 10MB)</p>
                    </label>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-primary text-slate-900 font-bold py-3 rounded-xl hover:opacity-90">Envoyer pour validation</button>
                    <button type="button" @click="show = false" class="flex-1 bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-700">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Subject -->
    <div x-data="{ show: false }" x-show="show" @open-modal.window="if($event.detail === 'add-subject') show = true" class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-black/60 backdrop-blur-sm" x-cloak>
        <div @click.away="show = false" class="bg-surface-container rounded-2xl border border-outline-variant p-8 max-w-md w-full shadow-2xl">
            <h2 class="text-2xl font-bold mb-6">Ajouter une spécialité</h2>
            <form action="{{ route('teacher.subjects.add') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Matière à ajouter</label>
                    <select name="subject_id" class="w-full bg-background border-outline-variant rounded-xl text-white" required>
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
</body>
</html>
