<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <title>Modifier Utilisateur - Studa</title>
</head>
<body class="bg-[#0c1322] text-[#dce2f7] font-['Inter'] antialiased">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-[#191f2f] rounded-xl border border-[#424754] p-8">
            <h1 class="text-2xl font-bold mb-6">Modifier l'utilisateur</h1>
            
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium mb-1">Nom</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-[#0c1322] border-[#424754] rounded-lg text-white" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-[#0c1322] border-[#424754] rounded-lg text-white" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Rôle</label>
                    <select name="role" class="w-full bg-[#0c1322] border-[#424754] rounded-lg text-white">
                        <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Étudiant</option>
                        <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Professeur</option>
                    </select>
                </div>

                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-slate-700 hover:bg-slate-600 text-center text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
