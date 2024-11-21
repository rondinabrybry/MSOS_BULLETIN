<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'title', 'content', 'cover_photo', 'user_id']; // Include user_id in the fillable properties

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
{
    return $this->hasMany(Post::class);
}

}
