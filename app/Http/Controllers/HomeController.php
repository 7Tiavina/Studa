<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query()->where('status', 'published')->with(['subject', 'level']);
        
        if ($request->has('level_id') && $request->level_id) {
            $query->where('level_id', $request->level_id);
        }
        if ($request->has('subject_id') && $request->subject_id) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $courses = $query->paginate(9)->withQueryString();
        $levels = Level::orderBy('position')->get();
        $subjects = Subject::all();

        $allPublishedCourses = Course::where('status', 'published')
            ->with(['subject', 'level', 'teacher'])
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'file_path' => $course->file_path,
                    'thumbnail_path' => $course->thumbnail_path,
                    'type' => $course->type,
                    'extracted_text' => $course->extracted_text,
                    'created_at' => $course->created_at->toIso8601String(),
                    'subject' => [
                        'id' => $course->subject?->id,
                        'name' => $course->subject?->name,
                    ],
                    'level' => [
                        'id' => $course->level?->id,
                        'name' => $course->level?->name,
                    ],
                    'teacher' => [
                        'id' => $course->teacher?->id,
                        'name' => $course->teacher?->name,
                    ]
                ];
            });

        $allTeachers = \App\Models\User::where('role', 'teacher')
            ->where('is_validated', true)
            ->with(['levels', 'subjects'])
            ->withCount(['followers', 'courses', 'meetings'])
            ->get()
            ->map(function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'email' => $teacher->email,
                    'courses_count' => $teacher->courses_count,
                    'followers_count' => $teacher->followers_count,
                    'meetings_count' => $teacher->meetings_count,
                    'subjects' => $teacher->subjects->map(function ($s) {
                        return ['id' => $s->id, 'name' => $s->name];
                    })->toArray(),
                    'levels' => $teacher->levels->map(function ($l) {
                        return ['id' => $l->id, 'name' => $l->name];
                    })->toArray(),
                ];
            });

        return view('home', compact('courses', 'levels', 'subjects', 'allPublishedCourses', 'allTeachers'));
    }
}
