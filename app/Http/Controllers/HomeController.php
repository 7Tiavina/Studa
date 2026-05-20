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
            ->get();

        return view('home', compact('courses', 'levels', 'subjects', 'allPublishedCourses'));
    }
}
