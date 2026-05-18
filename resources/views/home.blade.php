<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary": "#003824",
                        "primary-fixed-dim": "#adc6ff",
                        "outline-variant": "#424754",
                        "on-primary-fixed": "#001a42",
                        "on-tertiary": "#472a00",
                        "on-surface": "#dce2f7",
                        "on-secondary-container": "#00311f",
                        "outline": "#8c909f",
                        "on-error-container": "#ffdad6",
                        "error-container": "#93000a",
                        "inverse-on-surface": "#293040",
                        "on-primary-container": "#00285d",
                        "tertiary-container": "#ca8100",
                        "inverse-primary": "#005ac2",
                        "error": "#ffb4ab",
                        "primary": "#adc6ff",
                        "secondary-container": "#00a572",
                        "surface-container": "#191f2f",
                        "background": "#0c1322",
                        "surface-bright": "#323949",
                        "secondary-fixed-dim": "#4edea3",
                        "surface-container-lowest": "#070e1d",
                        "surface": "#0c1322",
                        "on-background": "#dce2f7",
                        "tertiary-fixed": "#ffddb8",
                        "on-secondary-fixed-variant": "#005236",
                        "on-primary-fixed-variant": "#004395",
                        "surface-container-highest": "#2e3545",
                        "on-tertiary-fixed-variant": "#653e00",
                        "on-tertiary-fixed": "#2a1700",
                        "surface-container-high": "#232a3a",
                        "on-primary": "#002e6a",
                        "primary-container": "#4d8eff",
                        "on-tertiary-container": "#3e2400",
                        "on-surface-variant": "#c2c6d6",
                        "surface-variant": "#2e3545",
                        "surface-tint": "#adc6ff",
                        "secondary-fixed": "#6ffbbe",
                        "primary-fixed": "#d8e2ff",
                        "surface-dim": "#0c1322",
                        "tertiary-fixed-dim": "#ffb95f",
                        "surface-container-low": "#141b2b",
                        "inverse-surface": "#dce2f7",
                        "on-secondary-fixed": "#002113",
                        "on-error": "#690005",
                        "secondary": "#4edea3",
                        "tertiary": "#ffb95f"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "lg": "24px",
                        "xs": "4px",
                        "md": "16px",
                        "xl": "32px",
                        "gutter": "20px",
                        "base": "4px",
                        "margin": "24px",
                        "sm": "8px"
                    },
                    "fontFamily": {
                        "stat-value": ["Inter"],
                        "display-lg": ["Inter"],
                        "title-sm": ["Inter"],
                        "body-base": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "label-caps": ["Inter"]
                    },
                    "fontSize": {
                        "stat-value": ["28px", {"lineHeight": "1.1", "fontWeight": "700"}],
                        "display-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "title-sm": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "body-base": ["15px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "body-sm": ["13px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "label-caps": ["11px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-background font-body-base text-slate-800 dark:text-on-background selection:bg-primary-container selection:text-on-primary-container transition-colors duration-200">

<nav class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 shadow-sm flex justify-between items-center px-6 h-16 transition-colors">
    <div class="flex items-center gap-8">
        <a href="/" class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Studa</a>
        <form action="/" class="hidden md:flex items-center bg-slate-100 dark:bg-slate-800/50 rounded-lg px-3 py-1.5 border border-slate-200 dark:border-slate-700">
            <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-sm mr-2">search</span>
            <input name="search" value="{{ request('search') }}" class="bg-transparent border-none text-sm text-slate-900 dark:text-white focus:ring-0 w-64 placeholder:text-slate-400 dark:placeholder:text-slate-500" placeholder="Rechercher un cours..." type="text"/>
        </form>
    </div>
    
    <div class="hidden md:flex items-center gap-6">
        <a class="text-blue-600 dark:text-blue-400 font-semibold border-b-2 border-blue-500 pb-1 font-inter" href="#">Courses</a>
        <a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors font-inter" href="#">My Learning</a>
        <a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors font-inter" href="#">Library</a>
        <a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors font-inter" href="#">Mentors</a>
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
            <a href="{{ route($dashboardRoute) }}" class="text-slate-700 dark:text-white hover:text-blue-600 dark:hover:text-primary transition-colors text-sm font-semibold">Portal</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-white px-4 py-2 rounded-lg font-semibold text-sm active:scale-95 duration-150 hover:bg-slate-300 dark:hover:bg-slate-700">Logout</button>
            </form>
        @else
            <a href="/login" class="bg-blue-600 dark:bg-primary-container text-white dark:text-on-primary-container px-4 py-2 rounded-lg font-semibold text-sm active:scale-95 duration-150 hover:bg-blue-700 dark:hover:opacity-90">Login</a>
        @endauth
    </div>
</nav>

<main class="mt-16 p-lg space-y-xl min-h-screen container mx-auto max-w-7xl">

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
                    <button type="submit" class="bg-blue-600 dark:bg-primary text-white dark:text-on-primary px-6 py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-blue-700 dark:hover:bg-primary/90 transition-all text-sm whitespace-nowrap">
                        Rechercher
                    </button>
                </form>
            </div>
            
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[420px] aspect-square rounded-2xl overflow-hidden shadow-xl border-4 border-white dark:border-slate-800 bg-amber-50">
                    <img alt="Hero Graphic" class="w-full h-full object-cover" src="/hero1.jpg"/>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12 md:mt-16">
            <div class="bg-amber-50/60 dark:bg-slate-800/40 border-t-4 border-amber-400 dark:border-amber-500 rounded-2xl p-6 md:p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Étudiants</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                        Faites un grand pas vers votre nouvelle carrière en suivant l'une de nos formations diplômantes.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4 mt-6">
                    <button class="bg-[#6366f1] hover:bg-[#4f46e5] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-sm">
                        Démarrer mon inscription
                    </button>
                    <a href="#" class="text-[#6366f1] dark:text-blue-400 font-semibold text-sm hover:underline">
                        Découvrir les formations diplômantes
                    </a>
                </div>
            </div>

            <div class="bg-blue-50/40 dark:bg-slate-800/40 border-t-4 border-blue-400 dark:border-blue-500 rounded-2xl p-6 md:p-8 flex flex-col justify-between shadow-sm hover:shadow-md transition-all">
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Employeurs</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                        Recrutez des alternants qui créent de la valeur rapidement et formez vos équipes aux compétences à fort impact.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4 mt-6">
                    <button class="bg-[#6366f1] hover:bg-[#4f46e5] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-sm">
                        Explorer l'espace employeur
                    </button>
                    <a href="#" class="text-[#6366f1] dark:text-blue-400 font-semibold text-sm hover:underline">
                        Découvrir nos solutions
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-md">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-slate-900 dark:text-white flex items-center gap-2">
                <span class="w-2 h-6 bg-blue-600 dark:bg-primary rounded-full"></span>
                Ton Niveau Académique
            </h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-gutter">
            @foreach($levels as $l)
                <a href="?level_id={{ $l->id }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
                   class="{{ request('level_id') == $l->id ? 'bg-blue-600/10 dark:bg-blue-600/20 border-blue-500 shadow-lg' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 hover:border-blue-500 dark:hover:border-primary hover:bg-slate-50 dark:hover:bg-slate-800' }} p-4 rounded-xl text-center border transition-all group">
                    <p class="text-slate-400 dark:text-slate-500 font-label-caps group-hover:text-blue-600 dark:group-hover:text-primary transition-colors">{{ $l->category }}</p>
                    <p class="text-slate-900 dark:text-white font-title-sm mt-1">{{ $l->name }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="space-y-md">
        <div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar">
            <a href="?level_id={{ request('level_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ !request('subject_id') ? 'bg-blue-600 dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap font-medium text-sm transition-all shadow-sm">
                <span class="material-symbols-outlined text-lg">all_inclusive</span>
                Tous les sujets
            </a>
            @foreach($subjects as $s)
                <a href="?subject_id={{ $s->id }}&level_id={{ request('level_id') }}&search={{ request('search') }}" 
                   class="flex items-center gap-2 {{ request('subject_id') == $s->id ? 'bg-blue-600 dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                    <span class="material-symbols-outlined text-lg">{{ $s->icon ?: 'book' }}</span>
                    {{ $s->name }}
                </a>
            @endforeach
        </div>
    </section>

    <section class="space-y-md">
        <div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar">
            <a href="?level_id={{ request('level_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ !request('type') ? 'bg-blue-600 dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Tous les types
            </a>
            <a href="?type=course&level_id={{ request('level_id') }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ request('type') == 'course' ? 'bg-blue-600 dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Cours
            </a>
            <a href="?type=sujet_type&level_id={{ request('level_id') }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ request('type') == 'sujet_type' ? 'bg-blue-600 dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Sujets Types
            </a>
            <a href="?type=correction&level_id={{ request('level_id') }}&subject_id={{ request('subject_id') }}&search={{ request('search') }}" 
               class="flex items-center gap-2 {{ request('type') == 'correction' ? 'bg-blue-600 dark:bg-primary text-white dark:text-on-primary' : 'bg-white dark:bg-surface-container hover:bg-slate-50 dark:hover:bg-surface-container-high border border-slate-200 dark:border-outline-variant text-slate-700 dark:text-on-surface-variant' }} px-5 py-2.5 rounded-full whitespace-nowrap text-sm transition-all shadow-sm">
                Corrigés
            </a>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter pb-xl">
        @forelse($courses as $course)
            <div class="bg-white dark:bg-surface-container border border-slate-200 dark:border-outline-variant rounded-2xl overflow-hidden flex flex-col group hover:border-blue-500 dark:hover:border-primary transition-all duration-300 shadow-md hover:shadow-xl">
                <div class="h-48 relative overflow-hidden bg-slate-100 dark:bg-slate-800">
                    <img alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $course->thumbnail_path ? asset('storage/' . $course->thumbnail_path) : 'https://picsum.photos/400/300' }}"/>
                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                        <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $course->subject->name }}</span>
                        <span class="bg-purple-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $course->type }}</span>
                        <span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">{{ $course->level->name }}</span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col space-y-4">
                    <div>
                        <h3 class="font-title-sm text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-primary transition-colors line-clamp-2">{{ $course->title }}</h3>
                        <p class="text-slate-500 dark:text-on-surface-variant text-body-sm mt-1 line-clamp-2">{{ Str::limit($course->description, 100) }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-[10px]">
                                {{ substr($course->teacher->name, 0, 1) }}
                            </div>
                            <span class="text-xs font-medium text-slate-600 dark:text-slate-300">{{ $course->teacher->name }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pt-2">
                        <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" class="w-full bg-blue-600 dark:bg-primary text-white dark:text-on-primary py-2.5 rounded-xl font-bold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2 shadow-sm">
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
    {{ $courses->links('pagination::tailwind') }}
</main>

<footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-4 transition-colors">
    <p class="text-xs text-slate-500 font-inter">© 2026 Studa Education. Empowerment through precision.</p>
    <div class="flex items-center gap-8">
        <a class="text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 text-xs transition-colors" href="#">Privacy Policy</a>
        <a class="text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 text-xs transition-colors" href="#">Terms of Service</a>
        <a class="text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 text-xs transition-colors" href="#">Support</a>
        <a class="text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 text-xs transition-colors" href="#">Contact Us</a>
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