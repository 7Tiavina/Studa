<!DOCTYPE html>
<html class="dark" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #0c1322;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
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
<body class="bg-background font-body-base text-on-background selection:bg-primary-container selection:text-on-primary-container">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-slate-900/80 backdrop-blur-md border-b border-slate-800 shadow-lg flex justify-between items-center px-6 h-16">
<div class="flex items-center gap-8">
<span class="text-2xl font-black tracking-tight text-white">Studa</span>
<div class="hidden md:flex items-center bg-slate-800/50 rounded-lg px-3 py-1.5 border border-slate-700">
<span class="material-symbols-outlined text-slate-400 text-sm mr-2">search</span>
<input class="bg-transparent border-none text-sm text-white focus:ring-0 w-64 placeholder:text-slate-500" placeholder="Rechercher un cours..." type="text"/>
</div>
</div>
<div class="hidden md:flex items-center gap-6">
<a class="text-blue-400 font-semibold border-b-2 border-blue-500 pb-1 font-inter" href="#">Courses</a>
<a class="text-slate-400 hover:text-white transition-colors font-inter" href="#">My Learning</a>
<a class="text-slate-400 hover:text-white transition-colors font-inter" href="#">Library</a>
<a class="text-slate-400 hover:text-white transition-colors font-inter" href="#">Mentors</a>
</div>
<div class="flex items-center gap-4">
    @auth
        @php
            $dashboardRoute = 'student.dashboard';
            if (Auth::user()->role === 'teacher') {
                $dashboardRoute = 'teacher.dashboard';
            } elseif (Auth::user()->role === 'admin') {
                $dashboardRoute = 'admin.dashboard';
            }
        @endphp
        <a href="{{ route($dashboardRoute) }}" class="text-white hover:text-primary transition-colors text-sm font-semibold">Portal</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-lg font-semibold text-sm active:scale-95 duration-150">Logout</button>
        </form>
    @else
        <a href="/login" class="bg-primary-container text-on-primary-container px-4 py-2 rounded-lg font-semibold text-sm active:scale-95 duration-150">Login</a>
    @endauth
</div>
</nav>

<!-- Main Content Canvas -->
<main class="mt-16 p-lg space-y-lg min-h-screen">
<!-- Hero Section -->
<section class="relative rounded-xl overflow-hidden min-h-[320px] flex flex-col justify-center px-12 border border-slate-800 group">
<div class="absolute inset-0 z-0">
<img alt="Hero Background" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7UgsiwcCAaeRgPVSe37RULp1Ot4-BRFrUU_y55D9o8nwjejSGeDd6lmov8tf8lwl0BuMjxNiU1AIfh_RnTcvJ7NC3oxUf-paEXxDgzKs0uWKK7zQxjKIVwKxVFtTsklCAo3kW2p8Vs5h73iwuYeEDMcahkLU66K3WV4lkljua3kFvg6_Sx7EpEoGmekFts7xt3SGgnqyjK710Dd8ABYFAutpFMP9tVqhrw4Wd1I0DyTTVCnB9jhPp-1HgoZzzCSuWhYcMyh2PNtQ"/>
<div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
</div>
<div class="relative z-10 max-w-2xl space-y-6">
<h1 class="font-display-lg text-display-lg text-white leading-tight">
                    Bienvenue sur Studa, <br/>
<span class="text-primary">ton succès commence ici.</span>
</h1>
<p class="text-on-surface-variant font-body-base max-w-md">
                    Accédez aux meilleures ressources pédagogiques pour exceller dans vos examens nationaux.
                </p>
<div class="flex items-center bg-surface-container-high rounded-xl p-1 border border-outline-variant max-w-lg">
<input class="bg-transparent border-none text-white focus:ring-0 flex-1 px-4 py-2 placeholder:text-slate-500 font-body-sm" placeholder="Quel sujet souhaites-tu réviser ?" type="text"/>
<button class="bg-primary text-on-primary px-6 py-3 rounded-lg font-bold flex items-center gap-2 hover:bg-primary-container transition-all">
<span class="material-symbols-outlined" data-icon="search">search</span>
                        Rechercher
                    </button>
</div>
</div>
</section>
<!-- Academic Level Filters -->
<section class="space-y-md">
<div class="flex items-center justify-between">
<h2 class="font-headline-md text-headline-md text-white flex items-center gap-2">
<span class="w-2 h-6 bg-primary rounded-full"></span>
                    Ton Niveau Académique
                </h2>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-gutter">
<button class="bg-slate-900 border border-slate-800 p-4 rounded-xl text-center hover:border-primary hover:bg-slate-800 transition-all group">
<p class="text-slate-500 font-label-caps group-hover:text-primary">Lycée</p>
<p class="text-white font-title-sm mt-1">Seconde</p>
</button>
<button class="bg-slate-900 border border-slate-800 p-4 rounded-xl text-center hover:border-primary hover:bg-slate-800 transition-all group">
<p class="text-slate-500 font-label-caps group-hover:text-primary">Lycée</p>
<p class="text-white font-title-sm mt-1">Première</p>
</button>
<button class="bg-blue-600/20 border border-blue-500 p-4 rounded-xl text-center shadow-lg shadow-blue-500/10">
<p class="text-blue-400 font-label-caps">Baccalauréat</p>
<p class="text-white font-title-sm mt-1">Terminale S</p>
</button>
<button class="bg-slate-900 border border-slate-800 p-4 rounded-xl text-center hover:border-primary hover:bg-slate-800 transition-all group">
<p class="text-slate-500 font-label-caps group-hover:text-primary">Baccalauréat</p>
<p class="text-white font-title-sm mt-1">Terminale D</p>
</button>
<button class="bg-slate-900 border border-slate-800 p-4 rounded-xl text-center hover:border-primary hover:bg-slate-800 transition-all group">
<p class="text-slate-500 font-label-caps group-hover:text-primary">Baccalauréat</p>
<p class="text-white font-title-sm mt-1">Terminale C</p>
</button>
<button class="bg-slate-900 border border-slate-800 p-4 rounded-xl text-center hover:border-primary hover:bg-slate-800 transition-all group">
<p class="text-slate-500 font-label-caps group-hover:text-primary">Baccalauréat</p>
<p class="text-white font-title-sm mt-1">Terminale A</p>
</button>
</div>
</section>
<!-- Subject Filters -->
<section class="space-y-md">
<div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar">
<button class="flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-full whitespace-nowrap font-medium text-sm">
<span class="material-symbols-outlined text-lg" data-icon="all_inclusive">all_inclusive</span>
                    Tous les sujets
                </button>
<button class="flex items-center gap-2 bg-surface-container hover:bg-surface-container-high px-5 py-2.5 rounded-full border border-outline-variant whitespace-nowrap text-sm text-on-surface-variant transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="functions">functions</span>
                    Mathématiques
                </button>
<button class="flex items-center gap-2 bg-surface-container hover:bg-surface-container-high px-5 py-2.5 rounded-full border border-outline-variant whitespace-nowrap text-sm text-on-surface-variant transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="biotech">biotech</span>
                    Physique-Chimie
                </button>
<button class="flex items-center gap-2 bg-surface-container hover:bg-surface-container-high px-5 py-2.5 rounded-full border border-outline-variant whitespace-nowrap text-sm text-on-surface-variant transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="eco">eco</span>
                    SVT
                </button>
<button class="flex items-center gap-2 bg-surface-container hover:bg-surface-container-high px-5 py-2.5 rounded-full border border-outline-variant whitespace-nowrap text-sm text-on-surface-variant transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="psychology">psychology</span>
                    Philosophie
                </button>
<button class="flex items-center gap-2 bg-surface-container hover:bg-surface-container-high px-5 py-2.5 rounded-full border border-outline-variant whitespace-nowrap text-sm text-on-surface-variant transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="language">language</span>
                    Anglais
                </button>
<button class="flex items-center gap-2 bg-surface-container hover:bg-surface-container-high px-5 py-2.5 rounded-full border border-outline-variant whitespace-nowrap text-sm text-on-surface-variant transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="translate">translate</span>
                    Malagasy
                </button>
</div>
</section>
<!-- Course Grid -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter pb-xl">
<!-- Course Card 1 -->
<div class="bg-surface-container border border-outline-variant rounded-xl overflow-hidden flex flex-col group hover:border-primary transition-all duration-300 shadow-xl">
<div class="h-48 relative overflow-hidden">
<img alt="Analyse de fonctions" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCE1-dwBkAsqOKOxIhZ5xy8yg4guKqLUN2-F283csUKwuihuTGUMCKHlspSyr-0YLHmwfXnU5Kl1ifnA_xottglgXLAvfU5rB-VBoJku2vVO_K_2ijy3SbSOqrGfCaa5oTZtI_yiujAI3nB6wKPhYWXopDEQbxqxKEuQWl_u2f0svJVJ7Vz9VchvTeKAB-fMEp5ihb1u3FPcD21tc-v8fTG1RBlwt_Gu76QZUF9h4ncR6rvbpRZH2ICRi8Y2KESmyxRMSbrYDYPp-4"/>
<div class="absolute top-4 left-4 flex gap-2">
<span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Maths</span>
<span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Terminale S</span>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
</div>
<div class="p-6 flex-1 flex flex-col space-y-4">
<div>
<h3 class="font-title-sm text-white group-hover:text-primary transition-colors">Analyse de fonctions exponentielles</h3>
<p class="text-on-surface-variant text-body-sm mt-1">Maîtrisez les limites, dérivées et intégrales des fonctions exponentielles complexes.</p>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<img alt="Instructor" class="w-8 h-8 rounded-full object-cover border border-slate-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJIe-xDI4kMM225rwLppUU6kdAEK9iuSLMB05RMrsD7jPbh2CmUnraTtxvbyTNuQvXss9txKQidAOF8rXsS7yDr91XT8X6p9uTgFQxQ9UjNckyJ7eyE8Xejs56_eCudHmxMUv-VCofbDLSpru2rkSKKIOuJe_XI_tOnynfHnPACyZbvPmhpOELGVc1jn3h_t8uW4tARYpWy3Fhyf-6ukyPPUA3jcAAkvsjDJX-Eif9FZdvmf4poSZiYuinuEcDxo0x3TDos7jw-bE"/>
<span class="text-xs font-medium text-slate-300">Dr. Fenosoa R.</span>
</div>
<div class="flex items-center gap-1 text-tertiary">
<span class="material-symbols-outlined text-sm" data-icon="star" data-weight="fill">star</span>
<span class="text-xs font-bold">4.9</span>
</div>
</div>
<div class="flex flex-col gap-2 pt-2">
<button class="w-full bg-primary text-on-primary py-2.5 rounded-lg font-bold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2">
                            Commencer le cours
                        </button>
<button class="w-full bg-slate-800 text-white py-2.5 rounded-lg font-medium text-sm hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="download">download</span>
                            Télécharger PDF
                        </button>
</div>
</div>
</div>
<!-- Course Card 2 -->
<div class="bg-surface-container border border-outline-variant rounded-xl overflow-hidden flex flex-col group hover:border-primary transition-all duration-300 shadow-xl">
<div class="h-48 relative overflow-hidden">
<img alt="Optique Géométrique" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKYCX0khYRUvlyLUntTZ2iRIe5hUNmqDqaZN7HOMuLr0Lrsptl2D03jmaU0B4yfNaPJW-DcyrZniZ9jqLX2zKi-sBRF0b7CdF-klFfUT30Qk_JTtRN_BR4So1a_2YGJcuNr4K0bAIxMtAeQrzeZuxbN6KWHIkJXKTLpoHEPusQJYDnGpkAtgCB0PpIVuVoN-uUJgpqcAvceTDKBsGEVsJXmd1lgpxLqTKFHKiBd7VP6ko0H8-FyWoHw221p0zxjF2zIhn8WfWEcBU"/>
<div class="absolute top-4 left-4 flex gap-2">
<span class="bg-secondary-container text-on-secondary-container text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Physique</span>
<span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Terminale S</span>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
</div>
<div class="p-6 flex-1 flex flex-col space-y-4">
<div>
<h3 class="font-title-sm text-white group-hover:text-primary transition-colors">Optique Géométrique : Miroirs &amp; Lentilles</h3>
<p class="text-on-surface-variant text-body-sm mt-1">Tout sur la formation des images et les instruments d'optique pour le bac.</p>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<img alt="Instructor" class="w-8 h-8 rounded-full object-cover border border-slate-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbCGZfgqRplzW0DJAO7DW8YdFJ8suGSRV5lap3EVbNAyEL0zyjJhClh_2DqmMrxSk2Mq4hUBgPYyHPDkZSgFKagBFiwFcUFqg0Bb9EI_WirWp2V0tJqVVf0EJ1g1KDNNkV6_szevWSmFl6QiiXfIGfwsiHXoKHcn1DIQYZhHKYB3Sff0wJzLb3QlA6Yj8BSSi3sy_9aXpPRq3ZLGxGCyJimhFCRp3i4Vnkr662KmFm18OuVnlvSZ9rZUDgDrIANFCKhSGKh_qHlp0"/>
<span class="text-xs font-medium text-slate-300">Mme. Tahina A.</span>
</div>
<div class="flex items-center gap-1 text-tertiary">
<span class="material-symbols-outlined text-sm" data-icon="star" data-weight="fill">star</span>
<span class="text-xs font-bold">4.7</span>
</div>
</div>
<div class="flex flex-col gap-2 pt-2">
<button class="w-full bg-primary text-on-primary py-2.5 rounded-lg font-bold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2">
                            Commencer le cours
                        </button>
<button class="w-full bg-slate-800 text-white py-2.5 rounded-lg font-medium text-sm hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="download">download</span>
                            Télécharger PDF
                        </button>
</div>
</div>
</div>
<!-- Course Card 3 -->
<div class="bg-surface-container border border-outline-variant rounded-xl overflow-hidden flex flex-col group hover:border-primary transition-all duration-300 shadow-xl">
<div class="h-48 relative overflow-hidden">
<img alt="Génétique Humaine" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4hlVa87DvsND7KKhaXYyLejxXk_IOONK7y4PAYlf9loIGGlOXOpjj4Of9yeRUD2RX3ONP2ScVUy0ttBTNnqPxULW4T38Bq__DHEvRqgZg5OnRwnSAlhr_w5Mgu1-3KmQ00VvCUTwLMSDcohTsH4aV0UmKbzIS13Qc7lblkKhaNyU63LjGI-H7vygTWhqtah3ugRyoxlf5fiUjs3My3ciffxoK_2j24o-Spyj2TSUh7Ir7ZYPiIlWIn9HPWv3U-UnGrJs4b8U7r-U"/>
<div class="absolute top-4 left-4 flex gap-2">
<span class="bg-tertiary-container text-on-tertiary-container text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">SVT</span>
<span class="bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Terminale D</span>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
</div>
<div class="p-6 flex-1 flex flex-col space-y-4">
<div>
<h3 class="font-title-sm text-white group-hover:text-primary transition-colors">Génétique Humaine et Hérédité</h3>
<p class="text-on-surface-variant text-body-sm mt-1">Étude approfondie de la transmission des caractères et des cycles cellulaires.</p>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<img alt="Instructor" class="w-8 h-8 rounded-full object-cover border border-slate-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqUXlXkLA3jKq4Ofln-zHux2EntBErWYmvITVoFj2aZa7cYrwuZZEdUnOMxXW6JpxEEdPn2dTx6Hf1-v4oOBMDezWDzGBvsMV6XjvQ0S7wxpeZXH-oOrQwrcIae99or9mdOYkH7LQbZY9IOc7aQ46CdAeq4_kNZsX5BX9W8Ok2WP3CSPnGPHTqZX_LHKkpCxMcjTKnX8Cb22Tz48wcltPFWgCqSBJj5R1JKr2PvXgQR9I71gvij5nLhfOSbnhhZuf7G64xgdehfgg"/>
<span class="text-xs font-medium text-slate-300">Mr. Toky J.</span>
</div>
<div class="flex items-center gap-1 text-tertiary">
<span class="material-symbols-outlined text-sm" data-icon="star" data-weight="fill">star</span>
<span class="text-xs font-bold">4.8</span>
</div>
</div>
<div class="flex flex-col gap-2 pt-2">
<button class="w-full bg-primary text-on-primary py-2.5 rounded-lg font-bold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2">
                            Commencer le cours
                        </button>
<button class="w-full bg-slate-800 text-white py-2.5 rounded-lg font-medium text-sm hover:bg-slate-700 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="download">download</span>
                            Télécharger PDF
                        </button>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-slate-950 border-t border-slate-800 w-full py-12 px-8 flex flex-col md:flex-row justify-between items-center gap-4">
<p class="text-xs text-slate-500 font-inter">© 2024 Studa Education. Empowerment through precision.</p>
<div class="flex items-center gap-8">
<a class="text-slate-500 hover:text-blue-400 text-xs transition-colors opacity-80 hover:opacity-100" href="#">Privacy Policy</a>
<a class="text-slate-500 hover:text-blue-400 text-xs transition-colors opacity-80 hover:opacity-100" href="#">Terms of Service</a>
<a class="text-slate-500 hover:text-blue-400 text-xs transition-colors opacity-80 hover:opacity-100" href="#">Support</a>
<a class="text-slate-500 hover:text-blue-400 text-xs transition-colors opacity-80 hover:opacity-100" href="#">Contact Us</a>
</div>
</footer>
</body></html>
