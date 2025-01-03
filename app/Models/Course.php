<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tutor;


class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'section',
        'instructor_name',
        'courselanguage',
        'requirement',
        'description',
        'class',
        'course_time',
        'category',
        'image',
        'user_id',
        'uploaded_date',
        'level',
        'price',
        'resources',   // Add resources here
        'lectures'     // Add lectures here
    ];

    protected $casts = [
        'uploaded_date' => 'datetime',
        'lectures' => 'array',
        'resources' => 'array',
    ];

    // Define the relationships

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // A course can have many enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'user_id'); // assuming 'user_id' is the foreign key
    }

    // app/Models/Course.php
    public function savedCourses()
    {
        return $this->belongsToMany(Course::class, 'saved_courses', 'user_id', 'course_id');
    }

    public function tutees()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->wherePivot('status', 'approved'); // Filter by 'approved' status
    }

    public function getTuteesCountAttribute()
    {
        return $this->tutees()->count();
    }



}
