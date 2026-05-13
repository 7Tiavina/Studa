<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Studa',
            'email' => 'admin@studa.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_validated' => true,
        ]);

        // Teacher (waiting)
        User::create([
            'name' => 'Professeur Test',
            'email' => 'teacher@studa.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'is_validated' => false,
        ]);

        // Student (waiting)
        User::create([
            'name' => 'Élève Test',
            'email' => 'student@studa.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'is_validated' => false,
        ]);
    }
}
