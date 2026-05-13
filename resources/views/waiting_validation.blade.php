<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <title>En attente de validation - Studa</title>
</head>
<body class="bg-[#0c1322] text-[#dce2f7] font-['Inter'] antialiased">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full text-center space-y-6">
            <div class="text-6xl text-blue-500 mb-4">
                <span class="material-symbols-outlined" style="font-size: 80px;">pending_actions</span>
            </div>
            <h1 class="text-3xl font-bold">Compte en attente</h1>
            <p class="text-slate-400">
                Votre compte a bien été créé, mais il doit être validé par un administrateur avant que vous ne puissiez accéder aux cours et ressources.
            </p>
            <p class="text-slate-500 text-sm">
                Vous recevrez un accès complet dès que l'administrateur aura vérifié votre profil.
            </p>
            <div class="pt-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:underline">
                        Retour à l'accueil / Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
