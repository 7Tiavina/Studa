<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/waiting-validation', function () {
        return view('waiting_validation');
    })->name('waiting.validation');

    Route::middleware('validated')->group(function () {
        // Student routes
        Route::get('/dashboard/student', [StudentController::class, 'index'])->name('student.dashboard');
        Route::post('/student/levels/{level}/toggle', [StudentController::class, 'toggleLevel'])->name('student.levels.toggle');
        Route::post('/student/courses/{course}/subscribe', [StudentController::class, 'subscribeToCourse'])->name('student.courses.subscribe');
        Route::delete('/student/courses/{course}/unsubscribe', [StudentController::class, 'unsubscribeFromCourse'])->name('student.courses.unsubscribe');
        Route::post('/messages/{conversationId}', [MessageController::class, 'store'])->name('messages.store');
        Route::get('/messages/{conversationId}', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/start/{teacherId}', [MessageController::class, 'findOrCreate'])->name('messages.start');
        Route::post('/student/teachers/{teacher}/follow', [StudentController::class, 'followTeacher'])->name('student.teachers.follow');
        Route::delete('/student/teachers/{teacher}/unfollow', [StudentController::class, 'unfollowTeacher'])->name('student.teachers.unfollow');
        Route::put('/student/settings', [StudentController::class, 'updateSettings'])->name('student.settings.update');
        
        // Teacher routes
        Route::get('/dashboard/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
        Route::post('/teacher/courses', [TeacherController::class, 'storeCourse'])->name('teacher.courses.store');
        Route::post('/teacher/subjects', [TeacherController::class, 'addSubject'])->name('teacher.subjects.add');
        Route::delete('/teacher/subjects/{subject}', [TeacherController::class, 'removeSubject'])->name('teacher.subjects.remove');
        Route::put('/teacher/settings', [TeacherController::class, 'updateSettings'])->name('teacher.settings.update');
    });

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Users
        Route::patch('/admin/users/{user}/validate', [AdminController::class, 'validateUser'])->name('admin.users.validate');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

        // Courses
        Route::patch('/admin/courses/{course}/approve', [AdminController::class, 'approveCourse'])->name('admin.courses.approve');
        Route::patch('/admin/courses/{course}/reject', [AdminController::class, 'rejectCourse'])->name('admin.courses.reject');

        // Levels
        Route::post('/admin/levels', [AdminController::class, 'storeLevel'])->name('admin.levels.store');
        Route::put('/admin/levels/{level}', [AdminController::class, 'updateLevel'])->name('admin.levels.update');
        Route::delete('/admin/levels/{level}', [AdminController::class, 'destroyLevel'])->name('admin.levels.destroy');

        // Subjects
        Route::post('/admin/subjects', [AdminController::class, 'storeSubject'])->name('admin.subjects.store');
        Route::put('/admin/subjects/{subject}', [AdminController::class, 'updateSubject'])->name('admin.subjects.update');
        Route::delete('/admin/subjects/{subject}', [AdminController::class, 'destroySubject'])->name('admin.subjects.destroy');
    });
});
