<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{ asset('faviconStuda.png') }}" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        // Initialiser le thème le plus tôt possible pour éviter le flash blanc
        if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && !window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
    <title>En attente de validation - Studa</title>
</head>
<body class="bg-slate-50 dark:bg-[#0c1322] text-slate-800 dark:text-[#dce2f7] antialiased transition-colors duration-200">

<div class="absolute top-4 right-4">
    <button id="theme-toggle" class="p-2.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none flex items-center justify-center shadow-sm">
        <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
    </button>
</div>

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full text-center space-y-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-8 rounded-xl shadow-xl transition-all duration-200">
        <div class="text-6xl text-blue-500 mb-4 flex justify-center">
            <span class="material-symbols-outlined" style="font-size: 80px;">pending_actions</span>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Compte en attente</h1>
        <p class="text-slate-600 dark:text-slate-400">
            Votre compte a bien été créé, mais il doit être validé par un administrateur avant que vous ne puissiez accéder aux cours et ressources.
        </p>
        <p class="text-slate-500 text-sm">
            Vous recevrez un accès complet dès que l'administrateur aura vérifié votre profil.
        </p>
        <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold transition-all">
                    Retour à l'accueil / Déconnexion
                </button>
            </form>
        </div>
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
