<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard/student', function () {
    return view('dashboard.student');
});

Route::get('/dashboard/teacher', function () {
    return view('dashboard.teacher');
});

Route::get('/dashboard/admin', function () {
    return view('dashboard.admin');
});
