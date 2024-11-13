<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',      // The ID of the user who owns the credential
        'image_path',   // Path to the uploaded credential image
    ];

    /**
     * Get the user that owns the credential.
     * Defines a one-to-many (inverse) relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include credentials for a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the full URL for the credential image.
     * If no image is set, it returns the URL for the default avatar image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : asset('storage/credential/default-avatar.png');
    }
}
