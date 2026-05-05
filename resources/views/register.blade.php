<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <style>
        body { background-color: #0c1322; color: #dce2f7; font-family: sans-serif; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

<div class="w-full max-w-md bg-slate-900 p-8 rounded-xl border border-slate-800">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Inscription</h2>
    
    <form class="space-y-4" action="/register" method="POST">
        <div>
            <label class="block text-sm mb-1">Nom</label>
            <input type="text" name="name" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white">
        </div>
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white">
        </div>
        <div>
            <label class="block text-sm mb-1">Mot de passe</label>
            <input type="password" name="password" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white">
        </div>
        <div>
            <label class="block text-sm mb-1">Rôle</label>
            <select name="role" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white">
                <option value="student">Étudiant</option>
                <option value="teacher">Professeur</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold mt-4">S'inscrire</button>
    </form>

    <div class="mt-6 text-center text-sm">
        Déjà un compte ? <a href="/login" class="text-blue-400 hover:underline">Se connecter</a>
    </div>
</div>

</body>
</html>
