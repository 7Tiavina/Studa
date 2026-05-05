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
<body class="flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-slate-900 p-8 rounded-xl border border-slate-800">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Connexion</h2>
    
    <form class="space-y-4" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label class="block text-sm mb-1">Email</label>
            <input type="email" name="email" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white" placeholder="email@exemple.com" required>
        </div>
        <div>
            <label class="block text-sm mb-1">Mot de passe</label>
            <input type="password" name="password" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2 text-white" required>
        </div>
        <div class="flex justify-between items-center text-sm">
            <a href="#" class="text-blue-400 hover:underline">Mot de passe oublié ?</a>
        </div>
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold">Se connecter</button>
    </form>

    <div class="mt-6 text-center text-sm">
        Pas encore de compte ? <a href="{{ route('register') }}" class="text-blue-400 hover:underline">S'inscrire</a>
    </div>
</div>

</body>
</html>
