<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'position', 'category'];

    public function subjects()
    {
        return $this->hasMany(Subject::class)->orderBy('name');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
