<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        $levels = Level::orderBy('position')->orderBy('name')->get();
        $subjects = Subject::with('level')->orderBy('name')->get();
        $teachers = User::where('role', 'teacher')->with(['levels', 'subjects', 'courses'])->get();
        $pendingCourses = Course::where('status', 'pending')->with(['level', 'subject', 'teacher'])->get();

        return view('dashboard.admin', compact('users', 'levels', 'subjects', 'teachers', 'pendingCourses'));
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

    // Courses Validation
    public function approveCourse(Course $course)
    {
        $course->update(['status' => 'published']);
        return redirect()->route('admin.dashboard', ['tab' => 'courses'])->with('success', 'Cours publié avec succès.');
    }

    public function rejectCourse(Course $course)
    {
        $course->update(['status' => 'rejected']);
        return redirect()->route('admin.dashboard', ['tab' => 'courses'])->with('success', 'Cours rejeté.');
    }

    // Levels
    public function storeLevel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels',
            'position' => 'nullable|integer',
            'category' => 'required|string|max:255',
        ]);
        Level::create($validated);
        return redirect()->route('admin.dashboard', ['tab' => 'levels'])->with('success', 'Niveau ajouté avec succès.');
    }

    public function updateLevel(Request $request, Level $level)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name,' . $level->id,
            'position' => 'nullable|integer',
            'category' => 'required|string|max:255',
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
