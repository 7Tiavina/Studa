<!DOCTYPE html>

<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "primary-fixed-dim": "#adc6ff",
                "outline-variant": "#424754",
                "on-secondary-fixed": "#002113",
                "surface-bright": "#323949",
                "tertiary": "#ffb95f",
                "background": "#0c1322",
                "on-secondary-container": "#00311f",
                "surface-dim": "#0c1322",
                "tertiary-fixed": "#ffddb8",
                "on-primary-fixed": "#001a42",
                "secondary-container": "#00a572",
                "on-error-container": "#ffdad6",
                "on-primary": "#002e6a",
                "on-tertiary-container": "#3e2400",
                "on-secondary": "#003824",
                "tertiary-fixed-dim": "#ffb95f",
                "secondary-fixed-dim": "#4edea3",
                "secondary-fixed": "#6ffbbe",
                "primary-fixed": "#d8e2ff",
                "on-tertiary-fixed-variant": "#653e00",
                "on-primary-fixed-variant": "#004395",
                "surface": "#0c1322",
                "error": "#ffb4ab",
                "tertiary-container": "#ca8100",
                "on-error": "#690005",
                "on-primary-container": "#00285d",
                "on-tertiary": "#472a00",
                "on-secondary-fixed-variant": "#005236",
                "inverse-surface": "#dce2f7",
                "on-background": "#dce2f7",
                "primary": "#adc6ff",
                "surface-container-lowest": "#070e1d",
                "error-container": "#93000a",
                "surface-container-low": "#141b2b",
                "surface-variant": "#2e3545",
                "primary-container": "#4d8eff",
                "inverse-on-surface": "#293040",
                "outline": "#8c909f",
                "surface-container-high": "#232a3a",
                "surface-container": "#191f2f",
                "secondary": "#4edea3",
                "surface-container-highest": "#2e3545",
                "on-surface": "#dce2f7",
                "on-tertiary-fixed": "#2a1700",
                "inverse-primary": "#005ac2",
                "on-surface-variant": "#c2c6d6",
                "surface-tint": "#adc6ff"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "base": "4px",
                "xs": "4px",
                "gutter": "20px",
                "lg": "24px",
                "sm": "8px",
                "xl": "32px",
                "margin": "24px",
                "md": "16px"
            },
            "fontFamily": {
                "stat-value": ["Inter"],
                "body-sm": ["Inter"],
                "label-caps": ["Inter"],
                "body-base": ["Inter"],
                "display-lg": ["Inter"],
                "headline-md": ["Inter"],
                "title-sm": ["Inter"]
            },
            "fontSize": {
                "stat-value": ["28px", {"lineHeight": "1.1", "fontWeight": "700"}],
                "body-sm": ["13px", {"lineHeight": "1.5", "fontWeight": "400"}],
                "label-caps": ["11px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "700"}],
                "body-base": ["15px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "display-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "headline-md": ["24px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                "title-sm": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}]
            }
          }
        }
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #0c1322;
        }
    </style>
</head>
<body class="font-body-base text-on-background selection:bg-primary selection:text-on-primary">
<!-- SideNavBar -->
<aside class="flex flex-col h-screen fixed z-50 bg-slate-950 font-sans text-[14px] font-medium fixed left-0 top-0 h-full w-[260px] border-r border-slate-800 flat">
<div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
<nav class="flex-1 px-4 space-y-1">
<a class="flex items-center gap-3 px-4 py-3 bg-blue-600/10 text-blue-500 border-r-2 border-blue-500 transition-all ease-in-out duration-200" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                Dashboard
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200" href="#">
<span class="material-symbols-outlined" data-icon="menu_book">menu_book</span>
                My Content
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
                Students
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200" href="#">
<span class="material-symbols-outlined" data-icon="video_call">video_call</span>
                Live Courses
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200" href="#">
<span class="material-symbols-outlined" data-icon="insights">insights</span>
                Analytics
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
                Settings
            </a>
</nav>
<div class="px-6 py-4">
<button class="w-full py-3 px-4 bg-primary text-on-primary font-bold rounded-lg transition-transform scale-95 active:duration-75 flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[20px]" data-icon="add_circle">add_circle</span>
                Create Quiz
            </button>
</div>
<div class="mt-auto p-4 border-t border-slate-800">
<a class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all" href="#">
<span class="material-symbols-outlined" data-icon="contact_support">contact_support</span>
                Help Center
            </a>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all">
        <span class="material-symbols-outlined" data-icon="logout">logout</span>
        Logout
    </button>
</form>
</div>
</aside>
<!-- Main Content Wrapper -->
<main class="ml-[260px] min-h-screen">
<!-- TopNavBar -->
<header class="flex items-center justify-between px-6 h-16 w-full sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800 flat no-shadow font-sans text-sm antialiased">
<div class="flex items-center gap-6">
<div class="relative">
<span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 material-symbols-outlined text-[20px]" data-icon="search">search</span>
<input class="bg-surface-container-low border border-outline-variant rounded-lg pl-10 pr-4 py-2 text-on-surface focus:ring-2 focus:ring-primary focus:outline-none w-64" placeholder="Search resources..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<div class="flex items-center gap-2">
<button class="p-2 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="p-2 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="help">help</span>
</button>
<button class="p-2 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="mail">mail</span>
</button>
</div>
<div class="h-8 w-[1px] bg-slate-800 mx-2"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="font-bold text-on-surface leading-tight">{{ Auth::user()->name }}</p>
<p class="text-[11px] text-primary-fixed-dim uppercase tracking-wider">Lead Instructor</p>
</div>
<img alt="Instructor avatar" class="w-10 h-10 rounded-full border-2 border-primary-fixed-dim object-cover" data-alt="A professional portrait of a middle-aged male instructor with a confident smile, wearing a charcoal grey blazer. The background is a blurred high-end academic office with soft bokeh lighting. The overall color palette is dominated by deep navy and professional grey tones to match the dashboard's sophisticated aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_wncbssanXGL5-y2BIvE2BB17RNh6k0wLCe9-LzuzJaSYR_2wRGLLeOMEGD-KUpajCi16gVobYkFt1mzZntK11jZxaawEg2ZBtaeinoLJ7Yn6nP8LwHNDDchp6I2RlTWpmoYHbMy4MJ8xdpVclbSwPhVvSB61yiAoixdhxqQmA7PP5ulrSteeI323LJNp9pp11Ay_XCB_fwM1yW5JFkO6neTUCib1G6qu4M82vFxD3xtMoZwV8d2mk5Edlk3qDaF2023M5OP9puY"/>
</div>
</div>
</header>
<div class="p-gutter lg:p-lg xl:p-xl space-y-gutter">
<!-- Hero Grid: Studa Star Profile & KPIs -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Studa Star Profile Section -->
<div class="lg:col-span-4 bg-surface-container rounded-xl border border-outline-variant p-lg flex flex-col justify-between overflow-hidden relative group">
<div class="absolute top-0 right-0 p-4">
<div class="bg-tertiary-container/20 text-tertiary px-3 py-1 rounded-full flex items-center gap-1 border border-tertiary/30">
<span class="material-symbols-outlined text-[14px]" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="font-label-caps text-label-caps uppercase">Studa Star</span>
</div>
</div>
<div class="flex flex-col items-center text-center space-y-md">
<div class="relative">
<div class="w-24 h-24 rounded-full border-4 border-primary p-1">
<img alt="Instructor Profile" class="w-full h-full rounded-full object-cover" data-alt="A close-up headshot of a distinguished professor in a modern dark studio. Soft, focused lighting highlights his friendly expression and professional attire. The image is designed with a premium, academic feel, using dark blue and golden accent lighting to align with the Studa Star brand identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDYsOpI_6XCqip1f4u5R31pmlnXY8g44dRXDjaeXOo2L3DaRC2DP7c1PAOveld_Tbwh7cKsueyA8m9FcKTryAOAHxc03BxFW1AU1SPEZOe0ClNw64WEpHAQyyv5QjleT6vdw7TYgVl_YW4vP2Nl_O0hGu8gH276orBk7cEZJukS8EJBitIOa99SmKMYWbksCJD3rvEwb5f0LUnoT3qxjzfgi1FObVVx8TehGmvhejW3bkhQQ9r9hQJIQz9yvqYpfjQpubpW3CyT8PU"/>
</div>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface">{{ Auth::user()->name }}</h2>
<p class="text-primary font-medium">Senior Research Fellow &amp; Educator</p>
</div>
<p class="text-on-surface-variant font-body-sm text-body-sm max-w-xs">
                            Dedicated to bridging the gap between theoretical physics and interactive digital learning for over 15 years.
                        </p>
</div>
<div class="mt-xl flex flex-col gap-sm">
<button class="w-full py-3 bg-primary-container text-on-primary-container rounded-lg font-bold hover:brightness-110 transition-all flex items-center justify-center gap-2">
                            View Public Profile
                            <span class="material-symbols-outlined text-[18px]" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</div>
<!-- KPI Cards Bento Grid -->
<div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-gutter">
<!-- Student Engagement KPI -->
<div class="bg-surface-container rounded-xl border border-outline-variant p-lg flex flex-col justify-between h-[240px]">
<div class="flex justify-between items-start">
<div>
<p class="text-on-surface-variant font-label-caps text-label-caps uppercase tracking-widest">Student Engagement</p>
<h3 class="font-stat-value text-stat-value text-on-surface mt-1">94.2%</h3>
</div>
<div class="bg-secondary-container/20 text-secondary p-2 rounded-lg">
<span class="material-symbols-outlined" data-icon="trending_up">trending_up</span>
</div>
</div>
<!-- Sparkline Placeholder -->
<div class="flex-1 mt-4 flex items-end gap-1 overflow-hidden">
<div class="w-full h-24 bg-gradient-to-t from-primary/20 to-transparent rounded-t-lg relative">
<svg class="w-full h-full" preserveaspectratio="none" viewbox="0 0 400 100">
<path class="text-primary" d="M0,80 Q50,20 100,50 T200,30 T300,60 T400,10" fill="none" stroke="currentColor" stroke-width="3"></path>
</svg>
</div>
</div>
<p class="text-[12px] text-secondary mt-2 flex items-center gap-1 font-medium">
<span class="material-symbols-outlined text-[14px]" data-icon="arrow_upward">arrow_upward</span> +12% from last month
                        </p>
</div>
<!-- Module Completion Rate KPI -->
<div class="bg-surface-container rounded-xl border border-outline-variant p-lg flex items-center justify-between h-[240px]">
<div class="space-y-md">
<p class="text-on-surface-variant font-label-caps text-label-caps uppercase tracking-widest">Module Completion Rate</p>
<div>
<h3 class="font-stat-value text-stat-value text-on-surface">88%</h3>
<p class="text-on-surface-variant text-body-sm">4,281 students completed</p>
</div>
</div>
<div class="relative w-32 h-32">
<svg class="w-full h-full" viewbox="0 0 100 100">
<circle class="text-slate-800" cx="50" cy="50" fill="transparent" r="40" stroke="currentColor" stroke-width="10"></circle>
<circle class="text-secondary" cx="50" cy="50" fill="transparent" r="40" stroke="currentColor" stroke-dasharray="251.2" stroke-dashoffset="30.1" stroke-linecap="round" stroke-width="10"></circle>
</svg>
<div class="absolute inset-0 flex items-center justify-center">
<span class="material-symbols-outlined text-secondary" data-icon="task_alt">task_alt</span>
</div>
</div>
</div>
<!-- Verified Proctored Exam Pass Rate KPI -->
<div class="md:col-span-2 bg-surface-container rounded-xl border border-outline-variant p-lg h-[240px] flex flex-col">
<div class="flex justify-between items-start mb-4">
<div>
<p class="text-on-surface-variant font-label-caps text-label-caps uppercase tracking-widest">Verified Proctored Exam Pass Rate</p>
<h3 class="font-stat-value text-stat-value text-on-surface mt-1">76.4%</h3>
</div>
<div class="flex gap-2">
<div class="flex items-center gap-1 px-3 py-1 bg-surface-container-highest rounded-full border border-outline-variant">
<div class="w-2 h-2 rounded-full bg-primary"></div>
<span class="text-[11px] font-bold text-on-surface-variant">Pass</span>
</div>
<div class="flex items-center gap-1 px-3 py-1 bg-surface-container-highest rounded-full border border-outline-variant">
<div class="w-2 h-2 rounded-full bg-slate-700"></div>
<span class="text-[11px] font-bold text-on-surface-variant">Fail</span>
</div>
</div>
</div>
<div class="flex-1 flex items-end gap-gutter pt-2">
<div class="flex-1 flex flex-col gap-2 items-center">
<div class="w-full bg-primary/20 rounded-t-lg h-[60%] relative group">
<div class="absolute bottom-0 w-full bg-primary rounded-t-lg h-[80%] transition-all"></div>
</div>
<span class="text-[10px] text-on-surface-variant font-bold">Week 1</span>
</div>
<div class="flex-1 flex flex-col gap-2 items-center">
<div class="w-full bg-primary/20 rounded-t-lg h-[80%] relative group">
<div class="absolute bottom-0 w-full bg-primary rounded-t-lg h-[90%] transition-all"></div>
</div>
<span class="text-[10px] text-on-surface-variant font-bold">Week 2</span>
</div>
<div class="flex-1 flex flex-col gap-2 items-center">
<div class="w-full bg-primary/20 rounded-t-lg h-[70%] relative group">
<div class="absolute bottom-0 w-full bg-primary rounded-t-lg h-[75%] transition-all"></div>
</div>
<span class="text-[10px] text-on-surface-variant font-bold">Week 3</span>
</div>
<div class="flex-1 flex flex-col gap-2 items-center">
<div class="w-full bg-primary/20 rounded-t-lg h-[90%] relative group">
<div class="absolute bottom-0 w-full bg-primary rounded-t-lg h-[95%] transition-all"></div>
</div>
<span class="text-[10px] text-on-surface-variant font-bold">Week 4</span>
</div>
<div class="flex-1 flex flex-col gap-2 items-center">
<div class="w-full bg-primary/20 rounded-t-lg h-[50%] relative group">
<div class="absolute bottom-0 w-full bg-primary rounded-t-lg h-[65%] transition-all"></div>
</div>
<span class="text-[10px] text-on-surface-variant font-bold">Week 5</span>
</div>
</div>
</div>
</div>
</div>
<!-- Triad of Learning Section -->
<section class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
<div class="px-lg py-md border-b border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-md">
<h2 class="font-title-sm text-title-sm text-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-primary" data-icon="category">category</span>
                        Triad of Learning
                    </h2>
<div class="flex p-1 bg-surface-container-low rounded-lg border border-outline-variant">
<button class="px-4 py-2 bg-primary-container text-on-primary-container rounded-md font-bold text-sm">Video Lessons</button>
<button class="px-4 py-2 text-on-surface-variant hover:text-on-surface rounded-md font-medium text-sm transition-colors">Document Archives</button>
<button class="px-4 py-2 text-on-surface-variant hover:text-on-surface rounded-md font-medium text-sm transition-colors">Exercise Bank</button>
</div>
</div>
<div class="p-0">
<table class="w-full text-left">
<thead>
<tr class="bg-surface-container-low/50">
<th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant">Lesson Details</th>
<th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant">Status</th>
<th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant">Enrollment</th>
<th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Lesson 1: Live -->
<tr class="hover:bg-slate-800/30 transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-4">
<div class="w-12 h-12 bg-slate-800 rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant">
<img alt="Lesson Thumbnail" class="w-full h-full object-cover opacity-80" data-alt="A cinematic high-angle shot of a glowing laptop screen displaying complex physics formulas in a dark room. The lighting is deep navy with neon primary blue highlights, creating a tech-focused and academic mood that matches the Studa platform." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzxkwIAXeGIgff-YchUKwL6TOuz30JeP1F4zY5EKqz2xkpG-Az1JmC75hbLYC-7PPyOg3NJo4QtvDw1wwuQE13UT415j_wUDE_eHk3LFrEX-xZ0xr8BINuMiQC1WXJids50d9nNIQ8MlE8Df6I8AqjKQJ5a-OZtvm-rUfSO9tH7rWJZLY8nW6GXVnv4vI22b7Qk1EcFaGzjORITr_shpCaqokLUGigoT-x4Gl96jnWnBsKgotBREBhafvztXAjhC8W91vQzd3BrxA"/>
</div>
<div>
<p class="font-bold text-on-surface">Advanced Quantum Mechanics 101</p>
<p class="text-xs text-on-surface-variant">Modified 2 hours ago</p>
</div>
</div>
</td>
<td class="px-lg py-md">
<div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-secondary/10 text-secondary rounded-full border border-secondary/20">
<div class="w-1.5 h-1.5 rounded-full bg-secondary"></div>
<span class="text-[11px] font-bold uppercase tracking-wider">Live</span>
</div>
</td>
<td class="px-lg py-md">
<span class="text-sm font-medium text-on-surface">1,240 Students</span>
</td>
<td class="px-lg py-md text-right">
<button class="px-4 py-2 bg-surface-container-highest text-on-surface font-bold text-[12px] rounded-lg border border-outline-variant hover:bg-primary-container hover:text-on-primary-container transition-all">
                                        Create Quiz
                                    </button>
</td>
</tr>
<!-- Lesson 2: Draft -->
<tr class="hover:bg-slate-800/30 transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-4">
<div class="w-12 h-12 bg-slate-800 rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant">
<img alt="Lesson Thumbnail" class="w-full h-full object-cover opacity-80" data-alt="A breathtaking view of deep space with a digital grid overlaying a distant nebula. The image uses a rich palette of blues, violets, and subtle primary accents, symbolizing advanced scientific discovery and data-driven learning." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6fYpA9li-Su2edHZQVLY_Zyymoo3bR9zq63uO4I9cMmN0aL2PnXTZn6fSXsNasOuUA9UH8NZ2NfR5rQ4BjB97hhnhtOeNF1FdZJVRQN2AFVYjpM2kQ25CvlAJCbPSgimVnMGSAq-e2RZ2jDz0dymc1GcrzhQK0N2103F1dBLKNX-zjWNRNQjwtErBn7W7YuM75wnWOON3t4IDVPHQRxWEtRzj2udsmVsUwQ7apBmKFzJKCBACCVsJyVc2Evn6srcwyqqK5Zx9D5I"/>
</div>
<div>
<p class="font-bold text-on-surface">Statistical Thermodynamics Intro</p>
<p class="text-xs text-on-surface-variant">Created 3 days ago</p>
</div>
</div>
</td>
<td class="px-lg py-md">
<div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-outline-variant/30 text-on-surface-variant rounded-full border border-outline-variant/40">
<div class="w-1.5 h-1.5 rounded-full bg-outline-variant"></div>
<span class="text-[11px] font-bold uppercase tracking-wider">Draft</span>
</div>
</td>
<td class="px-lg py-md">
<span class="text-sm font-medium text-on-surface-variant">—</span>
</td>
<td class="px-lg py-md text-right">
<button class="px-4 py-2 bg-surface-container-highest text-on-surface font-bold text-[12px] rounded-lg border border-outline-variant hover:bg-primary-container hover:text-on-primary-container transition-all">
                                        Edit Content
                                    </button>
</td>
</tr>
<!-- Lesson 3: Pending Review -->
<tr class="hover:bg-slate-800/30 transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-4">
<div class="w-12 h-12 bg-slate-800 rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant">
<img alt="Lesson Thumbnail" class="w-full h-full object-cover opacity-80" data-alt="An abstract visualization of scientific data, with glowing molecules and connected nodes floating in a dark, clean laboratory environment. The lighting is soft and professional, with highlights of primary blue and white, conveying a sense of rigorous peer review and academic quality." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaOBKGhmdXsfLbeYTUzzonE53Lp1zPy69kP-_U1xmCj44grKNRFEYyJ_s--aKC1K5S7IgwSPRsZQ8sh9mIac5WmHhFyNmTFM6q3EljaZnNcPPFFEu-zbiNE1ArrGls09xZGOnu2WlO7AllMap9vW3F6TJCMqpxLbmReCzi2E87OzL38Yn-_ZZ9Nt9ofP4wiuq308Zw8vVAESYw17vkEk0mB8pzoV95ag4wkHOsJl7ef_zCGk2G_B01lyCOxGFCjqT7reZZts8s5D8"/>
</div>
<div>
<p class="font-bold text-on-surface">Nuclear Fusion: The Future of Energy</p>
<p class="text-xs text-on-surface-variant">Submitted yesterday</p>
</div>
</div>
</td>
<td class="px-lg py-md">
<div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-tertiary/10 text-tertiary rounded-full border border-tertiary/20">
<div class="w-1.5 h-1.5 rounded-full bg-tertiary"></div>
<span class="text-[11px] font-bold uppercase tracking-wider">Pending Review</span>
</div>
</td>
<td class="px-lg py-md">
<span class="text-sm font-medium text-on-surface">32 Early Access</span>
</td>
<td class="px-lg py-md text-right">
<button class="px-4 py-2 bg-surface-container-highest text-on-surface font-bold text-[12px] rounded-lg border border-outline-variant opacity-50 cursor-not-allowed">
                                        View Draft
                                    </button>
</td>
</tr>
</tbody>
</table>
</div>
<div class="px-lg py-4 border-t border-outline-variant bg-surface-container-low/50 flex justify-center">
<button class="text-primary font-bold text-sm hover:underline flex items-center gap-1">
                        View All Learning Assets
                        <span class="material-symbols-outlined text-[18px]" data-icon="keyboard_arrow_down">keyboard_arrow_down</span>
</button>
</div>
</section>
</div>
</main>
</body></html>