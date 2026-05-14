<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'total_courses' => $user->courses()->count(),
            'published_courses' => $user->courses()->where('status', 'published')->count(),
            'pending_courses' => $user->courses()->where('status', 'pending')->count(),
            'total_students' => 0, // Placeholder for now
        ];
        
        $recentCourses = $user->courses()->latest()->take(5)->get();
        $mySubjects = $user->subjects()->with('level')->get();
        $allSubjects = Subject::with('level')->get();
        $students = $user->followers()->get();

        return view('dashboard.teacher', compact('user', 'stats', 'recentCourses', 'mySubjects', 'allSubjects', 'students'));
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'type' => 'required|in:course,sujet_type,correction',
            'file' => 'required|file|mimes:pdf,doc,docx,txt|max:10240',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $subject = Subject::findOrFail($validated['subject_id']);
        
        if (!$subject->level_id) {
            return back()->withErrors(['subject_id' => 'Cette matière n\'est pas associée à un niveau valide. Veuillez contacter l\'administrateur.']);
        }

        $path = $request->file('file')->store('courses', 'public');
        $thumbnailPath = $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : null;

        Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'subject_id' => $validated['subject_id'],
            'level_id' => $subject->level_id,
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'file_path' => $path,
            'thumbnail_path' => $thumbnailPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Votre cours a été envoyé pour validation.');
    }

    public function addSubject(Request $request)
    {
        $request->validate(['subject_id' => 'required|exists:subjects,id']);
        Auth::user()->subjects()->syncWithoutDetaching([$request->subject_id]);
        return redirect()->back()->with('success', 'Matière ajoutée à votre profil.');
    }

    public function removeSubject(Subject $subject)
    {
        Auth::user()->subjects()->detach($subject->id);
        return redirect()->back()->with('success', 'Matière retirée de votre profil.');
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}
