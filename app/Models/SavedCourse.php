<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCourse extends Model
{
    use HasFactory;

    protected $table = 'saved_courses'; // Your table name

    protected $fillable = ['user_id', 'course_id'];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
