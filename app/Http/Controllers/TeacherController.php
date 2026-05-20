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
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Récupérer les réunions du professeur
        $meetings = \App\Models\Meeting::where('teacher_id', $user->id)
            ->with(['course', 'student'])
            ->orderBy('start_at', 'asc')
            ->get();

        $stats = [
            'total_courses' => $user->courses()->count(),
            'published_courses' => $user->courses()->where('status', 'published')->count(),
            'pending_courses' => $user->courses()->where('status', 'pending')->count(),
            'total_students' => $user->followers()->count(),
            'total_meetings' => $meetings->count(),
            'booked_meetings' => $meetings->whereNotNull('student_id')->count(),
            'occupancy_rate' => $meetings->count() > 0 ? round(($meetings->whereNotNull('student_id')->count() / $meetings->count()) * 100) : 0,
        ];
        
        $recentCourses = $user->courses()->latest()->take(5)->get();
        $mySubjects = $user->subjects()->with('level')->get();
        $allSubjects = Subject::with('level')->get();
        $students = $user->followers()->get()->map(function($student) use ($user) {
            $conversation = \App\Models\Conversation::where(function($q) use ($user, $student) {
                $q->where('user_one_id', $user->id)->where('user_two_id', $student->id);
            })->orWhere(function($q) use ($user, $student) {
                $q->where('user_one_id', $student->id)->where('user_two_id', $user->id);
            })->with('lastMessage')->first();

            $student->last_message = $conversation ? $conversation->lastMessage : null;
            $student->is_online = $student->last_seen_at && $student->last_seen_at->gt(now()->subMinutes(2));
            return $student;
        });

        // Filtrer les cours de l'enseignant
        $coursesQuery = $user->courses()->with(['subject', 'level']);
        if ($request->has('subject_id') && $request->subject_id != '') {
            $coursesQuery->where('subject_id', $request->subject_id);
        }
        if ($request->has('level_id') && $request->level_id != '') {
            $coursesQuery->where('level_id', $request->level_id);
        }
        $myCourses = $coursesQuery->get();

        // Récupérer les niveaux associés aux matières de l'enseignant pour les filtres
        $myLevels = Level::whereIn('id', $mySubjects->pluck('level_id')->unique())->orderBy('position')->get();

        // Données d'engagement pour les graphiques
        $coursesPerSubject = $user->courses()
            ->selectRaw('subject_id, count(*) as count')
            ->groupBy('subject_id')
            ->with('subject')
            ->get()
            ->map(function($item) {
                return [
                    'label' => $item->subject ? $item->subject->name : 'Inconnu',
                    'value' => $item->count
                ];
            });

        $subscribersPerCourse = $user->courses()
            ->where('status', 'published')
            ->withCount('subscribers')
            ->orderByDesc('subscribers_count')
            ->take(5)
            ->get()
            ->map(function($course) {
                return [
                    'label' => $course->title,
                    'value' => $course->subscribers_count
                ];
            });

        return view('dashboard.teacher', compact(
            'user', 
            'stats', 
            'recentCourses', 
            'mySubjects', 
            'allSubjects', 
            'students', 
            'myCourses', 
            'myLevels', 
            'meetings',
            'coursesPerSubject',
            'subscribersPerCourse'
        ));
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
