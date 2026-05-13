<!DOCTYPE html>
<html class="dark" lang="fr">
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
    </style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-background text-on-background font-sans antialiased" x-data="{ activeTab: 'dashboard' }">
    <!-- Sidebar -->
    <aside class="flex flex-col h-screen fixed z-50 bg-slate-950 w-[260px] border-r border-slate-800">
        <div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
        
        <div class="px-6 mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center text-secondary font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <p class="font-bold text-sm text-slate-100">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 uppercase tracking-widest font-black">Étudiant</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <button @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Tableau de bord</span>
            </button>
            <button @click="activeTab = 'levels'" :class="activeTab === 'levels' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">layers</span>
                <span>Mon Niveau</span>
            </button>
            <button @click="activeTab = 'subscriptions'" :class="activeTab === 'subscriptions' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">subscriptions</span>
                <span>Mes Abonnements</span>
            </button>
            <button @click="activeTab = 'teachers'" :class="activeTab === 'teachers' ? 'bg-blue-600/10 text-blue-500 border-r-2 border-blue-500' : 'text-slate-400 hover:bg-slate-900'" class="flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left transition-all">
                <span class="material-symbols-outlined">school</span>
                <span>Profs suivis</span>
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
            <h2 class="font-bold text-slate-100" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1).replace('_', ' ')"></h2>
            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-400 hover:text-slate-100"><span class="material-symbols-outlined">notifications</span></button>
                <div class="h-8 w-[1px] bg-slate-800"></div>
                <p class="text-xs font-bold text-slate-300">{{ Auth::user()->name }}</p>
            </div>
        </header>

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

            <!-- Section Levels -->
            <div x-show="activeTab === 'levels'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Explorer par Niveau</h3>
                <div class="space-y-12">
                    @foreach($levels->groupBy('category') as $category => $categoryLevels)
                    <div class="space-y-6">
                        <h4 class="text-lg font-bold text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined">folder</span> {{ $category ?: 'Autre' }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($categoryLevels as $level)
                            <div class="bg-surface-container rounded-xl border border-outline-variant p-6">
                                <h5 class="font-bold text-lg mb-4">{{ $level->name }}</h5>
                                <div class="grid grid-cols-1 gap-4">
                                    @foreach($level->subjects as $subject)
                                    <div x-data="{ expanded: false }" class="bg-background rounded-lg border border-outline-variant/20 overflow-hidden">
                                        <div class="flex items-center justify-between p-3 cursor-pointer hover:bg-slate-800/40 transition-colors" @click="expanded = !expanded">
                                            <div class="flex items-center gap-3">
                                                <span class="material-symbols-outlined text-sm text-secondary">{{ $subject->icon ?: 'book' }}</span>
                                                <span class="text-sm font-semibold">{{ $subject->name }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded text-outline">{{ $subject->courses->count() }} cours</span>
                                                <span class="material-symbols-outlined text-xs transition-transform" :class="expanded ? 'rotate-180' : ''">expand_more</span>
                                            </div>
                                        </div>
                                        
                                        <div x-show="expanded" x-collapse x-cloak class="border-t border-outline-variant/10 bg-slate-900/20 p-3 space-y-3">
                                            @forelse($subject->courses as $course)
                                            <div class="flex items-center justify-between p-2 bg-surface-container-low rounded-lg border border-outline-variant/10">
                                                <div class="flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-xs text-red-400">picture_as_pdf</span>
                                                    <div>
                                                        <p class="text-[11px] font-bold leading-none">{{ $course->title }}</p>
                                                        <p class="text-[9px] text-outline">Par {{ $course->teacher->name }}</p>
                                                    </div>
                                                </div>
                                                @if(in_array($course->id, $subscribedCoursesIds))
                                                    <span class="px-2 py-1 bg-secondary/10 text-secondary text-[8px] font-bold uppercase rounded">Abonné</span>
                                                @else
                                                    <form action="{{ route('student.courses.subscribe', $course->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-2 py-1 bg-primary text-slate-900 text-[8px] font-bold uppercase rounded hover:opacity-90 transition-opacity">S'abonner</button>
                                                    </form>
                                                @endif
                                            </div>
                                            @empty
                                            <p class="text-center text-[10px] text-outline italic py-2">Aucun cours disponible.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                    <p class="text-[10px] text-outline uppercase font-black">{{ $course->subject->name }} • {{ $course->level->name }}</p>
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
            <div x-show="activeTab === 'teachers'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Professeurs que je suis</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($followedTeachers as $teacher)
                    <div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex flex-col items-center text-center group">
                        <div class="w-20 h-20 rounded-full bg-blue-500/10 text-blue-500 flex items-center justify-center text-2xl font-bold mb-4">
                            {{ substr($teacher->name, 0, 1) }}
                        </div>
                        <h4 class="font-bold">{{ $teacher->name }}</h4>
                        <p class="text-xs text-outline mb-4">{{ $teacher->email }}</p>
                        
                        <div class="flex flex-wrap justify-center gap-1 mb-6">
                            @foreach($teacher->subjects->take(2) as $s)
                                <span class="px-2 py-0.5 bg-background rounded text-[8px] font-bold text-slate-400 uppercase tracking-tighter">{{ $s->name }}</span>
                            @endforeach
                        </div>

                        <form action="{{ route('student.teachers.unfollow', $teacher->id) }}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2 border border-error text-error text-xs font-bold rounded-xl hover:bg-error/10 transition-colors">Ne plus suivre</button>
                        </form>
                    </div>
                    @empty
                    <div class="col-span-3 bg-surface-container rounded-xl border border-outline-variant p-12 text-center">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">school</span>
                        <p class="text-outline italic">Vous ne suivez aucun professeur pour le moment.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Section Live (Placeholder) -->
            <div x-show="activeTab === 'live'" x-cloak class="space-y-8">
                <h3 class="text-2xl font-bold">Live Courses</h3>
                <div class="bg-surface-container rounded-xl border border-outline-variant p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-outline mb-4">video_call</span>
                    <p class="text-outline italic font-bold">Aucun live prévu actuellement.</p>
                    <p class="text-outline text-sm">Les sessions en direct avec vos professeurs s'afficheront ici.</p>
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
</body>
</html>
