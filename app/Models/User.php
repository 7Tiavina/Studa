<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_validated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_validated' => 'boolean',
        ];
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    // Student relations
    public function subscribedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }

    public function followedTeachers()
    {
        return $this->belongsToMany(User::class, 'teacher_student', 'student_id', 'teacher_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'teacher_student', 'teacher_id', 'student_id');
    }
}
