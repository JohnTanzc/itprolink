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
    ];

    protected $casts = [
        'uploaded_date' => 'datetime',
    ];

    // Define the relationships

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_name');
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

}
