<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomResetPassword;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'about_me',  // Short bio or profile description
        'gender',
        'email',
        'role',      // User role like admin, tutor, tutee, etc.
        'password',
        'age',       // User's age
        'birthday',  // User's birthday
        'id_photo',
        'selfie_with_id',
        'diploma',
        'verification_status',
        'verified'
    ];




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date', // Automatically cast birthday to a date instance
        'verified' => 'boolean', // Ensure verified is cast to boolean (true/false)
    ];

    /**
     * Send the password reset notification with a custom notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    /**
     * Get the user's full name as a computed attribute.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    /**
     * Scope to filter users by role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Mutator to capitalize the first letter of the first name.
     *
     * @param string $value
     * @return void
     */
    public function setFnameAttribute($value)
    {
        $this->attributes['fname'] = ucfirst($value);
    }

    /**
     * Mutator to capitalize the first letter of the last name.
     *
     * @param string $value
     * @return void
     */
    public function setLnameAttribute($value)
    {
        $this->attributes['lname'] = ucfirst($value);
    }


    // For Verification
    public function isVerified()
    {
        return $this->verified;
    }

    // For Courses Count
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class); // Assuming you have an Enrollment model
    }

    use Notifiable;


}
