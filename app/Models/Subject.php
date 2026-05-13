<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Subject extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'level_id'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($subject) {
            $subject->slug = Str::slug($subject->name);
        });
        static::updating(function ($subject) {
            $subject->slug = Str::slug($subject->name);
        });
    }
}
