<!DOCTYPE html>

<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Studa | Live Courses Management</title>
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
                },
            },
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
<body class="font-body-base text-on-background selection:bg-primary/30">
<!-- SideNavBar -->
<aside class="flex flex-col h-screen fixed z-50 bg-slate-950 border-r border-slate-800 w-[260px] left-0 top-0">
<div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
<div class="px-6 mb-8">
<div class="flex items-center gap-3">
<div class="h-10 w-10 rounded-lg overflow-hidden bg-surface-container">
<img alt="Instructor profile picture" data-alt="A professional instructor profile portrait in a minimalist dark studio. The lighting is focused and warm, creating a high-contrast cinematic appearance against a deep slate background. The instructor wears a modern navy blazer, conveying academic authority and professional excellence within the Studa ecosystem's premium branding." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIt82J3fy2UmwcX1zUGwvpSMBQq2y3eCb2Zwzyiq3tZpNK7Vcdva6cTq0Q4-NN7k65A6Sqo5j7s8etzs29TUHah11DndAGNAQ8qM3YI0I9u893-_DhnGnfqF_oz9C4K76cFdNeNYZT9OAGiaPFVSgzO_xiduCbg3ysTIgMzjenUn2KI6k9zDG6TXX0hOWdhvQ63vVKPx51mn_jo-dtRZCSKpa30NNPO2WF36FuXXa4iyx2Z9lBqrindrC7690c_5iRa7b3TTPTu54"/>
</div>
<div>
<div class="font-stat-value text-body-sm text-on-surface">{{ Auth::user()->name }}</div>
<div class="font-body-sm text-xs text-slate-400">Academic Excellence</div>
</div>
</div>
</div>
<nav class="flex-1 space-y-1 px-4">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all font-sans text-[14px] font-medium" href="#">
<span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all font-sans text-[14px] font-medium" href="#">
<span class="material-symbols-outlined">menu_book</span>
                My Content
            </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all font-sans text-[14px] font-medium" href="#">
<span class="material-symbols-outlined">group</span>
                Students
            </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600/10 text-blue-500 border-r-2 border-blue-500 font-sans text-[14px] font-medium" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">video_call</span>
                Live Courses
            </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all font-sans text-[14px] font-medium" href="#">
<span class="material-symbols-outlined">insights</span>
                Analytics
            </a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:bg-slate-900 hover:text-slate-100 transition-all font-sans text-[14px] font-medium" href="#">
<span class="material-symbols-outlined">settings</span>
                Settings
            </a>
</nav>
<div class="p-6 border-t border-slate-800">
<button class="w-full bg-primary-container text-on-primary-container py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:opacity-90 transition-all scale-95 active:duration-75">
<span class="material-symbols-outlined">add</span>
                Create Quiz
            </button>
</div>
<div class="px-4 py-6 space-y-1 border-t border-slate-800">
<a class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-slate-100 font-sans text-[14px]" href="#">
<span class="material-symbols-outlined">contact_support</span>
                Help Center
            </a>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-red-400 font-sans text-[14px]">
        <span class="material-symbols-outlined">logout</span>
        Logout
    </button>
</form>
</div>
</aside>
<!-- TopNavBar -->
<header class="flex items-center justify-between px-6 h-16 w-[calc(100%-260px)] ml-[260px] bg-slate-900/80 backdrop-blur-md font-sans text-sm antialiased border-b border-slate-800 sticky top-0 z-40">
<div class="flex items-center flex-1 max-w-xl">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="w-full bg-slate-950/50 border border-slate-800 rounded-full py-2 pl-10 pr-4 text-on-surface focus:outline-none focus:border-blue-500 transition-all" placeholder="Search sessions, student logs..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 transition-colors rounded-full">
<span class="material-symbols-outlined" data-icon="mail">mail</span>
</button>
<button class="p-2 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 transition-colors rounded-full relative">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-slate-900"></span>
</button>
<button class="p-2 text-slate-400 hover:bg-slate-800/50 hover:text-slate-100 transition-colors rounded-full">
<span class="material-symbols-outlined" data-icon="help">help</span>
</button>
<div class="h-8 w-[1px] bg-slate-800 mx-2"></div>
<div class="flex items-center gap-2">
<img alt="Instructor avatar" class="h-8 w-8 rounded-full border border-slate-700" data-alt="Close-up of a smiling academic professional with professional attire. The shot is captured in high-definition with soft bokeh, highlighting deep navy and charcoal tones of the background. The aesthetic is clean, modern, and aligned with the corporate educator visual identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBojjVqGkpfz4a5REiiO7PcYsWqFjQDaZhzghxE6-4G2nmuzk514uyo0PROeoKw7EM7TZ-dRLa_6DEkbU7G5wTZ6_prrTsydjyCHw4Du2WI-FYq6rLUtzPFnbOx5vpj3IRradyqr5bw76gDd576Jz9h02yJ8sK7Jn35MfEwXTQ4a4Rz1LIRBf64aeCJz89wsv0zq4IDt5c79WCKWMNQgbMgs376EchGgh33UIzsJkbFzv0dKk_plSJZcY7esfER8SsqVXj2qerArNo"/>
</div>
</div>
</header>
<!-- Main Content -->
<main class="ml-[260px] p-gutter min-h-screen">
<!-- Hero Earnings Section -->
<div class="grid grid-cols-12 gap-gutter mb-xl">
<div class="col-span-12 lg:col-span-8 p-lg bg-surface-container rounded-xl border border-outline-variant relative overflow-hidden">
<!-- Background decoration -->
<div class="absolute -right-20 -top-20 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
<div class="relative z-10">
<p class="font-label-caps text-label-caps text-primary-fixed-dim uppercase tracking-widest mb-2">Portfolio Overview</p>
<h1 class="font-display-lg text-display-lg mb-8">Live Courses Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div>
<span class="font-body-sm text-on-surface-variant flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-[18px]">account_balance_wallet</span>
                                Lifetime Earnings
                            </span>
<div class="font-stat-value text-display-lg text-primary">2,500,000 MGA</div>
<div class="flex items-center gap-2 mt-2">
<span class="bg-secondary-container/20 text-secondary-fixed-dim text-xs font-bold px-2 py-0.5 rounded-full">+12.5%</span>
<span class="text-xs text-slate-500">since last month</span>
</div>
</div>
<div class="flex flex-col justify-end">
<div class="flex items-center gap-4 mb-4">
<div class="flex -space-x-3">
<img alt="Student" class="h-8 w-8 rounded-full border-2 border-slate-900" data-alt="Close-up portrait of a student, smiling, high-key lighting, bright studio background. The style is modern corporate photography with blue and slate tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgey_1Cy2YVlI12SmdFG9S-On6nvtxi2mWiDXyhdB9MdNXQun9NKQA3MMadu6iWBZ9pMUiAjptj_z_AzLm7ZXDVbXm-eI-HTZra_KkJOuOuvB3xSu1nwDiP0YMKs3eSO5mvWkqVE6UtfGyUMCaPUDLd0XXUSodGBaNN_Zdos2W1iuQ8FEpUNaFZQU7k20qNx_k-EmZQvz9RArC453aICwRR-_Jjyy7Jh5SNcetMfNcKWOCsgbVzvgZqEtK9W7GflUEV2CiZzCTj58"/>
<img alt="Student" class="h-8 w-8 rounded-full border-2 border-slate-900" data-alt="Portrait of a female student in a library setting with soft focus books in background. The color palette emphasizes soft navy and teal accents consistent with Studa branding." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_UszVdxuLc_3qr3i5iLZhu5l3cXJk0yl6iUZHteyPf2bU8mQuB2OAopJUORc-p9-XjLlON-ckHAatxAUIIcFZ_VlgTwmvlFEjQsujDLQsESVG9FWmGiJd7Oe6VsOohVzjevhAGVFPLRoSzKe6kl69ylTfTnVRERlHS-Pffp39e6phUJRGmMfi1xvmzo2_yYs253iUwcZpDgFrzXdqqvvPCAxUZiGoR8ooy1DxvdSeFDo8B9mgvj3tbHSIQ3fmfD-DicaHJMIWwCo"/>
<img alt="Student" class="h-8 w-8 rounded-full border-2 border-slate-900" data-alt="Young male student in casual modern academic clothing. Sharp focus, professional lighting, consistent with Studa's educator portal visual language." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9KB0y7m-DLmKnIKrI9DhyY7wVSi2RL5iCJ64StAXAQftssAGGdSuZyuDuGGHejaZO889DmW365hA49jzF__z4eSYu72XCaUOuTUxZZBolswjL-TRv8V9Srl2AFY86OdlbZMxqFcQxh_pcxvKRuV2wISItNRHd1ukc6OFVFja6s4I6b1otHthkkCBpmE9WL_hHZpr7Kidi5yJdEyfm7_wb1-3igo6zFObb5WLKoK-6xK4QwC_5iaPJIwWSPpPg36PaD3uUtqDNexc"/>
<div class="h-8 w-8 rounded-full border-2 border-slate-900 bg-slate-800 flex items-center justify-center text-[10px] font-bold">+120</div>
</div>
<span class="text-body-sm text-slate-400">Active students this week</span>
</div>
<div class="h-2 w-full bg-slate-800 rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-blue-600 to-primary-container w-4/5"></div>
</div>
</div>
</div>
</div>
</div>
<!-- Quick Actions / Payment Methods -->
<div class="col-span-12 lg:col-span-4 p-lg bg-surface-container rounded-xl border border-outline-variant flex flex-col justify-between">
<div>
<h3 class="font-title-sm text-title-sm mb-4">Connected Payouts</h3>
<div class="space-y-4">
<div class="flex items-center justify-between p-3 bg-slate-900 rounded-lg border border-slate-800">
<div class="flex items-center gap-3">
<div class="w-10 h-10 bg-[#FFD700] rounded-lg flex items-center justify-center font-black text-black text-xs">MVola</div>
<div>
<p class="font-bold text-sm">Telma MVola</p>
<p class="text-xs text-slate-500">**** 8291</p>
</div>
</div>
<span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
<div class="flex items-center justify-between p-3 bg-slate-900 rounded-lg border border-slate-800">
<div class="flex items-center gap-3">
<div class="w-10 h-10 bg-[#FF6600] rounded-lg flex items-center justify-center font-black text-white text-xs">Orange</div>
<div>
<p class="font-bold text-sm">Orange Money</p>
<p class="text-xs text-slate-500">Not connected</p>
</div>
</div>
<button class="text-xs font-bold text-primary underline">Connect</button>
</div>
</div>
</div>
<button class="mt-6 w-full flex items-center justify-center gap-2 py-3 border border-primary text-primary rounded-xl font-bold hover:bg-primary/10 transition-colors">
<span class="material-symbols-outlined">payments</span>
                    Request Payout
                </button>
</div>
</div>
<!-- Premium Live Course Earnings Table -->
<div class="mb-xl">
<div class="flex items-center justify-between mb-6">
<h2 class="font-headline-md text-headline-md">Premium Live Course Earnings</h2>
<div class="flex gap-2">
<button class="px-4 py-2 bg-slate-900 border border-slate-800 rounded-lg text-sm flex items-center gap-2 hover:bg-slate-800">
<span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filter
                    </button>
<button class="px-4 py-2 bg-slate-900 border border-slate-800 rounded-lg text-sm flex items-center gap-2 hover:bg-slate-800">
<span class="material-symbols-outlined text-[18px]">download</span>
                        Export
                    </button>
</div>
</div>
<div class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-900/50 border-b border-slate-800">
<th class="px-6 py-4 font-label-caps text-label-caps text-slate-400 uppercase tracking-wider">Course Title</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-slate-400 uppercase tracking-wider text-center">Date</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-slate-400 uppercase tracking-wider text-center">Student Count</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-slate-400 uppercase tracking-wider text-right">Total Revenue</th>
<th class="px-6 py-4 font-label-caps text-label-caps text-slate-400 uppercase tracking-wider text-right">My Share (50%)</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-800">
<tr class="hover:bg-slate-800/20 transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="h-10 w-10 bg-blue-600/20 rounded flex items-center justify-center text-blue-500">
<span class="material-symbols-outlined">architecture</span>
</div>
<span class="font-bold">Advanced UI/UX Systems</span>
</div>
</td>
<td class="px-6 py-4 text-center text-slate-400 font-body-sm">Oct 12, 2023</td>
<td class="px-6 py-4 text-center">
<span class="bg-slate-900 px-3 py-1 rounded-full text-sm">48</span>
</td>
<td class="px-6 py-4 text-right font-body-base">480,000 MGA</td>
<td class="px-6 py-4 text-right text-secondary font-bold">240,000 MGA</td>
</tr>
<tr class="hover:bg-slate-800/20 transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="h-10 w-10 bg-purple-600/20 rounded flex items-center justify-center text-purple-500">
<span class="material-symbols-outlined">code</span>
</div>
<span class="font-bold">Mastering React 18</span>
</div>
</td>
<td class="px-6 py-4 text-center text-slate-400 font-body-sm">Oct 10, 2023</td>
<td class="px-6 py-4 text-center">
<span class="bg-slate-900 px-3 py-1 rounded-full text-sm">32</span>
</td>
<td class="px-6 py-4 text-right font-body-base">640,000 MGA</td>
<td class="px-6 py-4 text-right text-secondary font-bold">320,000 MGA</td>
</tr>
<tr class="hover:bg-slate-800/20 transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="h-10 w-10 bg-emerald-600/20 rounded flex items-center justify-center text-emerald-500">
<span class="material-symbols-outlined">data_object</span>
</div>
<span class="font-bold">Database Architecture</span>
</div>
</td>
<td class="px-6 py-4 text-center text-slate-400 font-body-sm">Oct 05, 2023</td>
<td class="px-6 py-4 text-center">
<span class="bg-slate-900 px-3 py-1 rounded-full text-sm">112</span>
</td>
<td class="px-6 py-4 text-right font-body-base">1,120,000 MGA</td>
<td class="px-6 py-4 text-right text-secondary font-bold">560,000 MGA</td>
</tr>
</tbody>
</table>
<div class="p-4 bg-slate-900/30 flex justify-center">
<button class="text-sm text-primary font-bold hover:underline">View All Earnings History</button>
</div>
</div>
</div>
<!-- Session Management Bento Grid -->
<div class="grid grid-cols-12 gap-gutter">
<div class="col-span-12 lg:col-span-4 p-lg bg-surface-container rounded-xl border border-outline-variant">
<h3 class="font-title-sm text-title-sm mb-6 flex items-center justify-between">
                    Upcoming Sessions
                    <span class="bg-primary-container text-on-primary-container px-2 py-1 rounded text-xs">3 Scheduled</span>
</h3>
<div class="space-y-4">
<div class="p-4 bg-slate-900 rounded-lg border-l-4 border-primary">
<div class="flex justify-between items-start mb-2">
<span class="font-bold text-sm">Design Workshop</span>
<span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded text-slate-400">TODAY</span>
</div>
<div class="flex items-center gap-2 text-xs text-slate-400 mb-4">
<span class="material-symbols-outlined text-[14px]">schedule</span>
                            14:00 - 15:30 (EAT)
                        </div>
<button class="w-full py-2 bg-primary-container text-on-primary-container text-xs font-bold rounded-lg hover:opacity-90">Start Session</button>
</div>
<div class="p-4 bg-slate-900 rounded-lg border-l-4 border-slate-700">
<div class="flex justify-between items-start mb-2">
<span class="font-bold text-sm">QA Session #4</span>
<span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded text-slate-400">TOMORROW</span>
</div>
<div class="flex items-center gap-2 text-xs text-slate-400">
<span class="material-symbols-outlined text-[14px]">schedule</span>
                            09:00 - 10:00 (EAT)
                        </div>
</div>
</div>
<button class="w-full mt-6 flex items-center justify-center gap-2 py-2 text-sm text-primary-fixed-dim border border-dashed border-slate-700 rounded-lg hover:border-primary transition-all">
<span class="material-symbols-outlined text-[20px]">calendar_add_on</span>
                    Schedule New Live
                </button>
</div>
<div class="col-span-12 lg:col-span-8 p-lg bg-surface-container rounded-xl border border-outline-variant overflow-hidden relative">
<h3 class="font-title-sm text-title-sm mb-6">Engagement Analytics</h3>
<div class="h-64 w-full flex items-end gap-2 mb-4">
<!-- Faux Bar Chart -->
<div class="flex-1 bg-slate-800 rounded-t-sm group relative" style="height: 40%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Mon: 1.2k</div>
</div>
<div class="flex-1 bg-slate-800 rounded-t-sm group relative" style="height: 65%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Tue: 2.1k</div>
</div>
<div class="flex-1 bg-primary rounded-t-sm group relative" style="height: 85%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Wed: 3.4k</div>
</div>
<div class="flex-1 bg-slate-800 rounded-t-sm group relative" style="height: 45%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Thu: 1.5k</div>
</div>
<div class="flex-1 bg-slate-800 rounded-t-sm group relative" style="height: 75%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Fri: 2.8k</div>
</div>
<div class="flex-1 bg-secondary rounded-t-sm group relative" style="height: 95%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Sat: 4.2k</div>
</div>
<div class="flex-1 bg-slate-800 rounded-t-sm group relative" style="height: 60%">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-900 text-[10px] p-1 rounded hidden group-hover:block whitespace-nowrap">Sun: 2.0k</div>
</div>
</div>
<div class="grid grid-cols-3 gap-4 border-t border-slate-800 pt-6">
<div class="text-center">
<p class="text-xs text-slate-500 mb-1">Peak Concurrent</p>
<p class="font-bold text-lg">248</p>
</div>
<div class="text-center">
<p class="text-xs text-slate-500 mb-1">Avg. Watch Time</p>
<p class="font-bold text-lg">42m</p>
</div>
<div class="text-center">
<p class="text-xs text-slate-500 mb-1">Poll Participation</p>
<p class="font-bold text-lg text-secondary">88%</p>
</div>
</div>
</div>
</div>
<!-- Footer Spacer -->
<div class="h-xl"></div>
</main>
</body></html>