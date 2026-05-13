<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#adc6ff",
                        "background": "#0c1322",
                        "surface": "#0c1322",
                        "surface-container": "#191f2f",
                        "surface-container-high": "#232a3a",
                        "surface-container-low": "#141b2b",
                        "on-background": "#dce2f7",
                        "on-surface": "#dce2f7",
                        "on-surface-variant": "#c2c6d6",
                        "outline": "#8c909f",
                        "outline-variant": "#424754",
                        "secondary": "#4edea3",
                        "tertiary": "#ffb95f",
                        "error": "#ffb4ab",
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background text-on-background font-sans antialiased">
    <aside class="flex flex-col h-screen fixed z-50 bg-slate-950 w-[260px] border-r border-slate-800">
        <div class="text-2xl font-black text-blue-500 px-6 py-8">Studa</div>
        <div class="flex-1 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600/10 text-blue-500 border-r-2 border-blue-500">
                <span class="material-symbols-outlined">group</span>
                <span>Utilisateurs</span>
            </a>
            <!-- Other links could be added here -->
        </div>
        <div class="p-6 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2 text-error hover:text-red-400 w-full text-left text-sm">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="ml-[260px] min-h-screen flex flex-col">
        <header class="flex items-center justify-between px-6 h-16 w-full sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
            <div class="flex items-center gap-3 ml-auto">
                <div class="text-right">
                    <p class="font-bold text-sm text-slate-100">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500 uppercase">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </header>

        <div class="p-8 max-w-[1600px] mx-auto w-full">
            <div class="mb-10 flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-bold text-on-background mb-2">Gestion des Utilisateurs</h1>
                    <p class="text-on-surface-variant">Validez, modifiez ou supprimez les comptes utilisateurs.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500 text-green-500 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-surface-container rounded-xl border border-outline-variant overflow-hidden">
                <div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center bg-surface-container-high/50">
                    <h2 class="text-lg font-semibold">Liste des Utilisateurs</h2>
                    <span class="text-xs text-secondary bg-secondary-container/10 px-3 py-1 rounded-full">
                        {{ $users->count() }} au total
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container-low text-xs uppercase text-outline">
                            <tr>
                                <th class="px-6 py-4">Utilisateur</th>
                                <th class="px-6 py-4">Rôle</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4">Inscription</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/30">
                            @foreach($users as $user)
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-500 font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $user->name }}</p>
                                            <p class="text-xs text-outline">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $user->role == 'teacher' ? 'bg-purple-500/10 text-purple-400' : 'bg-blue-500/10 text-blue-400' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_validated)
                                        <span class="text-xs font-bold text-secondary flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">check_circle</span> Validé
                                        </span>
                                    @else
                                        <span class="text-xs font-bold text-tertiary flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">pending</span> En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.users.validate', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2 rounded-full hover:bg-slate-700 {{ $user->is_validated ? 'text-tertiary' : 'text-secondary' }}" title="{{ $user->is_validated ? 'Dévalider' : 'Valider' }}">
                                                <span class="material-symbols-outlined">{{ $user->is_validated ? 'block' : 'check_circle' }}</span>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 rounded-full hover:bg-slate-700 text-primary" title="Modifier">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-full hover:bg-slate-700 text-error" title="Supprimer">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
