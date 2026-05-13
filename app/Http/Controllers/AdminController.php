<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('dashboard.admin', compact('users'));
    }

    public function validateUser(User $user)
    {
        $user->update(['is_validated' => !$user->is_validated]);
        return back()->with('success', 'Statut de l\'utilisateur mis à jour.');
    }

    public function edit(User $user)
    {
        return view('dashboard.admin_edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:student,teacher',
        ]);

        $user->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
