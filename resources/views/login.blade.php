<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('faviconStuda.png') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class"
        }
    </script>
    <script>
        // Initialiser le thème le plus tôt possible pour éviter le flash blanc
        if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && !window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-[#0c1322] text-slate-800 dark:text-[#dce2f7] font-sans antialiased flex items-center justify-center min-h-screen transition-colors duration-200 p-4">

<div class="absolute top-4 right-4">
    <button id="theme-toggle" class="p-2.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none flex items-center justify-center shadow-sm">
        <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
    </button>
</div>

<div class="w-full max-w-md bg-white dark:bg-slate-900 p-8 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xl transition-all duration-200">
    <div class="flex justify-center mb-6">
        <a href="/">
            <img src="{{ asset('logoStuda.png') }}" alt="Studa" class="h-10 w-auto">
        </a>
    </div>
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 text-center">Connexion</h2>
    
    <form class="space-y-4" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label class="block text-sm mb-1 text-slate-600 dark:text-slate-400">Email</label>
            <input type="email" name="email" class="w-full bg-slate-50 border border-slate-300 dark:bg-slate-950 dark:border-slate-700 rounded-lg p-2.5 text-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors" placeholder="email@exemple.com" required>
        </div>
        <div>
            <label class="block text-sm mb-1 text-slate-600 dark:text-slate-400">Mot de passe</label>
            <input type="password" name="password" class="w-full bg-slate-50 border border-slate-300 dark:bg-slate-950 dark:border-slate-700 rounded-lg p-2.5 text-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors" required>
        </div>
        <div class="flex justify-between items-center text-sm">
            <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Mot de passe oublié ?</a>
        </div>
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-bold transition-all duration-150 active:scale-[0.98]">Se connecter</button>
    </form>

    <div class="mt-6 text-center text-sm text-slate-600 dark:text-slate-400">
        Pas encore de compte ? <a href="{{ route('register') }}" class="text-blue-600 dark:text-blue-400 hover:underline">S'inscrire</a>
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

