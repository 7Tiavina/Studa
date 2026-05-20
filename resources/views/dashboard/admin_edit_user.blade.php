<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
    <title>Modifier Utilisateur - Studa</title>
</head>
<body class="bg-slate-50 dark:bg-[#0c1322] text-slate-800 dark:text-[#dce2f7] font-['Inter'] antialiased transition-colors duration-200">

<div class="absolute top-4 right-4">
    <button id="theme-toggle" class="p-2.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none flex items-center justify-center shadow-sm">
        <span id="theme-toggle-icon" class="material-symbols-outlined">dark_mode</span>
    </button>
</div>

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white dark:bg-[#191f2f] rounded-xl border border-slate-200 dark:border-[#424754] p-8 shadow-xl transition-all duration-200">
        <h1 class="text-2xl font-bold mb-6 text-slate-900 dark:text-white">Modifier l'utilisateur</h1>
        
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-600 dark:text-slate-400">Nom</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-slate-50 border border-slate-300 dark:bg-[#0c1322] dark:border-[#424754] rounded-lg text-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-slate-600 dark:text-slate-400">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-slate-50 border border-slate-300 dark:bg-[#0c1322] dark:border-[#424754] rounded-lg text-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1 text-slate-600 dark:text-slate-400">Rôle</label>
                <select name="role" class="w-full bg-slate-50 border border-slate-300 dark:bg-[#0c1322] dark:border-[#424754] rounded-lg text-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition-colors">
                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Étudiant</option>
                    <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Professeur</option>
                </select>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition-colors active:scale-[0.98]">
                    Enregistrer
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-center text-slate-800 dark:text-white font-bold py-2.5 px-4 rounded-lg transition-colors active:scale-[0.98] flex items-center justify-center">
                    Annuler
                </a>
            </div>
        </form>
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
