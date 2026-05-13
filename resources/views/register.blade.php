<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <style>
        body { background-color: #0c1322; color: #dce2f7; font-family: sans-serif; }
    </style>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="flex items-center justify-center min-h-screen p-4" x-data="{ role: 'student' }">

<div class="w-full max-w-md bg-slate-900 p-8 rounded-xl border border-slate-800 shadow-2xl">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Créer un compte</h2>
    
    <form class="space-y-4" action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label class="block text-sm mb-1 text-slate-400">Nom complet</label>
            <input type="text" name="name" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition-colors" required placeholder="Ex: Jean Dupont">
        </div>
        <div>
            <label class="block text-sm mb-1 text-slate-400">Email</label>
            <input type="email" name="email" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition-colors" required placeholder="jean.dupont@exemple.com">
        </div>
        <div>
            <label class="block text-sm mb-1 text-slate-400">Mot de passe</label>
            <input type="password" name="password" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition-colors" required placeholder="Min. 8 caractères">
        </div>
        <div>
            <label class="block text-sm mb-1 text-slate-400">Rôle</label>
            <select name="role" x-model="role" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition-colors">
                <option value="student">Étudiant</option>
                <option value="teacher">Professeur</option>
            </select>
        </div>

        <div x-show="role === 'teacher'" x-transition x-cloak>
            <label class="block text-sm mb-1 text-slate-400">Votre spécialité initiale</label>
            <select name="subject_id" class="w-full bg-slate-950 border border-slate-700 rounded-lg p-2.5 text-white focus:border-blue-500 outline-none transition-colors" :required="role === 'teacher'">
                <option value="">Sélectionnez votre matière</option>
                @foreach($subjects->groupBy(fn($s) => $s->level->name ?? 'Autre') as $levelName => $levelSubjects)
                    <optgroup label="{{ $levelName }}">
                        @foreach($levelSubjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <p class="text-[10px] text-slate-500 mt-1 italic">Vous pourrez ajouter d'autres matières dans votre profil après l'inscription.</p>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold mt-4 transition-colors shadow-lg">
            S'inscrire
        </button>
    </form>

    <div class="mt-6 text-center text-sm">
        Déjà un compte ? <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Se connecter</a>
    </div>
</div>

</body>
</html>
