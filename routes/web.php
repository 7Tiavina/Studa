<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
        Route::get('/dashboard/student', function () { return view('dashboard.student'); });
        Route::get('/dashboard/teacher', function () { return view('dashboard.teacher'); });
    });

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Users
        Route::patch('/admin/users/{user}/validate', [AdminController::class, 'validateUser'])->name('admin.users.validate');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

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
