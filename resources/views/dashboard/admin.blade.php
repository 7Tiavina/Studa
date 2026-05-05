<!DOCTYPE html>

<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #0f172a;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-base antialiased">
<!-- SideNavBar (Authority: JSON) -->
<aside class="flex flex-col h-screen fixed z-50 bg-slate-950 font-sans text-[14px] font-medium fixed left-0 top-0 h-full w-[260px] border-r border-slate-800">
<div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
<div class="flex-1 px-4 space-y-2">
<div class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200 cursor-pointer">
<span class="material-symbols-outlined">dashboard</span>
<span>Dashboard</span>
</div>
<div class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200 cursor-pointer">
<span class="material-symbols-outlined">menu_book</span>
<span>My Content</span>
</div>
<div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600/10 text-blue-500 border-r-2 border-blue-500 transition-all ease-in-out duration-200 cursor-pointer">
<span class="material-symbols-outlined">group</span>
<span>Students</span>
</div>
<div class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200 cursor-pointer">
<span class="material-symbols-outlined">video_call</span>
<span>Live Courses</span>
</div>
<div class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200 cursor-pointer">
<span class="material-symbols-outlined">insights</span>
<span>Analytics</span>
</div>
<div class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all ease-in-out duration-200 cursor-pointer">
<span class="material-symbols-outlined">settings</span>
<span>Settings</span>
</div>
</div>
<div class="p-6 border-t border-slate-800 space-y-4">
<button class="w-full py-3 px-4 bg-primary-container text-on-primary-container rounded-lg font-bold hover:opacity-90 transition-opacity">
                Create Quiz
            </button>
<div class="space-y-1">
<div class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-slate-100 cursor-pointer text-sm">
<span class="material-symbols-outlined">contact_support</span>
<span>Help Center</span>
</div>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-error hover:text-red-400 cursor-pointer text-sm">
        <span class="material-symbols-outlined">logout</span>
        <span>Logout</span>
    </button>
</form>
</div>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-[260px] min-h-screen flex flex-col">
<!-- TopNavBar (Authority: JSON) -->
<header class="flex items-center justify-between px-6 h-16 w-full sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
<div class="flex items-center flex-1 max-w-xl">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
<input class="w-full bg-slate-800/50 border border-slate-700 rounded-full py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500/50 transition-colors" placeholder="Search enrolled students..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4 text-slate-400">
<span class="material-symbols-outlined cursor-pointer hover:text-blue-400 transition-colors">notifications</span>
<span class="material-symbols-outlined cursor-pointer hover:text-blue-400 transition-colors">help</span>
<span class="material-symbols-outlined cursor-pointer hover:text-blue-400 transition-colors">mail</span>
</div>
<div class="flex items-center gap-3 pl-4 border-l border-slate-800">
<div class="text-right">
<p class="font-bold text-sm text-slate-100">{{ Auth::user()->name }}</p>
<p class="text-xs text-slate-500 uppercase">{{ ucfirst(Auth::user()->role) }}</p>
</div>
<img alt="Instructor avatar" class="w-10 h-10 rounded-full border border-slate-700" data-alt="A professional studio portrait of a middle-aged male academic with a confident smile, wearing a dark navy blazer and a crisp white shirt. The background is a soft, out-of-focus library setting, conveying expertise and authority. The lighting is sophisticated, with gentle rim lighting that highlights a modern, dark-themed professional aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsJWUl-DlicWbfz-tGDWy_otwp_9fUDUCUIKDrK5lGljM-XkmdWmTGlAxG7IzyCS6VUZa-lFNBazXNegrG9UX_0GD1TSYYPmX3VHMCJ5BMz1Xs11dfLlp3css_rKAyJv9Lj66tGuqCA48WIw1Tp3QFk20Ti3cSjesvbIDqFvAnoZc92-JEhoT8XZ6Sm6OJyuPr7md2mIRHAR4ZRvSOMxCkjlqes7iEip9JUNPSZXtozrs4pBdvPmLVDGGNpND-2IDSrrlPe39aO6E"/>
</div>
</div>
</header>
<!-- Dashboard Canvas -->
<div class="p-8 max-w-[1600px] mx-auto w-full">
<!-- Page Header -->
<div class="mb-10 flex justify-between items-end">
<div>
<h1 class="font-display-lg text-display-lg text-on-background mb-2">Student Management</h1>
<p class="text-on-surface-variant max-w-2xl">Monitor academic performance, engagement levels, and facilitate direct communication with your active student body.</p>
</div>
<div class="flex gap-3">
<button class="px-5 py-2.5 rounded-lg border border-slate-700 bg-slate-800/30 text-on-background font-semibold hover:bg-slate-800 transition-colors flex items-center gap-2">
<span class="material-symbols-outlined text-lg">filter_list</span>
                        Filter
                    </button>
<button class="px-5 py-2.5 rounded-lg bg-primary text-on-primary font-bold hover:opacity-90 transition-opacity flex items-center gap-2">
<span class="material-symbols-outlined text-lg">file_download</span>
                        Export List
                    </button>
</div>
</div>
<div class="grid grid-cols-12 gap-gutter">
<!-- Student Directory Table Card (7 Columns) -->
<div class="col-span-12 lg:col-span-7 bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
<div class="px-lg py-md border-b border-outline-variant flex justify-between items-center bg-surface-container-high/50">
<h2 class="font-title-sm text-title-sm text-on-background">Enrolled Students</h2>
<div class="flex items-center gap-2 text-xs text-secondary bg-secondary-container/10 px-3 py-1 rounded-full">
<span class="w-2 h-2 rounded-full bg-secondary"></span>
                            428 Active Now
                        </div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead class="bg-surface-container-low text-label-caps font-label-caps text-outline uppercase">
<tr>
<th class="px-lg py-4">Student</th>
<th class="px-lg py-4">Progress</th>
<th class="px-lg py-4">Last Activity</th>
<th class="px-lg py-4 text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<!-- Student Row 1 -->
<tr class="hover:bg-slate-800/40 transition-colors group">
<td class="px-lg py-4">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full" data-alt="A close-up portrait of a young woman student with long brown hair, smiling warmly in a bright, modern office space. Her professional yet approachable look is captured in high-resolution with natural lighting. The color palette is vibrant and professional, emphasizing a sense of academic focus and friendliness in a high-end educational interface." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1IecFJM-6JT0vr5ffQ1UGa9c-L3bZyuQwCCb6UmTEo0TpPxub2PJFkD22mQmLSvVqBLP7KtZ9vBVoK7-dWsu_gvXwGJLnXZKteGNbU77FnxniFIRJHyfGmTqLV1gsJKLJaPV6TeSGRhFADzK2jpSywtFXXtUpeLylKxLaPDk38co0wHp65mbLbTuH2P72oEPviSkdvsTsHv1BRWKrQ572hHGxU4QlIdRhSqznh8p38mFLfSm_suSrJK4KOY1N1s-uX9h-eFThI7E"/>
<div>
<p class="font-semibold text-on-background">Elena Rodriguez</p>
<p class="text-xs text-outline">Applied Physics II</p>
</div>
</div>
</td>
<td class="px-lg py-4">
<div class="w-32">
<div class="flex justify-between items-center mb-1.5">
<span class="text-xs font-bold text-primary">88%</span>
</div>
<div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
<div class="h-full bg-primary rounded-full" style="width: 88%"></div>
</div>
</div>
</td>
<td class="px-lg py-4">
<p class="text-body-sm text-on-surface-variant">2 hours ago</p>
</td>
<td class="px-lg py-4 text-right">
<button class="p-2 rounded-full hover:bg-blue-500/10 text-primary transition-colors">
<span class="material-symbols-outlined text-xl">chat_bubble</span>
</button>
</td>
</tr>
<!-- Student Row 2 -->
<tr class="hover:bg-slate-800/40 transition-colors group">
<td class="px-lg py-4">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full" data-alt="A crisp, high-contrast portrait of a young male university student with short dark hair and a neat beard, looking focused. The background is a minimal, deep-toned academic environment with soft blue accents. The lighting is precise, highlighting a professional and ambitious demeanor suitable for a premium educational dashboard application." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyxqKQ9wHRngooFjEScEmHnZXDpCSWibC2xYCwFt9bTqFEWSh4Q9jdxa9MQPjNFT_jEYmdQ4M33gnKQgmmfoyrfpy0LdvTl1t1WQ6ccTNtXKbEThULVIeUABLAabhxSevkOYjHRCKksVFXAAGOK_vQsUJhr687MBtcMYUCNiaFlyXqaWuUdm8lkknI7oT81S2Ll30W5a2jTb6EkOhQU28fqsmhfYXCK5sDtjPe2FCFIl7bieNJXwnaTCEjrTfZznGqLusmXuahRA0"/>
<div>
<p class="font-semibold text-on-background">Marcus Chen</p>
<p class="text-xs text-outline">Data Visualization</p>
</div>
</div>
</td>
<td class="px-lg py-4">
<div class="w-32">
<div class="flex justify-between items-center mb-1.5">
<span class="text-xs font-bold text-tertiary">42%</span>
</div>
<div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
<div class="h-full bg-tertiary rounded-full" style="width: 42%"></div>
</div>
</div>
</td>
<td class="px-lg py-4">
<p class="text-body-sm text-on-surface-variant">Today, 10:15 AM</p>
</td>
<td class="px-lg py-4 text-right">
<button class="p-2 rounded-full hover:bg-blue-500/10 text-primary transition-colors">
<span class="material-symbols-outlined text-xl">chat_bubble</span>
</button>
</td>
</tr>
<!-- Student Row 3 -->
<tr class="hover:bg-slate-800/40 transition-colors group bg-slate-800/20">
<td class="px-lg py-4">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full" data-alt="A portrait of a female post-graduate student with glasses, looking directly into the camera with an expression of intellectual curiosity. The lighting is cinematic with deep shadows and soft highlights, matching a dark-mode UI. The setting is a modern workspace, reinforcing themes of academic excellence and precision in a high-end software interface." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDK2lwvT_5vvaEEwANLA1KCOmWnGpvbClNz8JAo4TGI1Kgz1VFZYXR00qbsWIm8v-9rfjs8nqxiDh-GpHaFuK8BhFGCS5EukkQYt-h0A_kOhtP6PM4Mi2x-mR6LDut_Iqlud8e5qkKnbDcC0oWBULPmlIDzQ28IdH5t7fKwJj1tfjBdqmdA7-K_7I50KsFErM4yCAP1HutgGY8fUGEGtHoxAy4kz0VQ4Lwi_8qQh-xbamhcxR37Zf2xtESZ4zhQaN75NCg6r5uKQUM"/>
<div>
<p class="font-semibold text-on-background">Sarah Jenkins</p>
<p class="text-xs text-outline">Neuroscience 101</p>
</div>
</div>
</td>
<td class="px-lg py-4">
<div class="w-32">
<div class="flex justify-between items-center mb-1.5">
<span class="text-xs font-bold text-secondary">95%</span>
</div>
<div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
<div class="h-full bg-secondary rounded-full" style="width: 95%"></div>
</div>
</div>
</td>
<td class="px-lg py-4">
<p class="text-body-sm text-on-surface-variant">Active Now</p>
</td>
<td class="px-lg py-4 text-right">
<button class="p-2 rounded-full hover:bg-blue-500/10 text-primary transition-colors">
<span class="material-symbols-outlined text-xl">chat_bubble</span>
</button>
</td>
</tr>
<!-- Student Row 4 -->
<tr class="hover:bg-slate-800/40 transition-colors group">
<td class="px-lg py-4">
<div class="flex items-center gap-3">
<img class="w-10 h-10 rounded-full" data-alt="A profile photograph of a young man with a friendly expression, set against a dark architectural background that complements a sleek digital dashboard. The lighting is focused and warm, creating a high-quality professional look. The visual style is modern corporate, emphasizing clean lines and sophisticated color grading for a premium student portal." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIUoGP-xaRn5ADZCtPkB2LWzKcPfpyhiUDWRCsCqOK6OHR1jMSpkP4apWOOWVidw1p39_j-flkV9q1MKv8o71shy2E9WaM6BiqupnNfLmyARvoOXTCWxkKhfLqELuD0H3OHTKg1BYG90bivQvVw2zaV3cRwvXHRbGocrgd742efA5r8efRSQ_k8h6_BilYDBQIRO4_sr9pgNC02DW1mkbZ4F5rMOtc94qy27OKddklkC8mjgMyWmFn9M70--ALRW8YUE9uwpVLlcA"/>
<div>
<p class="font-semibold text-on-background">David Okoro</p>
<p class="text-xs text-outline">Machine Learning</p>
</div>
</div>
</td>
<td class="px-lg py-4">
<div class="w-32">
<div class="flex justify-between items-center mb-1.5">
<span class="text-xs font-bold text-primary">12%</span>
</div>
<div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
<div class="h-full bg-primary rounded-full" style="width: 12%"></div>
</div>
</div>
</td>
<td class="px-lg py-4">
<p class="text-body-sm text-on-surface-variant">3 days ago</p>
</td>
<td class="px-lg py-4 text-right">
<button class="p-2 rounded-full hover:bg-blue-500/10 text-primary transition-colors">
<span class="material-symbols-outlined text-xl">chat_bubble</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
<div class="p-md bg-surface-container-low flex justify-center border-t border-outline-variant">
<button class="text-sm font-semibold text-primary hover:underline">View All 1,240 Students</button>
</div>
</div>
<!-- Performance Metrics (5 Columns) -->
<div class="col-span-12 lg:col-span-5 space-y-gutter">
<!-- Individual Detail Performance -->
<div class="bg-surface-container rounded-xl border border-outline-variant p-lg relative overflow-hidden">
<div class="absolute top-0 right-0 p-4">
<div class="bg-tertiary-container/20 text-tertiary px-3 py-1 rounded-lg flex items-center gap-1.5 border border-tertiary/30">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">stars</span>
<span class="text-xs font-bold uppercase tracking-wider">Top Tier</span>
</div>
</div>
<div class="flex flex-col items-center mb-8">
<div class="relative mb-4">
<img class="w-24 h-24 rounded-full border-4 border-slate-800 ring-2 ring-secondary" data-alt="Detailed close-up of a student portrait in a round frame. The student has a focused, intelligent expression. The lighting is sophisticated and directional, creating a premium depth-of-field effect. The background is a rich dark-blue textured wall, fitting perfectly into a high-end academic mission control interface." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjRFjHXXYHe1MPlVtqv26E1vw34Eg9OBlsuZFSzqWHcZH-h93PNOLzkkxdjQFKVwrCIoGSQurCvrL0zvRyMHw3P-9a9mkUrpO1sqj-6rCoHzkfhbw1zQYF8OsRPEwU3cNYMetqCRRQORCWHpuTPgaF5hu4QnZoCradjwxDP12-C5xPIX3smTimsUyw1xr5kAcfNRJHvztwB9wZ0ITjGzRpsJay89ZFgvC7fY_WFL7JkYh3b--kaM_CvSUJsFOKQUOh4ly1d--9ztQ"/>
<div class="absolute bottom-1 right-1 w-5 h-5 bg-secondary rounded-full border-4 border-slate-900"></div>
</div>
<h3 class="font-headline-md text-headline-md text-on-background">Sarah Jenkins</h3>
<p class="text-primary font-medium">Class Valedictorian Candidate</p>
</div>
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="bg-slate-800/40 p-4 rounded-xl border border-slate-700/50">
<p class="text-label-caps text-outline mb-1 uppercase">Avg. Grade</p>
<p class="font-stat-value text-stat-value text-secondary">98.4%</p>
</div>
<div class="bg-slate-800/40 p-4 rounded-xl border border-slate-700/50">
<p class="text-label-caps text-outline mb-1 uppercase">Assignments</p>
<p class="font-stat-value text-stat-value text-on-background">24/24</p>
</div>
</div>
<div class="space-y-6">
<div>
<div class="flex justify-between text-sm mb-2">
<span class="text-on-surface-variant font-medium">Course Engagement</span>
<span class="text-on-background font-bold">Excellent</span>
</div>
<div class="h-3 w-full bg-slate-800 rounded-full p-0.5">
<div class="h-full bg-gradient-to-r from-blue-600 to-primary rounded-full shadow-[0_0_10px_rgba(173,198,255,0.3)]" style="width: 92%"></div>
</div>
</div>
<div class="flex items-center justify-between p-4 bg-primary-container/10 border border-primary/20 rounded-xl">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-2xl">workspace_premium</span>
<div>
<p class="text-sm font-bold text-on-background">Achievement Unlocked</p>
<p class="text-xs text-outline">Consistent 100% Quiz Score</p>
</div>
</div>
<span class="material-symbols-outlined text-outline text-lg">chevron_right</span>
</div>
</div>
<button class="w-full mt-8 py-3 rounded-xl bg-slate-800 text-on-background font-bold border border-slate-700 hover:bg-slate-700 transition-colors">
                            View Full Academic Transcript
                        </button>
</div>
<!-- Rapid Analytics Card -->
<div class="bg-surface-container-high rounded-xl border border-outline-variant p-lg">
<div class="flex items-center justify-between mb-6">
<h4 class="font-title-sm text-title-sm text-on-background">Weekly Activity</h4>
<span class="text-xs text-outline">Last 7 Days</span>
</div>
<div class="flex items-end justify-between h-24 gap-2 mb-4">
<div class="flex-1 bg-slate-700/30 rounded-t-sm h-[40%] hover:bg-primary/40 transition-all"></div>
<div class="flex-1 bg-slate-700/30 rounded-t-sm h-[65%] hover:bg-primary/40 transition-all"></div>
<div class="flex-1 bg-slate-700/30 rounded-t-sm h-[85%] hover:bg-primary/40 transition-all"></div>
<div class="flex-1 bg-slate-700/30 rounded-t-sm h-[55%] hover:bg-primary/40 transition-all"></div>
<div class="flex-1 bg-primary rounded-t-sm h-[100%]"></div>
<div class="flex-1 bg-slate-700/30 rounded-t-sm h-[70%] hover:bg-primary/40 transition-all"></div>
<div class="flex-1 bg-slate-700/30 rounded-t-sm h-[45%] hover:bg-primary/40 transition-all"></div>
</div>
<div class="flex justify-between text-[10px] text-outline font-bold uppercase tracking-widest px-1">
<span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span class="text-primary">Fri</span><span>Sat</span><span>Sun</span>
</div>
</div>
</div>
</div>
<!-- Bottom Messaging Quick Access (Bento Style) -->
<div class="mt-gutter grid grid-cols-1 md:grid-cols-3 gap-gutter">
<div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex items-center gap-6 hover:border-primary/50 transition-colors cursor-pointer group">
<div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">mark_email_unread</span>
</div>
<div>
<p class="font-bold text-on-background">Pending Requests</p>
<p class="text-sm text-outline">12 students seeking review</p>
</div>
</div>
<div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex items-center gap-6 hover:border-secondary/50 transition-colors cursor-pointer group">
<div class="w-14 h-14 rounded-full bg-secondary/10 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">assignment_turned_in</span>
</div>
<div>
<p class="font-bold text-on-background">Grades Pending</p>
<p class="text-sm text-outline">8 assignments to verify</p>
</div>
</div>
<div class="bg-surface-container rounded-xl border border-outline-variant p-6 flex items-center gap-6 hover:border-tertiary/50 transition-colors cursor-pointer group">
<div class="w-14 h-14 rounded-full bg-tertiary/10 flex items-center justify-center text-tertiary group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl">forum</span>
</div>
<div>
<p class="font-bold text-on-background">Direct Message</p>
<p class="text-sm text-outline">Broadcast to all students</p>
</div>
</div>
</div>
</div>
</main>
<!-- Floating Action Button (As per Contextual Rule) -->
<button class="fixed bottom-8 right-8 w-14 h-14 rounded-full bg-primary-container text-on-primary-container shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-40">
<span class="material-symbols-outlined text-2xl">person_add</span>
</button>
</body></html>