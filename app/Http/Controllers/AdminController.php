<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $levels = Level::orderBy('position')->orderBy('name')->get();
        $subjects = Subject::with('level')->orderBy('name')->get();
        return view('dashboard.admin', compact('users', 'levels', 'subjects'));
    }

    public function validateUser(User $user)
    {
        $user->update(['is_validated' => !$user->is_validated]);
        return redirect()->route('admin.dashboard', ['tab' => 'users'])->with('success', 'Statut de l\'utilisateur mis à jour.');
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
        return redirect()->route('admin.dashboard', ['tab' => 'users'])->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'users'])->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Levels
    public function storeLevel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels',
            'position' => 'nullable|integer',
        ]);
        Level::create($validated);
        return redirect()->route('admin.dashboard', ['tab' => 'levels'])->with('success', 'Niveau ajouté avec succès.');
    }

    public function updateLevel(Request $request, Level $level)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name,' . $level->id,
            'position' => 'nullable|integer',
        ]);
        $level->update($validated);
        return redirect()->route('admin.dashboard', ['tab' => 'levels'])->with('success', 'Niveau mis à jour.');
    }

    public function destroyLevel(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'levels'])->with('success', 'Niveau supprimé.');
    }

    // Subjects
    public function storeSubject(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'level_id' => 'required|exists:levels,id',
        ]);
        
        $exists = Subject::where('name', $validated['name'])
                         ->where('level_id', $validated['level_id'])
                         ->exists();
        
        if ($exists) {
            return redirect()->route('admin.dashboard', ['tab' => 'subjects'])->withErrors(['name' => 'Cette matière existe déjà pour ce niveau.']);
        }

        Subject::create($validated);
        return redirect()->route('admin.dashboard', ['tab' => 'subjects'])->with('success', 'Matière ajoutée avec succès.');
    }

    public function updateSubject(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'level_id' => 'required|exists:levels,id',
        ]);

        $subject->update($validated);
        return redirect()->route('admin.dashboard', ['tab' => 'subjects'])->with('success', 'Matière mise à jour.');
    }

    public function destroySubject(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'subjects'])->with('success', 'Matière supprimée.');
    }
}
