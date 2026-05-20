<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $subscribedCoursesIds = $user->subscribedCourses()->pluck('courses.id')->toArray();
        $subscribedCourses = $user->subscribedCourses()->with(['teacher', 'subject', 'level'])->get();
        $followedTeachers = $user->followedTeachers()->get()->map(function($teacher) use ($user) {
            $conversation = \App\Models\Conversation::where(function($q) use ($user, $teacher) {
                $q->where('user_one_id', $user->id)->where('user_two_id', $teacher->id);
            })->orWhere(function($q) use ($user, $teacher) {
                $q->where('user_one_id', $teacher->id)->where('user_two_id', $user->id);
            })->with('lastMessage')->first();

            $teacher->last_message = $conversation ? $conversation->lastMessage : null;
            $teacher->is_online = $teacher->last_seen_at && $teacher->last_seen_at->gt(now()->subMinutes(2));
            return $teacher;
        });
        $allTeachers = User::where('role', 'teacher')->get();
        
        $query = Course::query()->where('status', 'published')->with(['teacher', 'subject', 'level']);
        
        if ($request->has('level_id')) {
            $query->where('level_id', $request->level_id);
        }
        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $courses = $query->paginate(9)->withQueryString();
        
        $levels = Level::orderBy('position')->get();
        $subjects = Subject::all();
        
        $stats = [
            'courses_count' => $subscribedCourses->count(),
            'teachers_count' => $followedTeachers->count(),
            'recent_activity' => 0,
        ];

        $myMeetings = \App\Models\Meeting::where('student_id', $user->id)
            ->with(['course', 'teacher'])
            ->orderBy('start_at')
            ->get();

        return view('dashboard.student', compact('user', 'subscribedCourses', 'subscribedCoursesIds', 'followedTeachers', 'allTeachers', 'levels', 'subjects', 'courses', 'stats', 'myMeetings'));
    }

    public function toggleLevel(Level $level)
    {
        Auth::user()->levels()->toggle([$level->id]);
        return back()->with('success', 'Niveau mis à jour.');
    }

    public function subscribeToCourse(Course $course)
    {
        Auth::user()->subscribedCourses()->syncWithoutDetaching([$course->id]);
        return back()->with('success', 'Vous vous êtes abonné à ce cours.');
    }

    public function unsubscribeFromCourse(Course $course)
    {
        Auth::user()->subscribedCourses()->detach($course->id);
        return back()->with('success', 'Abonnement retiré.');
    }

    public function followTeacher(User $teacher)
    {
        if ($teacher->role !== 'teacher') return back();
        Auth::user()->followedTeachers()->syncWithoutDetaching([$teacher->id]);
        return back()->with('success', 'Vous suivez maintenant ce professeur.');
    }

    public function unfollowTeacher(User $teacher)
    {
        Auth::user()->followedTeachers()->detach($teacher->id);
        return back()->with('success', 'Vous ne suivez plus ce professeur.');
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
        return redirect()->back()->with('success', 'Profil mis à jour.');
    }
}
