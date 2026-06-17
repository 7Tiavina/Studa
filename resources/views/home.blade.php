<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('faviconStuda.png') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
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
</head>
<body x-data="{ currentTab: 'courses', mentorSearchQuery: '' }" class="bg-slate-50 dark:bg-background font-body-base text-slate-800 dark:text-on-background selection:bg-primary-container selection:text-on-primary-container transition-colors duration-200">

<nav class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 shadow-sm flex justify-between items-center px-6 h-16 transition-colors">
    <div class="flex items-center gap-8">
        <a href="/" @click.prevent="currentTab = 'courses'" class="flex items-center gap-2 text-2xl font-black tracking-tight text-slate-900 dark:text-white">
            <img src="{{ asset('logoStuda.png') }}" alt="Studa" class="h-8 w-auto">
            <span class="px-2 py-0.5 text-[10px] font-bold tracking-widest uppercase rounded-full bg-red-50 text-red-600 border border-red-200/40 dark:bg-red-950/30 dark:text-red-400 dark:border-red-900/30">Beta</span>
        </a>
        <form action="/" class="hidden md:flex items-center bg-slate-100 dark:bg-slate-800/50 rounded-lg px-3 py-1.5 border border-slate-200 dark:border-slate-700">
            <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-sm mr-2">search</span>
            <input name="search" value="{{ request('search') }}" class="bg-transparent border-none text-sm text-slate-900 dark:text-white focus:ring-0 w-64 placeholder:text-slate-400 dark:placeholder:text-slate-500" placeholder="Rechercher un cours..." type="text"/>
        </form>
    </div>
    
    <div class="hidden md:flex items-center gap-6">
        <a href="#" @click.prevent="currentTab = 'courses'" :class="currentTab === 'courses' ? 'text-[#1b55db] dark:text-primary font-semibold border-b-2 border-[#1b55db] dark:border-primary pb-1 font-inter' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white pb-1 border-b-2 border-transparent transition-colors font-inter'" class="pb-1">Courses</a>
        <a href="#" @click.prevent="currentTab = 'my-learning'" :class="currentTab === 'my-learning' ? 'text-[#1b55db] dark:text-primary font-semibold border-b-2 border-[#1b55db] dark:border-primary pb-1 font-inter' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white pb-1 border-b-2 border-transparent transition-colors font-inter'" class="pb-1">My Learning</a>
        <a href="#" @click.prevent="currentTab = 'library'" :class="currentTab === 'library' ? 'text-[#1b55db] dark:text-primary font-semibold border-b-2 border-[#1b55db] dark:border-primary pb-1 font-inter' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white pb-1 border-b-2 border-transparent transition-colors font-inter'" class="pb-1">Library</a>
        <a href="#" @click.prevent="currentTab = 'mentors'" :class="currentTab === 'mentors' ? 'text-[#1b55db] dark:text-primary font-semibold border-b-2 border-[#1b55db] dark:border-primary pb-1 font-inter' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white pb-1 border-b-2 border-transparent transition-colors font-inter'" class="pb-1">Mentors</a>
    </div>

    <div class="flex items-center gap-4">
        <button id="theme-toggle" class="p-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none">
            <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
        </button>

        @auth
            @php
                $dashboardRoute = 'student.dashboard';
                if (Auth::user()->role === 'teacher') {
                    $dashboardRoute = 'teacher.dashboard';
                } elseif (Auth::user()->role === 'admin') {
                    $dashboardRoute = 'admin.dashboard';
                }
            @endphp
            <a href="{{ route($dashboardRoute) }}" class="text-slate-700 dark:text-white hover:text-[#1b55db] dark:hover:text-primary transition-colors text-sm font-semibold">Portal</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm active:scale-95 duration-150 hover:bg-slate-300 dark:hover:bg-slate-700">Logout</button>
            </form>
        @else
            <a href="/login" class="bg-[#1b55db] dark:bg-primary-container text-white dark:text-on-primary-container px-4 py-2 rounded-lg font-semibold text-sm active:scale-95 duration-150 hover:bg-[#123fa3] dark:hover:opacity-90">Login</a>
        @endauth
    </div>
</nav>

<main class="mt-16 p-lg min-h-screen container mx-auto max-w-7xl">
    <!-- Onglet Cours -->
    <div x-show="currentTab === 'courses'" class="space-y-xl">
        <section class="relative bg-[#fcfbf7] dark:bg-slate-900/40 rounded-3xl overflow-hidden p-8 md:p-16 border border-amber-100/50 dark:border-slate-800 shadow-sm transition-colors">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-6 z-10">
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    Des compétences d'aujourd'hui <br class="hidden md:inline"/>qui ont de l'avenir
                </h1>
                <p class="text-slate-600 dark:text-slate-300 text-base md:text-lg max-w-xl font-medium leading-relaxed">
                    Notre différence ? Une école 100% en ligne et un modèle pédagogique unique qui seront les clés de votre réussite.
                </p>
                
                <form action="/" class="flex flex-col sm:flex-row gap-2 bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-md border border-slate-100 dark:border-slate-700 max-w-xl">
                    <div class="flex items-center flex-1 px-3 py-2 sm:py-0">
                        <span class="material-symbols-outlined text-slate-400 mr-2">search</span>
                        <input name="search" value="{{ request('search') }}" class="bg-transparent border-none text-slate-900 dark:text-white focus:ring-0 w-full placeholder:text-slate-400 dark:placeholder:text-slate-500 text-sm" placeholder="Quel sujet souhaites-tu réviser ?" type="text"/>
                    </div>
                    <button type="submit" class="bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary px-6 py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-[#123fa3] dark:hover:bg-primary/90 transition-all text-sm whitespace-nowrap">
                        Rechercher
                    </button>
                </form>
            </div>
            
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[420px]">
                    <img alt="Hero Graphic" class="w-full h-full object-contain" src="/hero1.png"/>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12 md:mt-16">
            <div class="bg-amber-50/60 dark:bg-slate-800/40 border-t-4 border-amber-400 dark:border-amber-500 rounded-2xl p-6 md:p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Étudiants</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                        Boostez votre réussite académique en accédant à une bibliothèque complète de ressources, cours et sujets types. Trouvez le soutien dont vous avez besoin en rejoignant des cours particuliers ou en groupe avec des professeurs rigoureusement vérifiés.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4 mt-6">
                    <a href="{{ route('register') }}?role=student" class="inline-block bg-[#1b55db] hover:bg-[#4f46e5] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-sm">
                        Démarrer mon inscription
                    </a>
                    <a href="#levels" class="text-[#1b55db] dark:text-blue-400 font-semibold text-sm hover:underline">
                        Explorer les ressources et professeurs
                    </a>
                </div>
            </div>

            <div class="bg-blue-50/40 dark:bg-slate-800/40 border-t-4 border-blue-400 dark:border-[#1b55db] rounded-2xl p-6 md:p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Professeurs</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                        Partagez votre expertise en publiant vos cours et ressources directement sur la plateforme. Gérez votre activité en toute liberté en entrant en contact direct avec vos étudiants pour des cours personnalisés et profitez de nos fonctionnalités exclusives pour optimiser votre enseignement.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4 mt-6">
                    <a href="{{ route('register') }}?role=teacher" class="inline-block bg-[#1b55db] hover:bg-[#4f46e5] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-sm">
                        Créer mon espace professeur
                    </a>
                    <a href="#" class="text-[#1b55db] dark:text-blue-400 font-semibold text-sm hover:underline">
                        Découvrir les avantages exclusifs
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-md">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-slate-900 dark:text-white flex items-center gap-2">
                <span class="w-2 h-6 bg-[#1b55db] dark:bg-primary rounded-full"></span>
                Ton Niveau Académique
            </h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-gutter">
            @foreach($levels as $l)
                <a href="?level_id={{ $l->id }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
                   class="{{ request('level_id') == $l->id ? 'bg-[#1b55db]/10 dark:bg-[#1b55db]/20 border-[#1b55db] shadow-lg' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 hover:border-[#1b55db] dark:hover:border-primary hover:bg-slate-50 dark:hover:bg-slate-800' }} p-4 rounded-xl text-center border transition-all group">
                    <p class="text-slate-400 dark:text-slate-500 font-label-caps group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors">{{ $l->category }}</p>
                    <p class="text-slate-900 dark:text-white font-title-sm mt-1">{{ $l->name }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="space-y-md">
        <div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar">
            <a href="?level_id={{ request('level_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ !request('subject_id') ? 'bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap font-medium text-sm transition-all shadow-sm">
                <span class="material-symbols-outlined text-lg">all_inclusive</span>
                Tous les sujets
            </a>
            @foreach($subjects as $s)
                <a href="?subject_id={{ $s->id }}&level_id={{ request('level_id') }}&search={{ request('search') }}" 
                   class="flex items-center gap-2 {{ request('subject_id') == $s->id ? 'bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                    <span class="material-symbols-outlined text-lg">{{ $s->icon ?: 'book' }}</span>
                    {{ $s->name }}
                </a>
            @endforeach
        </div>
    </section>

    <section class="space-y-md">
        <div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar">
            <a href="?level_id={{ request('level_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ !request('type') ? 'bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Tous les types
            </a>
            <a href="?type=course&level_id={{ request('level_id') }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ request('type') == 'course' ? 'bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Cours
            </a>
            <a href="?type=sujet_type&level_id={{ request('level_id') }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ request('type') == 'sujet_type' ? 'bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Sujets Types
            </a>
            <a href="?type=correction&level_id={{ request('level_id') }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ request('type') == 'correction' ? 'bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Corrigés
            </a>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter pb-xl">
        @forelse($courses as $course)
            <div class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl overflow-hidden flex flex-col group hover:border-[#1b55db] dark:hover:border-primary transition-all duration-300 shadow-md hover:shadow-xl">
                <div class="h-48 relative overflow-hidden bg-slate-100 dark:bg-slate-800">
                    <img alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $course->thumbnail_path ? asset('storage/' . $course->thumbnail_path) : 'https://picsum.photos/400/300' }}"/>
                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                        <span class="bg-[#1b55db] text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $course->subject->name }}</span>
                        <span class="bg-purple-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $course->type }}</span>
                        <span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $course->level->name }}</span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col space-y-4">
                    <div>
                        <h3 class="font-title-sm text-slate-900 dark:text-white group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors line-clamp-2">{{ $course->title }}</h3>
                        <p class="text-slate-500 dark:text-on-surface-variant text-body-sm mt-1 line-clamp-2">{{ Str::limit($course->description, 100) }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <button @click="currentTab = 'mentors'; mentorSearchQuery = '{{ $course->teacher->name }}'" 
                                class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                            <div class="w-8 h-8 rounded-full overflow-hidden bg-[#1b55db]/20 text-[#1b55db] dark:text-blue-400 flex items-center justify-center font-bold text-[10px] border border-primary/20">
                                @if($course->teacher->avatar)
                                    <img src="{{ asset('storage/' . $course->teacher->avatar) }}" alt="" class="w-full h-full object-cover">
                                @else
                                    {{ substr($course->teacher->name, 0, 1) }}
                                @endif
                            </div>
                            <span class="text-xs font-medium text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">{{ $course->teacher->name }}</span>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2 pt-2">
                        <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" class="w-full bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary py-2.5 rounded-xl font-bold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-sm">visibility</span> Prévisualiser
                        </a>
                        <a href="{{ asset('storage/' . $course->file_path) }}" download class="w-full bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white py-2.5 rounded-xl font-medium text-sm hover:bg-slate-200 dark:hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">download</span> Télécharger
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-slate-400 dark:text-outline italic py-12 col-span-3">Aucun cours trouvé.</p>
        @endforelse
    </section>
    </div>

    <!-- Onglet My Learning (Blog) -->
    <div x-show="currentTab === 'my-learning'" x-cloak class="space-y-12 py-6">
        <!-- Hero Section du Blog -->
        <section class="bg-gradient-to-br from-[#fcfbf7] to-amber-50/30 dark:from-slate-900/40 dark:to-slate-950/20 rounded-3xl overflow-hidden p-8 md:p-12 border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-[#1b55db] dark:text-primary text-xs font-bold uppercase tracking-wider">
                    <span class="material-symbols-outlined text-sm">local_library</span> Blog & Conseils Studa
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    Hita sy Fantatra : <br class="hidden md:inline"/>Hery ho an'ny Fianarana 🇲🇬
                </h1>
                <p class="text-slate-600 dark:text-slate-300 text-base md:text-lg max-w-xl font-medium leading-relaxed font-inter">
                    Bienvenue sur l'espace d'apprentissage et de partage de Studa ! 
                    Que vous soyez élève à Tananarive, enseignant à Majunga, ou parent d'élève à Fianarantsoa, retrouvez nos dossiers exclusifs sur l'éducation et la réussite scolaire à Madagascar.
                </p>
                <div class="flex flex-wrap items-center gap-4">
                    <button @click="currentTab = 'courses'" class="bg-[#1b55db] hover:bg-[#4f46e5] text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-md active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">school</span> Commencer à apprendre
                    </button>
                    <a href="#articles" class="text-[#1b55db] dark:text-primary font-semibold text-sm hover:underline flex items-center gap-1">
                        Lire nos dossiers <span class="material-symbols-outlined text-sm">arrow_downward</span>
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 max-w-[400px] flex justify-center">
                <img alt="Digital presentation" class="w-full h-auto object-contain drop-shadow-xl" src="/Digital presentation-rafiki.png"/>
            </div>
        </section>

        <!-- Articles du Blog -->
        <section id="articles" class="space-y-8">
            <div class="flex items-center justify-between">
                <h2 class="font-headline-md text-headline-md text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-2 h-6 bg-[#1b55db] dark:bg-primary rounded-full"></span>
                    Dernières publications pour Madagascar
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Article 1 -->
                <article class="bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-md flex flex-col group hover:border-[#1b55db] dark:hover:border-primary transition-all duration-300">
                    <div class="h-48 relative overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <img alt="Réussite aux examens" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=600&auto=format&fit=crop"/>
                        <span class="absolute top-4 left-4 bg-amber-500 text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded uppercase tracking-wider">Conseils d'étude</span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col space-y-4 justify-between">
                        <div class="space-y-2">
                            <span class="text-xs text-slate-400 dark:text-slate-500">20 Mai 2026 • Par Rabe Harison</span>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors">
                                Comment réviser efficacement pour le BACC et le BEPC à Madagascar ?
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3">
                                Les examens nationaux malgaches approchent à grands pas. Découvrez des techniques d'organisation adaptées au contexte local, comment s'organiser face aux défis quotidiens et optimiser l'utilisation des sujets types disponibles sur Studa.
                            </p>
                        </div>
                        <a href="#" @click.prevent="alert('Cet article sera disponible dans sa version complète très prochainement. Restez connectés !')" class="text-[#1b55db] dark:text-primary font-bold text-sm flex items-center gap-1 hover:underline">
                            Lire la suite <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-md flex flex-col group hover:border-[#1b55db] dark:hover:border-primary transition-all duration-300">
                    <div class="h-48 relative overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <img alt="Technologie éducation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=600&auto=format&fit=crop"/>
                        <span class="absolute top-4 left-4 bg-[#1b55db] text-white text-[10px] font-bold px-2.5 py-1 rounded uppercase tracking-wider">Technologie</span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col space-y-4 justify-between">
                        <div class="space-y-2">
                            <span class="text-xs text-slate-400 dark:text-slate-500">18 Mai 2026 • Par l'équipe Studa</span>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors">
                                Le rôle des cours en direct dans la démocratisation du savoir
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3">
                                Grâce à l'intégration de salons de visioconférence légers comme Jitsi, des enseignants basés à Antananarivo peuvent donner des cours de soutien en temps réel à des élèves à Tuléar ou Morondava, réduisant ainsi la fracture éducative.
                            </p>
                        </div>
                        <a href="#" @click.prevent="alert('Cet article sera disponible dans sa version complète très prochainement. Restez connectés !')" class="text-[#1b55db] dark:text-primary font-bold text-sm flex items-center gap-1 hover:underline">
                            Lire la suite <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-md flex flex-col group hover:border-[#1b55db] dark:hover:border-primary transition-all duration-300">
                    <div class="h-48 relative overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <img alt="OCR et Éducation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=600&auto=format&fit=crop"/>
                        <span class="absolute top-4 left-4 bg-purple-500 text-white text-[10px] font-bold px-2.5 py-1 rounded uppercase tracking-wider">Innovation</span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col space-y-4 justify-between">
                        <div class="space-y-2">
                            <span class="text-xs text-slate-400 dark:text-slate-500">15 Mai 2026 • Par Rakoto Tech</span>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors">
                                OCR & Indexation PDF : Comment Studa indexe les vieux polycopiés
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-sm line-clamp-3">
                                De nombreux cours et exercices précieux ne sont disponibles que sous forme de polycopiés scannés. Découvrez comment notre moteur OCR Tesseract extrait automatiquement le texte pour rendre chaque formule et chaque mot-clé instantanément recherchable.
                            </p>
                        </div>
                        <a href="#" @click.prevent="alert('Cet article sera disponible dans sa version complète très prochainement. Restez connectés !')" class="text-[#1b55db] dark:text-primary font-bold text-sm flex items-center gap-1 hover:underline">
                            Lire la suite <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </article>
            </div>
        </section>

        <!-- Section Témoignages et Focus Madagascar -->
        <section class="bg-slate-100 dark:bg-slate-900/30 rounded-3xl p-8 border border-slate-200 dark:border-slate-800 flex flex-col md:flex-row items-center gap-8 shadow-inner">
            <div class="space-y-4 md:w-2/3">
                <span class="text-xs text-[#1b55db] dark:text-primary font-bold tracking-widest uppercase">Éducation inclusive</span>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white leading-snug">
                    « Inspirer le changement et l'excellence de Tana à Fort-Dauphin, en passant par Majunga, Diego-Suarez et Fianarantsoa. »
                </h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                    Studa a été créée avec la conviction que la distance géographique ou les limitations d'infrastructures ne doivent pas être un frein à la réussite scolaire. En permettant aux enseignants malgaches de partager facilement leurs polycopiés, cours et sujets types de manière structurée avec indexation OCR, nous bâtissons ensemble l'école de demain.
                </p>
            </div>
            <div class="md:w-1/3 w-full border-t md:border-t-0 md:border-l border-slate-300 dark:border-slate-800 pt-6 md:pt-0 md:pl-8 flex flex-col justify-center space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center font-bold">
                        SM
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900 dark:text-white">Sahondra M.</h4>
                        <p class="text-xs text-slate-400">Professeur de Mathématiques - Fianarantsoa</p>
                    </div>
                </div>
                <p class="text-slate-600 dark:text-slate-400 text-xs italic">
                    "Grâce à l'OCR de Studa, mes élèves peuvent rechercher précisément un exercice de trigonométrie parmi les dizaines de fichiers PDF que je publie !"
                </p>
            </div>
    </div>

    <!-- Onglet Library (Bibliothèque complète) -->
    <div x-show="currentTab === 'library'" x-cloak x-data="{
        searchQuery: '',
        selectedLevel: '',
        selectedSubject: '',
        selectedType: '',
    }" class="space-y-8 py-6">

        <!-- En-tête de la Bibliothèque -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-[#1b55db] dark:text-primary">local_library</span>
                    Bibliothèque Numérique 🇲🇬
                </h1>
                <p class="text-slate-500 dark:text-outline text-sm mt-1">
                    Recherchez en temps réel parmi tous les polycopiés et sujets types indexés par OCR.
                </p>
            </div>
            <div class="bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 rounded-xl text-center self-start md:self-auto">
                <span class="text-xs text-slate-500 dark:text-outline font-medium block">Total ressources</span>
                <span class="text-lg font-black text-[#1b55db] dark:text-primary">{{ count($allPublishedCourses) }}</span>
            </div>
        </div>

        <!-- Outils de recherche et Filtres -->
        <div class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl p-6 shadow-md space-y-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                <!-- Champ de Recherche -->
                <div class="lg:col-span-6 relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 dark:text-outline">search</span>
                    <input x-model="searchQuery" 
                           type="text" 
                           class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-outline-variant rounded-xl pl-12 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#1b55db] focus:border-[#1b55db] dark:focus:ring-primary dark:focus:border-primary text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-outline" 
                           placeholder="Rechercher par titre, enseignant, théorème, mot-clé..."/>
                    <button x-show="searchQuery !== ''" @click="searchQuery = ''" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:text-outline dark:hover:text-white">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>

                <!-- Filtre Niveau -->
                <div class="lg:col-span-2">
                    <select x-model="selectedLevel" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-outline-variant rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-[#1b55db] text-slate-900 dark:text-white">
                        <option value="">Tous les niveaux</option>
                        @foreach($levels as $l)
                            <option value="{{ $l->id }}">{{ $l->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre Matière -->
                <div class="lg:col-span-2">
                    <select x-model="selectedSubject" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-outline-variant rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-[#1b55db] text-slate-900 dark:text-white">
                        <option value="">Toutes les matières</option>
                        @foreach($subjects as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre Type -->
                <div class="lg:col-span-2">
                    <select x-model="selectedType" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-outline-variant rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-[#1b55db] text-slate-900 dark:text-white">
                        <option value="">Tous les types</option>
                        <option value="course">Cours</option>
                        <option value="sujet_type">Sujet Type</option>
                        <option value="correction">Corrigé</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Liste des résultats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($allPublishedCourses as $course)
                <div x-show="(searchQuery === '' || {{ json_encode(strtolower($course['title'])) }}.includes(searchQuery.toLowerCase()) || {{ json_encode(strtolower($course['description'] ?? '')) }}.includes(searchQuery.toLowerCase()) || {{ json_encode(strtolower($course['extracted_text'] ?? '')) }}.includes(searchQuery.toLowerCase()) || {{ json_encode(strtolower($course['teacher']['name'])) }}.includes(searchQuery.toLowerCase())) && (selectedLevel === '' || '{{ $course['level']['id'] }}' == selectedLevel) && (selectedSubject === '' || '{{ $course['subject']['id'] }}' == selectedSubject) && (selectedType === '' || '{{ $course['type'] }}' === selectedType)"
                     class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl overflow-hidden flex flex-col group hover:border-[#1b55db] dark:hover:border-primary transition-all duration-300 shadow-md hover:shadow-xl">
                    <div class="h-40 relative overflow-hidden bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                        @if($course['thumbnail_path'])
                            <img alt="{{ $course['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="/storage/{{ $course['thumbnail_path'] }}"/>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 text-slate-400 dark:text-outline">
                                <span class="material-symbols-outlined text-4xl mb-2">menu_book</span>
                                <span class="text-[10px] uppercase font-bold tracking-wider">{{ $course['subject']['name'] }}</span>
                            </div>
                        @endif
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            <span class="bg-[#1b55db] text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">{{ $course['subject']['name'] }}</span>
                            <span class="bg-purple-600 text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">{{ $course['type'] }}</span>
                            <span class="bg-slate-900/80 backdrop-blur-md text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">{{ $course['level']['name'] }}</span>
                        </div>

                        <!-- Badge OCR si présent -->
                        @if($course['extracted_text'])
                            <div class="absolute bottom-2 right-2 bg-emerald-500/90 text-slate-950 text-[9px] font-extrabold px-2 py-0.5 rounded flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[10px]">pageview</span> OCR Indexé
                            </div>
                        @endif
                    </div>
                    <div class="p-5 flex-1 flex flex-col space-y-4 justify-between">
                        <div class="space-y-2">
                            <h3 class="font-bold text-base text-slate-900 dark:text-white group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors line-clamp-2">{{ $course['title'] }}</h3>
                            <p class="text-slate-500 dark:text-on-surface-variant text-xs line-clamp-2">{{ $course['description'] ?: 'Aucune description fournie.' }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <button @click="currentTab = 'mentors'; mentorSearchQuery = '{{ $course['teacher']['name'] }}'" 
                                    class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                                <div class="w-7 h-7 rounded-full overflow-hidden bg-[#1b55db]/20 text-[#1b55db] dark:text-blue-400 flex items-center justify-center font-bold text-[10px] border border-primary/20">
                                    @if($course['teacher']['avatar'] ?? null)
                                        <img src="/storage/{{ $course['teacher']['avatar'] }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($course['teacher']['name'], 0, 1) }}
                                    @endif
                                </div>
                                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">{{ $course['teacher']['name'] }}</span>
                            </button>
                            <span class="text-[10px] text-slate-400 dark:text-outline">{{ date('d M Y', strtotime($course['created_at'])) }}</span>
                        </div>
                        <div class="flex flex-col gap-2 pt-2">
                            <a href="/storage/{{ $course['file_path'] }}" target="_blank" class="w-full bg-[#1b55db] dark:bg-primary text-white dark:text-on-primary py-2.5 rounded-xl font-bold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2 shadow-sm">
                                <span class="material-symbols-outlined text-sm">visibility</span> Prévisualiser
                            </a>
                            <a href="/storage/{{ $course['file_path'] }}" download class="w-full bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white py-2.5 rounded-xl font-medium text-sm hover:bg-slate-200 dark:hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">download</span> Télécharger
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-400 dark:text-outline italic py-12 col-span-3">Aucun cours trouvé.</p>
            @endforelse
        </div>
    </div>

    <!-- Onglet Mentors (Enseignants) -->
    <div x-show="currentTab === 'mentors'" x-cloak x-data="{
        selectedSubject: '',
    }" class="space-y-8 py-6">

        <!-- En-tête -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-3xl text-[#1b55db] dark:text-primary">supervised_user_circle</span>
                    Nos Mentors d'Excellence 🇲🇬
                </h1>
                <p class="text-slate-500 dark:text-outline text-sm mt-1">
                    Découvrez et contactez les enseignants qualifiés engagés pour l'avenir de Madagascar.
                </p>
            </div>
            <div class="bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 rounded-xl text-center self-start md:self-auto">
                <span class="text-xs text-slate-500 dark:text-outline font-medium block">Professeurs validés</span>
                <span class="text-lg font-black text-[#1b55db] dark:text-primary">{{ count($allTeachers) }} connectés</span>
            </div>
        </div>

        <!-- Recherche et Filtres -->
        <div class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl p-6 shadow-md space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <!-- Recherche -->
                <div class="md:col-span-8 relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 dark:text-outline">search</span>
                    <input x-model="mentorSearchQuery" 
                           type="text" 
                           class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-outline-variant rounded-xl pl-12 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#1b55db] focus:border-[#1b55db] dark:focus:ring-primary dark:focus:border-primary text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-outline" 
                           placeholder="Rechercher un enseignant par son nom..."/>
                    <button x-show="mentorSearchQuery !== ''" @click="mentorSearchQuery = ''" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:text-outline dark:hover:text-white">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>

                <!-- Matière -->
                <div class="md:col-span-4">
                    <select x-model="selectedSubject" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-outline-variant rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-[#1b55db] text-slate-900 dark:text-white">
                        <option value="">Toutes les spécialités</option>
                        @foreach($subjects as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Liste des Professeurs -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($allTeachers as $teacher)
                @php
                    $teacherSubjects = $teacher['subjects'] ?? [];
                    $teacherLevels = $teacher['levels'] ?? [];
                    $subjectIds = collect($teacherSubjects)->pluck('id')->toArray();
                @endphp
                <div x-show="(mentorSearchQuery === '' || {{ json_encode(strtolower($teacher['name'])) }}.includes(mentorSearchQuery.toLowerCase()) || {{ json_encode(strtolower($teacher['email'])) }}.includes(mentorSearchQuery.toLowerCase())) && (selectedSubject === '' || {{ json_encode($subjectIds) }}.includes(parseInt(selectedSubject)))"
                     class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl overflow-hidden flex flex-col justify-between group hover:border-[#1b55db] dark:hover:border-primary transition-all duration-300 shadow-md hover:shadow-xl p-6 space-y-6">
                    
                    <!-- En-tête de la carte -->
                    <div class="flex items-start gap-4">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden bg-gradient-to-br from-[#1b55db] to-[#38bdf8] text-white flex items-center justify-center font-black text-2xl shadow-lg shrink-0 border-2 border-white dark:border-slate-800">
                            @if($teacher['avatar'])
                                <img src="/storage/{{ $teacher['avatar'] }}" alt="{{ $teacher['name'] }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($teacher['name'], 0, 1) }}
                            @endif
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white group-hover:text-[#1b55db] dark:group-hover:text-primary transition-colors">
                                {{ $teacher['name'] }}
                            </h3>
                            <p class="text-[10px] text-primary dark:text-primary font-black uppercase tracking-widest">
                                {{ $teacher['professional_title'] ?: 'Enseignant Certifié' }}
                            </p>
                            <span class="inline-flex items-center gap-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full mt-1">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Agréé Studa
                            </span>
                        </div>
                    </div>

                    <!-- Experience & Bio -->
                    <div class="space-y-2">
                        @if($teacher['experience'])
                            <p class="text-[10px] font-bold text-slate-500 dark:text-outline flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">workspace_premium</span>
                                {{ $teacher['experience'] }}
                            </p>
                        @endif
                        @if($teacher['bio'])
                            <p class="text-xs text-slate-600 dark:text-on-surface-variant line-clamp-3 italic leading-relaxed">
                                "{{ $teacher['bio'] }}"
                            </p>
                        @endif
                    </div>

                    <!-- Spécialités et Niveaux -->
                    <div class="space-y-3">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($teacherSubjects as $sub)
                                <span class="bg-[#1b55db]/10 text-[#1b55db] dark:text-primary text-[10px] font-semibold px-2 py-0.5 rounded">
                                    {{ $sub['name'] }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($teacherLevels as $lev)
                                <span class="bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[9px] font-bold px-2 py-0.5 rounded">
                                    {{ $lev['name'] }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Statistiques de l'enseignant -->
                    <div class="grid grid-cols-3 gap-2 bg-slate-50 dark:bg-slate-900/60 p-3 rounded-xl border border-slate-100 dark:border-slate-800 text-center">
                        <div>
                            <span class="text-lg font-black text-slate-900 dark:text-white">{{ $teacher['courses_count'] }}</span>
                            <span class="text-[9px] text-slate-400 dark:text-outline font-medium block">Cours</span>
                        </div>
                        <div>
                            <span class="text-lg font-black text-slate-900 dark:text-white">{{ $teacher['followers_count'] }}</span>
                            <span class="text-[9px] text-slate-400 dark:text-outline font-medium block">Abonnés</span>
                        </div>
                        <div>
                            <span class="text-lg font-black text-slate-900 dark:text-white">{{ $teacher['meetings_count'] }}</span>
                            <span class="text-[9px] text-slate-400 dark:text-outline font-medium block">Visios</span>
                        </div>
                    </div>

                    <!-- Actions (Email Masqué) -->
                    <div class="pt-2">
                        @php
                            $email = $teacher['email'];
                            $parts = explode('@', $email);
                            if(count($parts) === 2) {
                                $local = $parts[0];
                                $domain = $parts[1];
                                $len = strlen($local);
                                $keep = ceil($len / 2);
                                $maskedLocal = substr($local, 0, $keep) . str_repeat('•', $len - $keep);
                                $maskedEmail = $maskedLocal . '@' . $domain;
                            } else {
                                $maskedEmail = $email;
                            }
                        @endphp
                        <div class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 py-3 px-4 rounded-xl text-center flex items-center justify-center gap-2 group-hover:border-[#1b55db] dark:group-hover:border-primary transition-all">
                            <span class="material-symbols-outlined text-slate-400 dark:text-outline text-sm">mail</span>
                            <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 font-mono tracking-wide" title="Email protégé pour la confidentialité">{{ $maskedEmail }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-400 dark:text-outline italic py-12 col-span-3">Aucun professeur trouvé.</p>
            @endforelse
        </div>

        <!-- Aucun résultat (Empty State) -->
        <div x-show="mentorSearchQuery !== '' && !{{ json_encode($allTeachers->pluck('name')->map(fn($n) => strtolower($n))) }}.some(name => name.includes(mentorSearchQuery.toLowerCase()))" 
             class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl p-12 text-center max-w-xl mx-auto space-y-4 shadow-md">
            <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-outline">person_off</span>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aucun professeur trouvé</h3>
            <p class="text-slate-500 dark:text-outline text-sm">
                Essayez d'ajuster vos termes de recherche ou de sélectionner une autre spécialité.
            </p>
            <button @click="mentorSearchQuery = ''; selectedSubject = ''" class="inline-flex items-center gap-2 bg-[#1b55db] text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:opacity-90 transition-all">
                <span class="material-symbols-outlined text-sm">restart_alt</span> Réinitialiser
            </button>
        </div>
    </div>
</main>

<footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-4 transition-colors">
    <p class="text-xs text-slate-500 font-inter">© 2026 Studa Education. Empowerment through precision.</p>
    <div class="flex items-center gap-8">
        <a class="text-slate-500 hover:text-[#1b55db] dark:hover:text-blue-400 text-xs transition-colors" href="#">Privacy Policy</a>
        <a class="text-slate-500 hover:text-[#1b55db] dark:hover:text-blue-400 text-xs transition-colors" href="#">Terms of Service</a>
        <a class="text-slate-500 hover:text-[#1b55db] dark:hover:text-blue-400 text-xs transition-colors" href="#">Support</a>
        <a class="text-slate-500 hover:text-[#1b55db] dark:hover:text-blue-400 text-xs transition-colors" href="#">Contact Us</a>
    </div>
</footer>

<script>
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleIcon = document.getElementById('theme-toggle-icon');
    const htmlElement = document.documentElement;

    // Check localStorage or browser preference on load
    if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && !window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        htmlElement.classList.remove('dark');
        themeToggleIcon.textContent = 'light_mode';
    } else {
        htmlElement.classList.add('dark');
        themeToggleIcon.textContent = 'dark_mode';
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